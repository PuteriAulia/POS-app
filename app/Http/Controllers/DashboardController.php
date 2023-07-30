<?php

namespace App\Http\Controllers;

use App\Charts\TransactionByMonthChart;
use App\Models\Product;
use App\Models\Suplier;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(TransactionByMonthChart $chart){
        $grandTotal = 0;
        $transactions = Transaction::all();
        $countTransaction = count($transactions);
        foreach ($transactions as $transaction) {
            $grandTotal += $transaction->transaction_grand_total;
        }

        $products = Product::where('product_status','active')->get();
        $countProduct = count($products);

        $supliers = Suplier::where('suplier_status','active')->get();
        $countSuplier = count($supliers);

        $chart = $chart->build();

        return view('dashboard',[
            'countProduct' => $countProduct,
            'countSuplier' => $countSuplier,
            'grandTotal'   => $grandTotal,
            'countTransaction' => $countTransaction,
            'chart'        => $chart,
        ]);
    }
}
