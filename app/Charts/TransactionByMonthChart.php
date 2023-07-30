<?php

namespace App\Charts;

use App\Models\Transaction;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionByMonthChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $year = date('Y');
        $month= date('m');
        for ($i=1; $i <= $month ; $i++) { 
            if ($i === 1) {
                $i = '01';
            }elseif ($i === 2) {
                $i = '02';
            }elseif ($i === 3) {
                $i = '03';
            }elseif ($i === 4) {
                $i = '04';
            }elseif ($i === 5) {
                $i = '05';
            }elseif ($i === 6) {
                $i = '06';
            }elseif ($i === 7) {
                $i = '07';
            }elseif ($i === 8) {
                $i = '08';
            }elseif ($i === 9) {
                $i = '09';
            }
            // dd($i);

            $totalTransaction = Transaction::whereYear('transaction_date',$year)->whereMonth('transaction_date',$i)->sum('transaction_grand_total');

            $dataMonth[] = changeIntToMonth($i);
            $dataTotalTransaction[] = $totalTransaction; 
        }
        // dd($dataTotalTransaction);

        return $this->chart->lineChart()
            ->setTitle('Data Penjualan')
            ->setSubtitle('Penjualan setiap bulan dalam satu tahun')
            ->addData('Total transaksi', $dataTotalTransaction)
            ->setHeight(300)
            ->setXAxis($dataMonth);
    }
}
