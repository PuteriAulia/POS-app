<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\ProductOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProductOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $productsOut = ProductOut::all();
            return DataTables::of($productsOut)
            ->addIndexColumn()
            ->addColumn('name', function($productsOut){
                return ucwords($productsOut->product->product_name);
            })
            ->addColumn('date', function($productsOut){
                return Carbon::parse($productsOut->productOut_date)->translatedFormat('d F Y');
            })
            ->addColumn('action',function($productsOut){
                return view('productOut.btnDelDetProductOut')->with('data',$productsOut);
            })
            ->make(true); 
        }
        return view('productOut.dataProductOut');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('product_status','active')->get();
        return view('productOut.formStoreProductOut',['products'=>$products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'product'   => 'required',
            'date'      => 'required',
            'qty'       => 'required',
        ],[ 
            'product.required'  => "Nama barang wajib diisi",
            'date.required'     => "Tanggal wajib diisi",
            'qty.required'      => "Qty wajib diisi",
        ]);

        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors()->toArray()]);
        }else{
            // Generate products code
            $maxId = ProductOut::max('productOut_code');
            $intMaxId = (int) substr($maxId,3);

            if ($maxId == null) {
                $intMaxId = '0001';
            }else{
                $addIntMaxId = $intMaxId+1;
                $intMaxId = sprintf("%'.04d",$addIntMaxId);
            }
            $newId = "BRK".$intMaxId;

            // Incrase product stock
            $product = Product::where('id',$request->product)->get();
            foreach ($product as $data) {
                $oldStock = $data->product_stock;
                $newStock = $oldStock - $request->qty;
            }

            // Update product stock
            Product::where('id',$request->product)->update([
                'product_stock' => $newStock,
            ]);

            // Store productIn
            ProductOut::create([
                'productOut_code'  => $newId,
                'productOut_qty'   => $request->qty,
                'productOut_date'  => $request->date,
                'productOut_info'  => $request->desc,
                'product_id'      => $request->product,
            ]);

            return response()->json([
                'status' => 'success',
                'message'=> 'Data berhasil ditambahkan',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productId = Crypt::decrypt($id);
        $productOut = ProductOut::where('id',$productId)->get();

        foreach ($productOut as $data) {
            $productId = $data->product_id;
        }
        $product = Product::where('id',$productId)->get();
        foreach ($product as $item) {
            $productName = ucwords($item->product_name);
        }

        return response()->json([
            'status' => 'success',
            'productOut' => $productOut, 
            'productName' => $productName,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productId = Crypt::decrypt($id);

        //Decrease product stock
        $productOut = ProductOut::where('id',$productId)->get();
        foreach ($productOut as $produckOutData) {
            $productOutQty = $produckOutData->productOut_qty;
            $productOutProductId = $produckOutData->product_id;
        }

        $product = Product::where('id',$productOutProductId)->get();
        foreach ($product as $productData) {
            $productStock = $productData->product_stock;
            $newStock     = $productStock+$productOutQty;
        }

        Product::where('id',$productOutProductId)->update([
            'product_stock' => $newStock,
        ]);

        // Delete productIn
        ProductOut::where('id',$productId)->delete();

        return response()->json([
            'status' => 'success',
            'message'=> 'Data berhasil dihapus',
        ]);
    }
}
