@extends('layouts.master')

@section('title1')
Dashbaord
@endsection

@section('title2')
Catatan Penjualan April 2019
@endsection

@section('content1')

 <!-- Bootstrap 3.3.7 -->
 <link rel="stylesheet" href="adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Morris charts -->
  <link rel="stylesheet" href="adminlte/bower_components/morris.js/morris.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="adminlte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="adminlte/dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="adminlte/bower_components/morris.js/morris.css">
<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/adminlte/bower_components/morris.js/morris.min.js"></script>
<script src="/adminlte/bower_components/raphael/raphael.min.js"></script>
<script src="/adminlte/bower_components/fastclick/lib/fastclick.js"></script>


<?php use Carbon\Carbon; 
// $curmon = Carbon::now();
// $curmon = date('M Y', strtotime($curmon) );
$m0 = date("M Y", strtotime("now"));
$m1 = date("M Y", strtotime("-1 months"));
$m2 = date("M Y", strtotime("-2 months"));
$m3 = date("M Y", strtotime("-3 months"));
$m4 = date("M Y", strtotime("-4 months"));
$m5 = date("M Y", strtotime("-5 months"));
?>
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$countorder}}</h3>

              <p>Transaksi</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><sup style="font-size: 20px">Rp</sup> {{ $amount }}</h3>

              <p>Pendapatan Kotor</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
            <h3><sup style="font-size: 20px">Rp</sup> {{$shu}}</h3>

              <p>SHU</p>
            </div>
            <!-- <div class="icon">
              <i class="ion ion-person-add"></i>
            </div> -->
            <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$nproduct}}</h3>

              <p>Produk Sedang dijual</p>
            </div>
            <!-- <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div> -->
            <a class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->





<div class="row">
  <div class="col-lg-8 col-xs-6">
          <!-- AREA CHART -->
        
            
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#chart1" data-toggle="tab">{{$m0}}</a></li>
              <li><a href="#chart2" data-toggle="tab">{{$m1}}</a></li>
              <li><a href="#chart3" data-toggle="tab">{{$m2}}</a></li>
              <li><a href="#chart4" data-toggle="tab">{{$m3}}</a></li>
              <li><a href="#chart5" data-toggle="tab">{{$m4}}</a></li>
              <li><a href="#chart6" data-toggle="tab">{{$m5}}</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="chart1" style="position: relative; height: 300px; "></div>
              <div class="tab-pane chart" id="chart2" style="position: relative; height: 300px; "></div>
              <div class="chart tab-pane" id="chart3" style="position: relative; height: 300px; "></div>
              <div class="chart tab-pane" id="chart4" style="position: relative; height: 300px; "></div>
              <div class="chart tab-pane" id="chart5" style="position: relative; height: 300px; "></div>
              <div class="chart tab-pane" id="chart6" style="position: relative; height: 300px; "></div>
            </div>
            </div>  </div>

            <div class="col-md-4">
            <b></b>
           
           
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-arrow-circle-o-up"></i>
              <h4 class="box-title">Produk Paling Laku</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul>
            
                <!--   -->
           

            <table style="width: 100%;">
            @foreach($data3 as $dt)
  <tr>
    <td ><li>{{$dt['nameProduct']}}</li></td>
    <td align="right">({{$dt['totalqtty']}})</td>
  </tr>
  @endforeach
</table>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
            </div>
            </div>
         


<script>
  $(function () {
    "use strict";
    const monthNames = ["<?php echo 1 ?>", "<?php echo 2 ?>", "<?php echo 3 ?>", "<?php echo 4 ?>", "<?php echo 5 ?>","<?php echo 6 ?>", "<?php echo 7 ?>", "<?php echo 8 ?>", "<?php echo 9 ?>", "<?php echo 10 ?>",
    "<?php echo 11 ?>", "<?php echo 12 ?>", "<?php echo 13 ?>", "<?php echo 14 ?>", "<?php echo 15 ?>","<?php echo 16 ?>", "<?php echo 17 ?>", "<?php echo 18 ?>", "<?php echo 19 ?>", "<?php echo 20 ?>",
    "<?php echo 21 ?>", "<?php echo 22 ?>", "<?php echo 23 ?>", "<?php echo 24 ?>", "<?php echo 25 ?>","<?php echo 26 ?>", "<?php echo 27 ?>", "<?php echo 28 ?>", "<?php echo 29 ?>", "<?php echo 30 ?>","<?php echo 31 ?>",   
  ];
    // AREA CHART
    var area = new Morris.Area({
      element: 'chart1',
      resize: true,
      data: [
        {y: 0, item1: "<?php echo $d[0][0] ?>"},
        {y: 1, item1: "<?php echo $d[0][1] ?>"},
        {y: 2, item1: "<?php echo $d[0][2] ?>"},
        {y: 3, item1: "<?php echo $d[0][3] ?>"},
        {y: 4, item1: "<?php echo $d[0][4] ?>"},
        {y: 5, item1: "<?php echo $d[0][5] ?>"},
        {y: 6, item1: "<?php echo $d[0][6] ?>"},
        {y: 7, item1: "<?php echo $d[0][7] ?>"},
        {y: 8, item1: "<?php echo $d[0][8] ?>"},
        {y: 9, item1: "<?php echo $d[0][9] ?>"},
        {y: 10, item1: "<?php echo $d[0][10] ?>"},
        {y: 11, item1: "<?php echo $d[0][11] ?>"},
        {y: 12, item1: "<?php echo $d[0][12] ?>"},
        {y: 13, item1: "<?php echo $d[0][13] ?>"},
        {y: 14, item1: "<?php echo $d[0][14] ?>"},
        {y: 15, item1: "<?php echo $d[0][15] ?>"},
        {y: 16, item1: "<?php echo $d[0][16] ?>"},
        {y: 17, item1: "<?php echo $d[0][17] ?>"},
        {y: 18, item1: "<?php echo $d[0][18] ?>"},
        {y: 19, item1: "<?php echo $d[0][19] ?>"},
        {y: 20, item1: "<?php echo $d[0][20] ?>"},
        {y: 21, item1: "<?php echo $d[0][21] ?>"},
        {y: 22, item1: "<?php echo $d[0][22] ?>"},
        {y: 23, item1: "<?php echo $d[0][23] ?>"},
        {y: 24, item1: "<?php echo $d[0][24] ?>"},
        {y: 25, item1: "<?php echo $d[0][25] ?>"},
        {y: 26, item1: "<?php echo $d[0][26] ?>"},
        {y: 27, item1: "<?php echo $d[0][27] ?>"},
        {y: 28, item1: "<?php echo $d[0][28] ?>"},
        {y: 29, item1: "<?php echo $d[0][29] ?>"},
        {y: 30, item1: "<?php echo $d[0][30] ?>"},
      

      ],
      xkey: 'y',
      parseTime: false,
      ykeys: ['item1'],
      xLabelFormat: function (x) {
            var index = parseInt(x.src.y);
            return monthNames[index];
        },
        xLabels: "month",
        labels: ['Pendapatan Kotor(Rupiah)'],
        lineColors: ['#a0d0e0', '#3dbeee'],
        hideHover: 'auto'
    });
  });
</script>

<script>
  $(function () {
    "use strict";
    const monthNames = ["<?php echo 1 ?>", "<?php echo 2 ?>", "<?php echo 3 ?>", "<?php echo 4 ?>", "<?php echo 5 ?>","<?php echo 6 ?>", "<?php echo 7 ?>", "<?php echo 8 ?>", "<?php echo 9 ?>", "<?php echo 10 ?>",
    "<?php echo 11 ?>", "<?php echo 12 ?>", "<?php echo 13 ?>", "<?php echo 14 ?>", "<?php echo 15 ?>","<?php echo 16 ?>", "<?php echo 17 ?>", "<?php echo 18 ?>", "<?php echo 19 ?>", "<?php echo 20 ?>",
    "<?php echo 21 ?>", "<?php echo 22 ?>", "<?php echo 23 ?>", "<?php echo 24 ?>", "<?php echo 25 ?>","<?php echo 26 ?>", "<?php echo 27 ?>", "<?php echo 28 ?>", "<?php echo 29 ?>", "<?php echo 30 ?>","<?php echo 31 ?>",   
  ];
    // AREA CHART
    ;
    var area = new Morris.Area({
      element: 'chart2',
      resize: true,
      data: [
        {y: 0, item1: "<?php echo $d[1][0] ?>"},
        {y: 1, item1: "<?php echo $d[1][1] ?>"},
        {y: 2, item1: "<?php echo $d[1][2] ?>"},
        {y: 3, item1: "<?php echo $d[1][3] ?>"},
        {y: 4, item1: "<?php echo $d[1][4] ?>"},
        {y: 5, item1: "<?php echo $d[1][5] ?>"},
        {y: 6, item1: "<?php echo $d[1][6] ?>"},
        {y: 7, item1: "<?php echo $d[1][7] ?>"},
        {y: 8, item1: "<?php echo $d[1][8] ?>"},
        {y: 9, item1: "<?php echo $d[1][9] ?>"},
        {y: 10, item1: "<?php echo $d[1][10] ?>"},
        {y: 11, item1: "<?php echo $d[1][11] ?>"},
        {y: 12, item1: "<?php echo $d[1][12] ?>"},
        {y: 13, item1: "<?php echo $d[1][13] ?>"},
        {y: 14, item1: "<?php echo $d[1][14] ?>"},
        {y: 15, item1: "<?php echo $d[1][15] ?>"},
        {y: 16, item1: "<?php echo $d[1][16] ?>"},
        {y: 17, item1: "<?php echo $d[1][17] ?>"},
        {y: 18, item1: "<?php echo $d[1][18] ?>"},
        {y: 19, item1: "<?php echo $d[1][19] ?>"},
        {y: 20, item1: "<?php echo $d[1][20] ?>"},
        {y: 21, item1: "<?php echo $d[1][21] ?>"},
        {y: 22, item1: "<?php echo $d[1][22] ?>"},
        {y: 23, item1: "<?php echo $d[1][23] ?>"},
        {y: 24, item1: "<?php echo $d[1][24] ?>"},
        {y: 25, item1: "<?php echo $d[1][25] ?>"},
        {y: 26, item1: "<?php echo $d[1][26] ?>"},
        {y: 27, item1: "<?php echo $d[1][27] ?>"},
        {y: 28, item1: "<?php echo $d[1][28] ?>"},
        {y: 29, item1: "<?php echo $d[1][29] ?>"},
        {y: 30, item1: "<?php echo $d[1][30] ?>"},
      ],
      
      xkey: 'y',
      parseTime: false,
      ykeys: ['item1'],
      xLabelFormat: function (x) {
            var index = parseInt(x.src.y);
            return monthNames[index];
        },
        xLabels: "month",
        labels: ['Pendapatan Kotor(Rupiah)'],
        lineColors: ['#a0d0e0', '#3dbeee'],
        hideHover: 'auto',
        responsive: true
    });
  });
</script>
<script>
  $(function () {
    "use strict";
    const monthNames = ["<?php echo 1 ?>", "<?php echo 2 ?>", "<?php echo 3 ?>", "<?php echo 4 ?>", "<?php echo 5 ?>","<?php echo 6 ?>", "<?php echo 7 ?>", "<?php echo 8 ?>", "<?php echo 9 ?>", "<?php echo 10 ?>",
    "<?php echo 11 ?>", "<?php echo 12 ?>", "<?php echo 13 ?>", "<?php echo 14 ?>", "<?php echo 15 ?>","<?php echo 16 ?>", "<?php echo 17 ?>", "<?php echo 18 ?>", "<?php echo 19 ?>", "<?php echo 20 ?>",
    "<?php echo 21 ?>", "<?php echo 22 ?>", "<?php echo 23 ?>", "<?php echo 24 ?>", "<?php echo 25 ?>","<?php echo 26 ?>", "<?php echo 27 ?>", "<?php echo 28 ?>", "<?php echo 29 ?>", "<?php echo 30 ?>","<?php echo 31 ?>",   
  ];
    // AREA CHART
    var area = new Morris.Area({
      element: 'chart3',
      resize: true,
      data: [
        {y: 0, item1: "<?php echo $d[2][0] ?>"},
        {y: 1, item1: "<?php echo $d[2][1] ?>"},
        {y: 2, item1: "<?php echo $d[2][2] ?>"},
        {y: 3, item1: "<?php echo $d[2][3] ?>"},
        {y: 4, item1: "<?php echo $d[2][4] ?>"},
        {y: 5, item1: "<?php echo $d[2][5] ?>"},
        {y: 6, item1: "<?php echo $d[2][6] ?>"},
        {y: 7, item1: "<?php echo $d[2][7] ?>"},
        {y: 8, item1: "<?php echo $d[2][8] ?>"},
        {y: 9, item1: "<?php echo $d[2][9] ?>"},
        {y: 10, item1: "<?php echo $d[2][10] ?>"},
        {y: 11, item1: "<?php echo $d[2][11] ?>"},
        {y: 12, item1: "<?php echo $d[2][12] ?>"},
        {y: 13, item1: "<?php echo $d[2][13] ?>"},
        {y: 14, item1: "<?php echo $d[2][14] ?>"},
        {y: 15, item1: "<?php echo $d[2][15] ?>"},
        {y: 16, item1: "<?php echo $d[2][16] ?>"},
        {y: 17, item1: "<?php echo $d[2][17] ?>"},
        {y: 18, item1: "<?php echo $d[2][18] ?>"},
        {y: 19, item1: "<?php echo $d[2][19] ?>"},
        {y: 20, item1: "<?php echo $d[2][20] ?>"},
        {y: 21, item1: "<?php echo $d[2][21] ?>"},
        {y: 22, item1: "<?php echo $d[2][22] ?>"},
        {y: 23, item1: "<?php echo $d[2][23] ?>"},
        {y: 24, item1: "<?php echo $d[2][24] ?>"},
        {y: 25, item1: "<?php echo $d[2][25] ?>"},
        {y: 26, item1: "<?php echo $d[2][26] ?>"},
        {y: 27, item1: "<?php echo $d[2][27] ?>"},
        {y: 28, item1: "<?php echo $d[2][28] ?>"},
        {y: 29, item1: "<?php echo $d[2][29] ?>"},
        {y: 30, item1: "<?php echo $d[2][30] ?>"},
      ],
      xkey: 'y',
      parseTime: false,
      ykeys: ['item1'],
      xLabelFormat: function (x) {
            var index = parseInt(x.src.y);
            return monthNames[index];
        },
        xLabels: "month",
        labels: ['Pendapatan Kotor(Rupiah)'],
        lineColors: ['#a0d0e0', '#3dbeee'],
        hideHover: 'auto'
    });
  });
</script>

<script>
  $(function () {
    "use strict";
    const monthNames = ["<?php echo 1 ?>", "<?php echo 2 ?>", "<?php echo 3 ?>", "<?php echo 4 ?>", "<?php echo 5 ?>","<?php echo 6 ?>", "<?php echo 7 ?>", "<?php echo 8 ?>", "<?php echo 9 ?>", "<?php echo 10 ?>",
    "<?php echo 11 ?>", "<?php echo 12 ?>", "<?php echo 13 ?>", "<?php echo 14 ?>", "<?php echo 15 ?>","<?php echo 16 ?>", "<?php echo 17 ?>", "<?php echo 18 ?>", "<?php echo 19 ?>", "<?php echo 20 ?>",
    "<?php echo 21 ?>", "<?php echo 22 ?>", "<?php echo 23 ?>", "<?php echo 24 ?>", "<?php echo 25 ?>","<?php echo 26 ?>", "<?php echo 27 ?>", "<?php echo 28 ?>", "<?php echo 29 ?>", "<?php echo 30 ?>","<?php echo 31 ?>",   
  ];
    // AREA CHART
    var area = new Morris.Area({
      element: 'chart4',
      resize: true,
      data: [
        {y: 0, item1: "<?php echo $d[3][0] ?>"},
        {y: 1, item1: "<?php echo $d[3][1] ?>"},
        {y: 2, item1: "<?php echo $d[3][2] ?>"},
        {y: 3, item1: "<?php echo $d[3][3] ?>"},
        {y: 4, item1: "<?php echo $d[3][4] ?>"},
        {y: 5, item1: "<?php echo $d[3][5] ?>"},
        {y: 6, item1: "<?php echo $d[3][6] ?>"},
        {y: 7, item1: "<?php echo $d[3][7] ?>"},
        {y: 8, item1: "<?php echo $d[3][8] ?>"},
        {y: 9, item1: "<?php echo $d[3][9] ?>"},
        {y: 10, item1: "<?php echo $d[3][10] ?>"},
        {y: 11, item1: "<?php echo $d[3][11] ?>"},
        {y: 12, item1: "<?php echo $d[3][12] ?>"},
        {y: 13, item1: "<?php echo $d[3][13] ?>"},
        {y: 14, item1: "<?php echo $d[3][14] ?>"},
        {y: 15, item1: "<?php echo $d[3][15] ?>"},
        {y: 16, item1: "<?php echo $d[3][16] ?>"},
        {y: 17, item1: "<?php echo $d[3][17] ?>"},
        {y: 18, item1: "<?php echo $d[3][18] ?>"},
        {y: 19, item1: "<?php echo $d[3][19] ?>"},
        {y: 20, item1: "<?php echo $d[3][20] ?>"},
        {y: 21, item1: "<?php echo $d[3][21] ?>"},
        {y: 22, item1: "<?php echo $d[3][22] ?>"},
        {y: 23, item1: "<?php echo $d[3][23] ?>"},
        {y: 24, item1: "<?php echo $d[3][24] ?>"},
        {y: 25, item1: "<?php echo $d[3][25] ?>"},
        {y: 26, item1: "<?php echo $d[3][26] ?>"},
        {y: 27, item1: "<?php echo $d[3][27] ?>"},
        {y: 28, item1: "<?php echo $d[3][28] ?>"},
        {y: 29, item1: "<?php echo $d[3][29] ?>"},
        {y: 30, item1: "<?php echo $d[3][30] ?>"},
      ],
      xkey: 'y',
      parseTime: false,
      ykeys: ['item1'],
      xLabelFormat: function (x) {
            var index = parseInt(x.src.y);
            return monthNames[index];
        },
        xLabels: "month",
        labels: ['Pendapatan Kotor(Rupiah)'],
        lineColors: ['#a0d0e0', '#3dbeee'],
        hideHover: 'auto'
    });
  });
</script>

<script>
  $(function () {
    "use strict";
    const monthNames = ["<?php echo 1 ?>", "<?php echo 2 ?>", "<?php echo 3 ?>", "<?php echo 4 ?>", "<?php echo 5 ?>","<?php echo 6 ?>", "<?php echo 7 ?>", "<?php echo 8 ?>", "<?php echo 9 ?>", "<?php echo 10 ?>",
    "<?php echo 11 ?>", "<?php echo 12 ?>", "<?php echo 13 ?>", "<?php echo 14 ?>", "<?php echo 15 ?>","<?php echo 16 ?>", "<?php echo 17 ?>", "<?php echo 18 ?>", "<?php echo 19 ?>", "<?php echo 20 ?>",
    "<?php echo 21 ?>", "<?php echo 22 ?>", "<?php echo 23 ?>", "<?php echo 24 ?>", "<?php echo 25 ?>","<?php echo 26 ?>", "<?php echo 27 ?>", "<?php echo 28 ?>", "<?php echo 29 ?>", "<?php echo 30 ?>","<?php echo 31 ?>",   
  ];
    // AREA CHART
    var area = new Morris.Area({
      element: 'chart5',
      resize: true,
      data: [
        {y: 0, item1: "<?php echo $d[4][0] ?>"},
        {y: 1, item1: "<?php echo $d[4][1] ?>"},
        {y: 2, item1: "<?php echo $d[4][2] ?>"},
        {y: 3, item1: "<?php echo $d[4][3] ?>"},
        {y: 4, item1: "<?php echo $d[4][4] ?>"},
        {y: 5, item1: "<?php echo $d[4][5] ?>"},
        {y: 6, item1: "<?php echo $d[4][6] ?>"},
        {y: 7, item1: "<?php echo $d[4][7] ?>"},
        {y: 8, item1: "<?php echo $d[4][8] ?>"},
        {y: 9, item1: "<?php echo $d[4][9] ?>"},
        {y: 10, item1: "<?php echo $d[4][10] ?>"},
        {y: 11, item1: "<?php echo $d[4][11] ?>"},
        {y: 12, item1: "<?php echo $d[4][12] ?>"},
        {y: 13, item1: "<?php echo $d[4][13] ?>"},
        {y: 14, item1: "<?php echo $d[4][14] ?>"},
        {y: 15, item1: "<?php echo $d[4][15] ?>"},
        {y: 16, item1: "<?php echo $d[4][16] ?>"},
        {y: 17, item1: "<?php echo $d[4][17] ?>"},
        {y: 18, item1: "<?php echo $d[4][18] ?>"},
        {y: 19, item1: "<?php echo $d[4][19] ?>"},
        {y: 20, item1: "<?php echo $d[4][20] ?>"},
        {y: 21, item1: "<?php echo $d[4][21] ?>"},
        {y: 22, item1: "<?php echo $d[4][22] ?>"},
        {y: 23, item1: "<?php echo $d[4][23] ?>"},
        {y: 24, item1: "<?php echo $d[4][24] ?>"},
        {y: 25, item1: "<?php echo $d[4][25] ?>"},
        {y: 26, item1: "<?php echo $d[4][26] ?>"},
        {y: 27, item1: "<?php echo $d[4][27] ?>"},
        {y: 28, item1: "<?php echo $d[4][28] ?>"},
        {y: 29, item1: "<?php echo $d[4][29] ?>"},
        {y: 30, item1: "<?php echo $d[4][30] ?>"},
      ],
      xkey: 'y',
      parseTime: false,
      ykeys: ['item1'],
      xLabelFormat: function (x) {
            var index = parseInt(x.src.y);
            return monthNames[index];
        },
        xLabels: "month",
        labels: ['Pendapatan Kotor(Rupiah)'],
        lineColors: ['#a0d0e0', '#3dbeee'],
        hideHover: 'auto'
    });
  });
</script>

<script>
  $(function () {
    "use strict";
    const monthNames = ["<?php echo 1 ?>", "<?php echo 2 ?>", "<?php echo 3 ?>", "<?php echo 4 ?>", "<?php echo 5 ?>","<?php echo 6 ?>", "<?php echo 7 ?>", "<?php echo 8 ?>", "<?php echo 9 ?>", "<?php echo 10 ?>",
    "<?php echo 11 ?>", "<?php echo 12 ?>", "<?php echo 13 ?>", "<?php echo 14 ?>", "<?php echo 15 ?>","<?php echo 16 ?>", "<?php echo 17 ?>", "<?php echo 18 ?>", "<?php echo 19 ?>", "<?php echo 20 ?>",
    "<?php echo 21 ?>", "<?php echo 22 ?>", "<?php echo 23 ?>", "<?php echo 24 ?>", "<?php echo 25 ?>","<?php echo 26 ?>", "<?php echo 27 ?>", "<?php echo 28 ?>", "<?php echo 29 ?>", "<?php echo 30 ?>","<?php echo 31 ?>",   
  ];
    // AREA CHART
    var area = new Morris.Area({
      element: 'chart6',
      resize: true,
      data: [
        {y: 0, item1: "<?php echo $d[5][0] ?>"},
        {y: 1, item1: "<?php echo $d[5][1] ?>"},
        {y: 2, item1: "<?php echo $d[5][2] ?>"},
        {y: 3, item1: "<?php echo $d[5][3] ?>"},
        {y: 4, item1: "<?php echo $d[5][4] ?>"},
        {y: 5, item1: "<?php echo $d[5][5] ?>"},
        {y: 6, item1: "<?php echo $d[5][6] ?>"},
        {y: 7, item1: "<?php echo $d[5][7] ?>"},
        {y: 8, item1: "<?php echo $d[5][8] ?>"},
        {y: 9, item1: "<?php echo $d[5][9] ?>"},
        {y: 10, item1: "<?php echo $d[5][10] ?>"},
        {y: 11, item1: "<?php echo $d[5][11] ?>"},
        {y: 12, item1: "<?php echo $d[5][12] ?>"},
        {y: 13, item1: "<?php echo $d[5][13] ?>"},
        {y: 14, item1: "<?php echo $d[5][14] ?>"},
        {y: 15, item1: "<?php echo $d[5][15] ?>"},
        {y: 16, item1: "<?php echo $d[5][16] ?>"},
        {y: 17, item1: "<?php echo $d[5][17] ?>"},
        {y: 18, item1: "<?php echo $d[5][18] ?>"},
        {y: 19, item1: "<?php echo $d[5][19] ?>"},
        {y: 20, item1: "<?php echo $d[5][20] ?>"},
        {y: 21, item1: "<?php echo $d[5][21] ?>"},
        {y: 22, item1: "<?php echo $d[5][22] ?>"},
        {y: 23, item1: "<?php echo $d[5][23] ?>"},
        {y: 24, item1: "<?php echo $d[5][24] ?>"},
        {y: 25, item1: "<?php echo $d[5][25] ?>"},
        {y: 26, item1: "<?php echo $d[5][26] ?>"},
        {y: 27, item1: "<?php echo $d[5][27] ?>"},
        {y: 28, item1: "<?php echo $d[5][28] ?>"},
        {y: 29, item1: "<?php echo $d[5][29] ?>"},
        {y: 30, item1: "<?php echo $d[5][30] ?>"},
      ],
      xkey: 'y',
      parseTime: false,
      ykeys: ['item1'],
      xLabelFormat: function (x) {
            var index = parseInt(x.src.y);
            return monthNames[index];
        },
        xLabels: "month",
        labels: ['Pendapatan Kotor(Rupiah)'],
        lineColors: ['#a0d0e0', '#3dbeee'],
        hideHover: 'auto'
    });
  });
  </script>



@endsection