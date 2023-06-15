<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adventure Works - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
</head>

<body>

    <?php
    include "connect.php";

    ?>


    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <?php
            include "navbar.php";
            include "logout.php";
            include "scroll-top-button.php";
            ?>


            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Total Penjualan -->
                    <!-- Total Penjualan -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Penjualan</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                            include "connect.php";
                                            $query = mysqli_query($conn, "SELECT SUM(line_total) as total_penjualan from fakta_penjualan");
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo "$" . number_format($row['total_penjualan'], 0, ".", ",");
                                            }
                                            ?>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jumlah Tagihan Pembelian -->
                    <!-- Earnings (Yearly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Pembelian</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                include "connect.php";
                                                $query = mysqli_query($conn, 'SELECT sum(line_total) as count FROM fakta_pembelian');
                                                    $row = mysqli_fetch_array($query);

                                                    echo "$"; echo number_format($row['count'],0,".",",")?></div>

                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Jumlah Produk yang Terjual -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Discount Produk
                                        </div>
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    <?php
                                                    include "connect.php";
                                                    $query = mysqli_query($conn, 'SELECT sum(unit_price_discount) as discount FROM fakta_penjualan');
                                                        $row = mysqli_fetch_array($query);
    
                                                        echo "$"; echo number_format($row['discount'],0,".",",")?></div>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                 
                <!-- Content Row -->

                <div class="row">

                    <!-- Area Chart -->
                    <div class="col-lg-7">
                        <div class="card shadow mb-4">
                            <!-- Card Header -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Total Biaya Pengiriman Per Bulan</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="myAreaChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header-->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Top 3 kategori Produk Paling Banyak Terjual</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="myPieChart"></canvas>
                                </div>
                                <div class="mt-4 text-center small">
                                    <?php
                                    $kategoriproduk = mysqli_query($conn, "SELECT p.category, SUM(f.order_qty) AS jumlah FROM fakta_penjualan f JOIN product p ON f.product_id = p.product_id GROUP BY category ORDER BY jumlah DESC LIMIT 3");
                                    while ($data = mysqli_fetch_array($kategoriproduk)) {
                                        $kategori_produk[] = $data['category'];
                                    }
                                    
                                    ?>
                                    <span class="mr-2">
                                        <i class="fas fa-circle" style="color: #d94f00;"></i> <?php echo $kategori_produk[0]; ?>
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle" style="color: #d9c300;"></i> <?php echo $kategori_produk[1]; ?>
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle" style="color: #94d900;"></i> <?php echo $kategori_produk[2]; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.container-fluid -->


        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include "footer.php" ?>

        </div>
        <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->



        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>


    </body>
    <!-- Pie Chart -->
    <?php
   // Connect ke Database
   include 'connect.php';

   // Pemanggilan Data untuk Donut Chart
   $kategoriproduk = mysqli_query($conn, "SELECT p.category AS category, SUM(fp.order_qty) AS jumlah FROM fakta_penjualan fp JOIN product p ON fp.product_id = p.product_id GROUP BY p.category ORDER BY jumlah DESC LIMIT 3");
   while ($data = mysqli_fetch_array($kategoriproduk)) {
     $kategori_produk[] = $data['category'];
     $jumlah[] = $data['jumlah'];
    }

    //data line chart
    $i = 1;
    $query_bulan = mysqli_query($conn, "SELECT CONCAT(MONTHNAME(t.tanggallengkap), ' ', YEAR(t.tanggallengkap)) bulan FROM fakta_penjualan f JOIN time t ON f.time_id=t.time_id GROUP BY t.bulan ORDER BY t.tanggallengkap");
    $jumlah_bulan = mysqli_num_rows($query_bulan);
    $chart_bulan = "";
    while ($row = mysqli_fetch_array($query_bulan)) {
        if ($i < $jumlah_bulan) {
            $chart_bulan .= '"';
            $chart_bulan .= $row['bulan'];
            $chart_bulan .= '",';
            $i++;
        } else {
            $chart_bulan .= '"';
            $chart_bulan .= $row['bulan'];
            $chart_bulan .= '"';
        }
    }
    $a = 1;
    $query_ship_rate= mysqli_query($conn, "SELECT sum(ship_rate) as ship_rate FROM fakta_penjualan f JOIN time t ON f.time_id=t.time_id GROUP BY t.bulan ORDER BY t.tanggallengkap");
    $jumlah_ship_rate = mysqli_num_rows($query_ship_rate);
    $chart_ship_rate = "";
    while ($row1 = mysqli_fetch_array($query_ship_rate)) {
        if ($a < $jumlah_ship_rate) {
            $chart_ship_rate .= $row1['ship_rate'];
            $chart_ship_rate .= ',';
            $a++;
        } else {
            $chart_ship_rate .= $row1['ship_rate'];
        }
    }


    ?>

<script>
        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php echo $chart_bulan; ?>],
                datasets: [{
                    label: "Total biaya pengiriman",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [<?php echo $chart_ship_rate; ?>],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return number_format(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ':' + number_format(tooltipItem.yLabel);
                        }
                    }
                }
            }
        });

        // Pie Chart Script
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: <?php echo json_encode($kategori_produk); ?>,
                datasets: [{
                    data: <?php echo json_encode($jumlah); ?>,
                    backgroundColor: ["#d94f00", "#d9c300", "#94d900", "#00d953", "#00d9c7 ", "#0028d9 ", "#8900d9", "#d90033", "#969696 ", "#ff26ac"],
                    hoverBackgroundColor: ["#fa8948", "#f7e439", "#bef743", "#4af78c", "#52faec", "#4e6efc", "#bd4dff", "#ff4773","black","#ff1c4d"],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }, ],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: "#dddfeb",
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false,
                },
                cutoutPercentage: 80,
            },
        });
    </script>

</html>