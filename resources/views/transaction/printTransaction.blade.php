<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Print Detail Transaksi</title>

        <meta name="description" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework">
        <meta property="og:site_name" content="OneUI">
        <meta property="og:description" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

        <!-- Fonts and OneUI framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
        <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/oneui.min.css') }}">
        <!-- END Stylesheets -->
</head>
<body>
    <div class="content content-boxed">
        <!-- Invoice -->
        <div class="block block-rounded">
            <?php foreach ($transaction as $data) { ?>
                <div class="block-header">
                    <h1 class="block-title"><?= ucwords($data->user->name) ?> | <?= $data->transaction_code ?></h1>
                </div>
            <?php } ?>
            
            <div class="block-content">
                <div class="p-sm-4 p-xl-7">
                    <!-- Invoice Info -->
                    <div class="row mb-4">
                        <!-- Company Info -->
                        <div class="col-6 font-size-sm">
                            <p class="h3">Toko Kita</p>
                            <address>
                                Alamat lengkap toko<br>
                                Kecamatan dan kabupaten toko<br>
                                Provinsi dan kode pos<br>
                            </address>
                        </div>
                        <!-- END Company Info -->

                        <!-- Client Info -->
                        <div class="col-6 text-right font-size-sm">
                            <p class="h3">Pembeli</p>
                            <address>
                                Pelanggan
                            </address>
                        </div>
                        <!-- END Client Info -->
                    </div>
                    <!-- END Invoice Info -->

                    <!-- Table -->
                    <div class="table-responsive push">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 60px;"></th>
                                    <th>Produk</th>
                                    <th class="text-right" style="width: 120px;">Harga</th>
                                    <th class="text-center" style="width: 90px;">Qty</th>
                                    <th class="text-right" style="width: 120px;">Sub total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($transactionDetail as $data) {
                                ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td>
                                        <p class="font-w600 mb-1">{{ ucwords($data->product->product_name) }}</p>
                                    </td>
                                    <td class="text-right">{{ rupiahFormat($data->product->product_sell) }}</td>
                                    <td class="text-center">
                                        <p>{{ $data->detail_qty }}</p>
                                    </td>
                                    <td class="text-right">{{ rupiahFormat($data->detail_subtotal) }}</td>
                                </tr>
                                <?php } ?>
                                
                                <?php foreach ($transaction as $data) { ?>
                                <tr>
                                    <td colspan="4" class="font-w600 text-right">Subtotal</td>
                                    <td class="text-right">{{ rupiahFormat($data->transaction_total) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="font-w600 text-right">Diskon</td>
                                    <td class="text-right">{{ rupiahFormat($data->transaction_disc) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="font-w700 text-uppercase text-right bg-body-light">Grand total</td>
                                    <td class="font-w700 text-right bg-body-light">{{ rupiahFormat($data->transaction_grand_total) }}</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- END Table -->
                </div>
            </div>
        </div>
        <!-- END Invoice -->
    </div>
</body>

<script>
    window.print();
</script>
</html>