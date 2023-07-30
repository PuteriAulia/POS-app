<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $transactions = Transaction::all();
            return DataTables::of($transactions)
            ->addIndexColumn()
            ->addColumn('date', function($transactions){
                return Carbon::parse($transactions->transaction_date)->translatedFormat('d F Y');
            })
            ->addColumn('total', function($transactions){
                return rupiahFormat($transactions->transaction_grand_total);
            })
            ->addColumn('action',function($transactions){
                return view('transaction.detTransaction')->with('data',$transactions);
            })
            ->make(true);
        }
        return view('transaction.dataTransaction');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::where('transaction_code',$id)->get();
        $transactionDetail = TransactionDetail::where('transaction_code',$id)->get();

        return view('transaction/detailTransaction',[
            'transaction'       => $transaction,
            'transactionDetail' => $transactionDetail,
        ]);
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

    public function print($id)
    {
        $transaction = Transaction::where('transaction_code',$id)->get();
        $transactionDetail = TransactionDetail::where('transaction_code',$id)->get();

        return view('transaction.printTransaction',[
            'transaction'       => $transaction,
            'transactionDetail' => $transactionDetail,
        ]);
    }
}
