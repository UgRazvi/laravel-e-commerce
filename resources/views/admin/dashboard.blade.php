{{-- Since All The Code For Dashboard Is Stored In Parent Layout File ('Admin > Layouts > App') --}}
{{-- We Have To Import It Here By Using "@extends('FROM')" Method - Inheritance --}}

@extends('admin.layouts.app')

@section('dyn-content')

<!-- Google Font: Source Sans Pro -->
{{--
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
--}}
<!-- Font Awesome -->
{{--
<link rel="stylesheet" href="{{asset('adminLTE/plugins/fontawesome-free/css/all.min.css')}}"> --}}
<!-- Theme style -->
{{--
<link rel="stylesheet" href="{{asset('adminLTE/dist/css/adminlte.min.css')}}"> --}}
{{--
<!-- Content Header (Page header) --> --}}

{{-- @foreach ($orderStatusCounts as $status)
<tr>
    <td>{{ $status->order_status ?? 'NULL' }}</td>
</tr>
@endforeach --}}

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">

            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">

        <div class="row">
            <!-- Left Section: col-8 -->
            <div class="col-lg-8 col-md-12 col-sm-12 d-flex flex-column">
                <div class="row g-1 flex-fill justify-content-center align-items-center">
                    <!-- Total Orders -->
                    <div class=" mb-3 col-lg-6 col-md-6">
                        <div class="card border-0 shadow-sm rounded-lg h-100">
                            <div class="card-body text-center">
                                <h3 class="display-5 text-primary fw-bold">{{$totalOrders}}</h3>
                                <p class="text-muted">Total Orders</p>
                                <a href="{{route('orders.index')}}" class="btn btn-link text-primary">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Total Products -->
                    <div class=" mb-3 col-lg-6 col-md-6">
                        <div class="card border-0 shadow-sm rounded-lg h-100">
                            <div class="card-body text-center">
                                <h3 class="display-5 text-success fw-bold">{{$totalProducts}}</h3>
                                <p class="text-muted">Total Products</p>
                                <a href="{{route('products.index')}}" class="btn btn-link text-success">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Total Admins -->
                    <div class=" mb-3 col-lg-6 col-md-6">
                        <div class="card border-0 shadow-sm rounded-lg h-100">
                            <div class="card-body text-center">
                                <h3 class="display-5 text-warning fw-bold">{{$totalAdmins}}</h3>
                                <p class="text-muted">Total Admins</p>
                                <a href="{{route('users.index')}}" class="btn btn-link text-warning">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Total Customers -->
                    <div class=" mb-3 col-lg-6 col-md-6">
                        <div class="card border-0 shadow-sm rounded-lg h-100">
                            <div class="card-body text-center">
                                <h3 class="display-5 text-info fw-bold">{{$totalCustomers}}</h3>
                                <p class="text-muted">Total Customers</p>
                                <a href="{{route('users.index')}}" class="btn btn-link text-info">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- This Month's Orders and Sales -->
                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <div class="card border-0 shadow-sm rounded-lg">
                            <div class="card-body text-center">
                                <h4 class="text-secondary fw-bold">This Month</h4>
                                <p><strong>Orders:</strong> {{$totalOrdersThisMonth}}</p>
                                <p><strong>Sales:</strong> ₹{{$totalSalesThisMonth}}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Last 30 Days Orders and Sales -->
                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <div class="card border-0 shadow-sm rounded-lg">
                            <div class="card-body text-center">
                                <h4 class="text-secondary fw-bold">Last 30 Days</h4>
                                <p><strong>Orders:</strong> {{$totalOrdersLast30Days}}</p>
                                <p><strong>Sales:</strong> ₹{{$totalSalesLast30Days}}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Last Year Orders and Sales -->
                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <div class="card border-0 shadow-sm rounded-lg">
                            <div class="card-body text-center">
                                <h4 class="text-secondary fw-bold">Last Year</h4>
                                <p><strong>Orders:</strong> {{$totalOrdersLastYear}}</p>
                                <p><strong>Sales:</strong> ₹{{$totalSalesLastYear}}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Orders and Sales -->
                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4 d-none">
                        <div class="card border-0 shadow-sm rounded-lg">
                            <div class="card-body text-center">
                                <h4 class="text-secondary fw-bold">This Month</h4>
                                <p><strong>Orders:</strong> {{$totalOrders}}</p>
                                <p><strong>Sales:</strong> ₹{{$totalSales}}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Section: col-4 -->

            <div class="col-lg-4 col-md-12 col-sm-12 d-flex flex-column">
                <div class="row flex-fill">
                    <!-- Total Sales Tile -->
                    <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                        <div class="card border-0 shadow-sm rounded-lg">
                            
                            <div class="card-body text-center">
                            
                                <div class="TotalSalesOrders ">
                                    <h4 class="text-secondary fw-bold">Total Sales / Orders</h4>
                                    <hr>
                                    <p><strong>Orders:</strong> {{$totalOrders}}</p>
                                    <p><strong>Sales:</strong> ₹{{$totalSales}}</p>
                                </div>

                                <table class=" my-3 table table-bordered table-striped text-center justify-content-center align-items-center ">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Order Status</th>
                                            <th>Total Orders</th>
                                            <th>Total Sales</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Pending Orders</td>
                                            <td>{{$pendingOrders}}</td>
                                            <td>${{number_format($pendingOrdersSales, 2)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Shipped Orders</td>
                                            <td>{{$shippedOrders}}</td>
                                            <td>${{number_format($shippedOrdersSales, 2)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Delivered Orders</td>
                                            <td>{{$deliveredOrders}}</td>
                                            <td>₹{{number_format($deliveredOrdersSales, 2)}}</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                            <div class="card-footer bg-primary text-white text-center">
                                <a href="{{route('orders.index')}}" class="small-box-footer text-dark">
                                    Sales Overview <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /.card -->
</section>

{{-- Charts Logic --}}
<section class="content d-none">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- AREA CHART -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Area Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="areaChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- DONUT CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Donut Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="donutChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- PIE CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Pie Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col (LEFT) -->
            <div class="col-md-6">
                <!-- LINE CHART -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Line Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="lineChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- BAR CHART -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Bar Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="barChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- STACKED BAR CHART -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Stacked Bar Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="stackedBarChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<!-- /.content -->
@endsection

@section('customJs')
<!-- jQuery -->
{{-- <script src=" {{asset('adminLTE/plugins/jquery/jquery.min.js')}}"></script> --}}
<!-- Bootstrap 4 -->
{{-- <script src=" {{asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script> --}}
<!-- ChartJS -->
{{-- <script src=" {{asset('adminLTE/plugins/chart.js/Chart.min.js')}}"></script> --}}
<!-- AdminLTE App -->
{{-- <script src=" {{asset('adminLTE/dist/js/adminlte.min.js')}}"></script> --}}
<!-- AdminLTE for demo purposes -->
{{-- <script src=" {{asset('adminLTE/dist/js/demo.js')}}"></script> --}}
<!-- Page specific script -->
<script>
    $(function () {
          /* ChartJS
           * -------
           * Here we will create a few charts using ChartJS
           */
      
          //--------------
          //- AREA CHART -
          //--------------
      
          // Get context with jQuery - using jQuery's .get() method.
          var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
      
          var areaChartData = {
            labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [
              {
                label               : 'Digital Goods',
                backgroundColor     : 'rgba(60,141,188,0.9)',
                borderColor         : 'rgba(60,141,188,0.8)',
                pointRadius          : false,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : [28, 48, 40, 19, 86, 27, 90]
              },
              {
                label               : 'Electronics',
                backgroundColor     : 'rgba(210, 214, 222, 1)',
                borderColor         : 'rgba(210, 214, 222, 1)',
                pointRadius         : false,
                pointColor          : 'rgba(210, 214, 222, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : [65, 59, 80, 81, 56, 55, 40]
              },
            ]
          }
      
          var areaChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
              display: false
            },
            scales: {
              xAxes: [{
                gridLines : {
                  display : false,
                }
              }],
              yAxes: [{
                gridLines : {
                  display : false,
                }
              }]
            }
          }
      
          // This will get the first returned node in the jQuery collection.
          new Chart(areaChartCanvas, {
            type: 'line',
            data: areaChartData,
            options: areaChartOptions
          })
      
          //-------------
          //- LINE CHART -
          //--------------
          var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
          var lineChartOptions = $.extend(true, {}, areaChartOptions)
          var lineChartData = $.extend(true, {}, areaChartData)
          lineChartData.datasets[0].fill = false;
          lineChartData.datasets[1].fill = false;
          lineChartOptions.datasetFill = false
      
          var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
          })
      
          //-------------
          //- DONUT CHART -
          //-------------
          // Get context with jQuery - using jQuery's .get() method.
          var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
          var donutData        = {
            labels: [
                'Chrome',
                'IE',
                'FireFox',
                'Safari',
                'Opera',
                'Navigator',
            ],
            datasets: [
              {
                data: [700,500,400,600,300,100],
                backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
              }
            ]
          }
          var donutOptions     = {
            maintainAspectRatio : false,
            responsive : true,
          }
          //Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
          })
      
          //-------------
          //- PIE CHART -
          //-------------
          // Get context with jQuery - using jQuery's .get() method.
          var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
          var pieData        = donutData;
          var pieOptions     = {
            maintainAspectRatio : false,
            responsive : true,
          }
          //Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
          })
      
          //-------------
          //- BAR CHART -
          //-------------
          var barChartCanvas = $('#barChart').get(0).getContext('2d')
          var barChartData = $.extend(true, {}, areaChartData)
          var temp0 = areaChartData.datasets[0]
          var temp1 = areaChartData.datasets[1]
          barChartData.datasets[0] = temp1
          barChartData.datasets[1] = temp0
      
          var barChartOptions = {
            responsive              : true,
            maintainAspectRatio     : false,
            datasetFill             : false
          }
      
          new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
          })
      
          //---------------------
          //- STACKED BAR CHART -
          //---------------------
          var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
          var stackedBarChartData = $.extend(true, {}, barChartData)
      
          var stackedBarChartOptions = {
            responsive              : true,
            maintainAspectRatio     : false,
            scales: {
              xAxes: [{
                stacked: true,
              }],
              yAxes: [{
                stacked: true
              }]
            }
          }
      
          new Chart(stackedBarChartCanvas, {
            type: 'bar',
            data: stackedBarChartData,
            options: stackedBarChartOptions
          })
        })
</script>
@endsection