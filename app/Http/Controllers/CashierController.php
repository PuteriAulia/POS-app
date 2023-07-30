<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Id transaction
        $maxId = Transaction::max('transaction_code');
        $dateKode = (int) substr($maxId,-10,6);
		$orderCode = (int) substr($maxId,-4,4);
        $date = date('ymd');

        if ($dateKode == $date) {
            $incrementCode = $orderCode+1;
            $orderCode = sprintf("%'.04d",$incrementCode);
        }else{
            $orderCode = "0001";
        }
        $invoice = "INV".date('ymd').$orderCode;

        // Selected product list
        $user_id = Auth::user()->id; //masih dummy bcs it wasnt processed
        $selctedProducts = Cashier::where('user_id',$user_id)->get();

        // Total payment
        if (count($selctedProducts) == 0) {
            $total=0;
        }else{
            $total=0;
            foreach ($selctedProducts as $data) {
                $total += $data->product_subtotal;
            }
        }

        // List product
        $products = Product::where('product_status','active')->where('product_stock','>',0)->get();

        // Table selected product
        if (request()->ajax()) {
            $selctedProducts = Cashier::where('user_id',$user_id)->get();
            return DataTables::of($selctedProducts)
            ->addIndexColumn()
            ->addColumn('name', function($selctedProducts){
                return ucwords($selctedProducts->products->product_name);
            })
            ->addColumn('qty', function($selctedProducts){
                return ($selctedProducts->product_qty);
            })
            ->addColumn('sell', function($selctedProducts){
                return 'Rp '.number_format($selctedProducts->product_subtotal);
            })
            ->addColumn('subtotal', function($selctedProducts){
                return ($selctedProducts->product_qty);
            })
            ->addColumn('action',function($selctedProducts){
                return view('cashier.btnDelCashier')->with('data',$selctedProducts);
            })
            ->make(true);
        }

        return view('cashier.cashier',[
            'products'  => $products,
            'inv'       => $invoice,
            'selectedProducts' => $selctedProducts,
            'total'     => $total,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inp_inv         = $request->inv;
        $inp_productCode = $request->productCode;
        $inp_qty         = $request->qty;
        $user_id         = Auth::user()->id; //dummy user id 
 
        // Check products stock
        $findProduct = Product::where('product_code',$inp_productCode)->get();
        foreach ($findProduct as $product) {
            $stock     = $product->product_stock;
            $sellPrice = $product->product_sell; 
            $productId = $product->id;
        } 
        $checkStock = $stock - $inp_qty;

        if ($checkStock >= 0) {
            // Get product by invoice
            $findCart = Cashier::where('user_id',$user_id)->get();
            $countCart = count($findCart);
            if ($countCart == 0) {
                // Process subtotal
                $subtotal = $inp_qty * $sellPrice;

                // Decrase product stock
                $newStock = $stock - $inp_qty;
                Product::where('id',$productId)->update([
                    'product_stock' => $newStock,
                ]);

                // Store selected product to cart
                Cashier::create([
                    'product_qty'       => $inp_qty,
                    'product_subtotal'  => $subtotal,
                    'product_id'        => $productId,
                    'user_id'           => Auth::user()->id,
                    // 'transaction_code'  => $inp_inv,
                ]);
            }else{
                $findCart = Cashier::where('user_id',$user_id)->where('product_id',$productId)->get();
                $countSelectedProduct = count($findCart);

                // Check product already selected or not
                if ($countSelectedProduct == 0) {
                    $subtotal = $inp_qty * $sellPrice;

                    Cashier::create([
                        'product_qty'       => $inp_qty,
                        'product_subtotal'  => $subtotal,
                        'product_id'        => $productId,
                        'user_id'           => Auth::user()->id,
                        // 'transaction_code'  => $inp_inv,
                    ]);
                }else{
                    foreach ($findCart as $cart) {
                        $cart_qty = $cart->product_qty;
                        // Update qty
                        $newQty = $cart_qty + $inp_qty;
                        // Update subtotal
                        $newSubtotal = $newQty * $sellPrice;

                        // Update selected product to cart
                        Cashier::where('user_id',$user_id)->where('product_id',$productId)->update([
                            'product_qty'       => $newQty,
                            'product_subtotal'  => $newSubtotal,
                        ]);
                    }
                }
                // Decrase product stock
                $newStock = $stock - $inp_qty;
                Product::where('id',$productId)->update([
                    'product_stock' => $newStock,
                ]);
            }
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Stok barang tidak cukup');
        }
        return redirect()->to('/kasir');
    }

    public function delete_cart($id)
    {
        // Update product stock
        $cart = Cashier::where('id',$id)->get();
        foreach ($cart as $data) {
            $productId = $data->product_id;
            $qtyCart   = $data->product_qty;
        }

        $product = Product::where('id',$productId)->get();
        foreach ($product as $data) {
            $productStock = $data->product_stock;
        }

        $newStock = $productStock + $qtyCart;
        Product::where('id',$productId)->update([
            'product_stock' => $newStock,
        ]);

        // Delete cart
        Cashier::where('id',$id)->delete();

        return response()->json([
            'status' => 'success',
            'message'=> 'Data berhasil dihapus',
        ]);
    }

    public function payment_process(Request $request)
    {
        // dd($user_id = Auth::user()->id);
        $inp_total   = $request->total;
        $inp_inv     = $request->inv;
        $inp_payment = $request->payment;
        $inp_disc    = $request->disc;
        
        $afterDisc = (int)$inp_total-(int)$inp_disc;
        $change = (int)$inp_payment-$afterDisc;
        if ($change < 0) {
            Session::flash('status', 'success');
            Session::flash('message', 'Uang pembayaran tidak cukup');
            return redirect()->to('/kasir');
        }else{
            // Get selected product
            $user_id = Auth::user()->id; //masih dummy bcs it wasnt processed
            $cartItems = Cashier::where('user_id',$user_id)->get();

            return view('cashier/payment',[
                'total'     => $inp_total,
                'payment'   => $inp_payment,
                'grandTotal'=> $afterDisc,
                'disc'      => $inp_disc,
                'change'    => $change,
                'cartItems' => $cartItems,
                'inv'       => $inp_inv,
            ]);
        }
    }

    public function store_payment(Request $request){
        $inp_inv        = $request->inv;
        $inp_total      = $request->total;
        $inp_grandTotal = $request->grandTotal;
        $inp_disc       = $request->disc;
        $inp_date       = $request->date;

        // Store data to transaction detail table
        $user_id = Auth::user()->id; //masih dummy bcs it wasnt processed

        // Store data to transaction table
        Transaction::insert([
            'transaction_code'        => $inp_inv,
            'transaction_date'        => $inp_date,
            'transaction_total'       => $inp_total,
            'transaction_disc'        => $inp_disc,
            'transaction_grand_total' => $inp_grandTotal,
            'user_id'                 => $user_id,
        ]);

        $selectedProducts = Cashier::where('user_id',$user_id)->get();
        foreach ($selectedProducts as $data) {
            $saveTransactionDetail = [
                'detail_qty'      => $data->product_qty,
                'detail_price'    => $data->products->product_sell,
                'detail_subtotal' => $data->product_subtotal,
                'product_id'      => $data->products->id,
                'transaction_code'=> $inp_inv,
            ];
            TransactionDetail::insert($saveTransactionDetail);
        }

        // Delete cart table
        Cashier::where('user_id',$user_id)->delete();
        return redirect()->to('/kasir');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
