@extends('layouts.master')

@section('title1')
Pesanan
@endsection
@section('title2')
Daftar Pesanan
@endsection

@section('content1')
 
<body>
    

        <!-- /.box-header -->
       
            <div class="box-header">
            
              <!-- <h3 class="box-title">Daftar Pesanan</h3> -->
              <div>
            <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a> -->
            <a onclick="addForm()" class="btn btn-sm btn-info pull-left" style="margin-top: -8px;">Tambah Transaksi Baru</a>
        
            </div>
            <!-- /.box-header -->
           
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                
                <tr>
                  <th>No</th>
                  <th>OrderID</th>
                  <th>Pembeli</th>
                  <th>Kontak</th>
                  <th>Order Date</th>
                  <!-- <th>Tanggal Penerimaan</th> -->
                  <!-- <th>Barang</th> -->
                  <th>Alamat</th>
                  <th >Status</th>
                  <th width="5%"></th>
          
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                @foreach ($orders as $order)
                
                <tr>
                <td align="center">{{ $no }}</td>
                <td><a href="{{ route('pesanan.show', $order->id) }}">Order{{ $order->id }}</a></td>

                @if ($order->user == NULL) <td>No Name</td>   
                @else <td>{{ $order->user->fullname }}</td> 
                @endif
                <td>{{ $order->telephone }}</td>
                <!-- <td>{{ $order->orderDate }}</td> -->
                <td>{{ $order->deliveryDate }}</td>
               
           
                <?php
                //  <td>
                // <!-- @foreach ($order->orderdetail as $prod)
                //     {{$prod->product['nameProduct']}}
                //     ({{$prod['quantity']}}                
                //     {{$prod['unit']}}),
                
                // @endforeach 
                // </td>
                ?>
                
                <td>{{ $order->address }}</td>
                
                @if ( $order->statusOrder === "Pesanan dibatalkan")
                    <td align="center" valign="middle" style=" text-align: center; vertical-align: middle;"><span class="label label-danger" >Pesanan dibatalkan</span></td>
                @elseif( $order->statusOrder === "Transaksi berhasil")
                    <td align="center" valign="middle" style=" text-align: center; vertical-align: middle;"><span class="label label-info">{{ $order->statusOrder }}</span></td>
                @else  
                    <td align="center" valign="middle" style=" text-align: center; vertical-align: middle;"><span class="label label-success">{{ $order->statusOrder }}</span></td>
                @endif


                <td align="center">
                @if ( $order->statusOrder === "Pesanan dibatalkan")

                @elseif ( $order->statusOrder === "Pesanan menunggu konfirmasi") 
                <a href="{{ route('pesanan.editorderdetail', $order->id) }}" class="btn btn-warning btn-sm">Konfirmasi Barang</a>

                @elseif ( $order->statusOrder === "Pesanan siap dikirim") 
                <div class="btn-group">
                  <!-- <button type="button" class="btn btn-info">Action</button> -->
                  <a href="{{ route('pesanan.send', $order->id) }}"> <button type="button" class="btn btn-sm btn-info dropdown-toggle"  >Pesanan dikirim</button></a>
                 
                 
                </div>
                @endif
                </td>
                </tr>
                <?php $no++; ?>
                @endforeach
              
              
                
              </table>
     
              @include('admin.formtransaksi')
              </div>
            

 
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/adminlte/css/skins/_all-skins.min.css">



<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
<!-- jQuery 3 -->
<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery 3 -->
<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->

<!-- DataTables -->
<script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="/adminlte/js/demo.js"></script> -->
<!-- page script -->
<script>
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "columnDefs": [
    { "orderable": false, "targets": 7 }
  ]
    })
  })

  function addForm() {
                        save_method = "add";
                        $('input[name=_method]').val('POST');
                        $('#modal-form').modal('show');
                        $('#modal-form form')[0].reset();
                        $('.modal-title').text('Tambah Transaksi Baru');
                      }
      $(function(){
          $('#modal-form form').validator().on('submit', function (e) {
              if (!e.isDefaultPrevented()){
                  var id = $('#id').val();
                  url = "{{ url('pesanan') }}";
                  // else url = "{{ url('product') . '/' }}" + id;
                  $.ajax({
                      url : url,
                      type : "POST",
//                        data : $('#modal-form form').serialize(),
                      data: new FormData($("#modal-form form")[0]),
                      contentType: false,
                      processData: false,
                      success : function(data) {
                          $('#modal-form').modal('hide');
                          $('#product-table').DataTable().ajax.reload();
                          swal({
                              title: 'Success!',
                              text: data.message,
                              type: 'success',
                              timer: '1500'
                          })
                      },
                      error : function(data){
                          swal({
                              title: 'Oops...',
                              text: data.message,
                              type: 'error',
                              timer: '1500'
                          })
                      }
                  });
                  return false;
              }
          });
      }); 
</script>
</body>
@endsection
