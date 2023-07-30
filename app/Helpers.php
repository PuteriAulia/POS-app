<?php 
    function rupiahFormat($nominal)
    {
        return "Rp ".number_format($nominal,0,',','.');
    }

    function changeIntToMonth($intMonth)
    {
        if ($intMonth === '01') {
            return 'Januari';
        }elseif ($intMonth === '02') {
            return 'Februari';
        }elseif ($intMonth === '03') {
            return 'Maret';
        }elseif ($intMonth === '04') {
            return 'April';
        }elseif ($intMonth === '05') {
            return 'Mei';
        }elseif ($intMonth === '06') {
            return 'Juni';
        }elseif ($intMonth === '07') {
            return 'Juli';
        }elseif ($intMonth === '08') {
            return 'Agustus';
        }elseif ($intMonth === '09') {
            return 'September';
        }elseif ($intMonth === '10') {
            return 'Oktober';
        }elseif ($intMonth === '11') {
            return 'November';
        }elseif ($intMonth === '12') {
            return 'Desember';
        }
    }

?>