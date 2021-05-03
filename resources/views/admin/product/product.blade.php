
@extends('layouts.master')

@section('title1')
Product
@endsection

@section('content1')
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" href="{{ asset('assets/bootstrap/favicon.ico') }}">



    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- dataTables --}}
    <link href="{{ asset('assets/datatables/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ asset('assets/bootstrap/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">
    {{-- SweetAlert2 --}}
      <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
      <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">


    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="{{ asset('assets/bootstrap/js/ie-emulation-modes-warning.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Daftar Barang
                        <a onclick="addForm()" class="btn btn-primary pull-right" style="margin-top: -8px;">Tambah Barang</a>
                    </h4>
                </div>
                <div class="panel-body">

                    <table id="product-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th width="30">No</th>
                                <th>Photo</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Supplier</th>
                                <th>Modal</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('admin.product.form')

      </div>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('assets/jquery/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
window.onload = function() {
    document.cookie = "hasjs=true";
}
</script>

    {{-- dataTables --}}
    <script src="{{ asset('assets/dataTables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/dataTables/js/dataTables.bootstrap.min.js') }}"></script>

    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{ asset('assets/bootstrap/js/ie10-viewport-bug-workaround.js') }}"></script>

    <script type="text/javascript">
      $('#product-table').DataTable({
                      processing: true,
                      serverSide: true,
                      ajax: "{{ route('api.product') }}",
                      columns: [
                        {data: 'id', name: 'id'},
                        {data: 'show_photo', name: 'show_photo'},
                        {data: 'nameProduct', name: 'nameProduct'},
                        {data: 'nameCategory', name: 'nameCategory'},
                        {data: 'nameStore', name: 'nameStore'},
                        {data: 'priceModal', name: 'priceModal'},
                        {data: 'price', name: 'price'},
                        {data: 'description', name: 'description'},

                        {data: 'action', name: 'action', orderable: false, searchable: false}
                      ], responsive: true
                    });

                    function editForm(id) {
                        save_method = 'edit';
                        $('input[name=_method]').val('PATCH');
                        $('#modal-form form')[0].reset();
                        $.ajax({
                        url: "{{ url('product') }}" + '/' + id + "/edit",
                        type: "GET",
                        dataType: "JSON",
                        success: function(data) {
                            $('#modal-form').modal('show');
                            $('.modal-title').text('Edit Produk');
                            $('#id').val(data.id);
                            $('#nameProduct').val(data.nameProduct);
                            $('#priceModal').val(data.priceModal);
                            $('#price').val(data.price);
                            $('#description').val(data.description);
                            $('#idCategory').val(data.idCategory);
                            $('#idStore').val(data.idStore);
                            $('#price').val(data.price);
                        
                        },
                        error : function() {
                            alert("Nothing Data");
                        }
                        });
                    }

                    function deleteData(id){
                        var csrf_token = $('meta[name="csrf-token"]').attr('content');
                        swal({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            type: 'warning',
                            showCancelButton: true,
                            cancelButtonColor: '#d33',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, delete it!'
                        }).then(function () {
                            $.ajax({
                                url : "{{ url('product') }}" + '/' + id,
                                type : "POST",
                                data : {'_method' : 'DELETE', '_token' : csrf_token},
                                success : function(data) {
                                    $('#product-table').DataTable().ajax.reload();
                                    swal({
                                        title: 'Success!',
                                        text: data.message,
                                        type: 'success',
                                        timer: '1500'
                                    })
                                },
                                error : function () {
                                    swal({
                                        title: 'Oops...',
                                        text: data.message,
                                        type: 'error',
                                        timer: '1500'
                                    })
                                }
                            });
                        });
                        }

                    function addForm() {
                        save_method = "add";
                        $('input[name=_method]').val('POST');
                        $('#modal-form').modal('show');
                        $('#modal-form form')[0].reset();
                        $('.modal-title').text('Add Product');
                      }
                    $(function(){
                        $('#modal-form form').validator().on('submit', function (e) {
                            if (!e.isDefaultPrevented()){
                                var id = $('#id').val();
                                if (save_method == 'add') url = "{{ url('product') }}";
                                else url = "{{ url('product') . '/' }}" + id;
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
