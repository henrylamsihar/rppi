@extends('layouts.master')

@section('title2')
Toko Rekanan dan Kategori
@endsection

@section('content1')

<body>
  <div class="box-body">
{{--  <div class="container martop-lg">  --}}
    {{--  <div class="panel panel-default">  --}}
        {{--  <div class="panel-body">  --}}
        <div class="row">
        <div class="col-md-7">
          <!-- Toko Rekanan -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <!-- <i class="fa fa-bar-chart-o"></i> -->

              <h3 class="box-title">Toko Rekanan</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">       
                @if ($message = Session::get('message'))
                    <div class="alert alert-success martop-sm">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <table class="table table-responsive martop-sm">      
                    <thead>
                    <a href="{{ route('tokokategori.create') }}" class="btn btn-info btn-sm">Tambah Toko Baru</a>
                    
                        <th>ID Toko</th>
                        <th>Nama Toko</th>
                        <th>Alamat</th>
                        <th>No. Telefon</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($tokos as $toko)
                            <tr>  
                            <td>{{ $toko->id }}</a></td>    
                            <td>{{ $toko->nameStore }}</a></td>
                            <td>{{ $toko->addressStore }}</td>
                            <td>{{ $toko->telephone }}</td>
                            <td>
                                    <form action="{{ route('tokokategori.destroytoko', $toko->id) }}" method="post">
                                        {{csrf_field()}}
                                        {{ method_field('DELETE') }}
                                        <a href="{{ route('tokokategori.edit', $toko->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            
                            
                        @endforeach
                    </tbody>
                </table>
                </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-5">
          <!-- Bar chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              

              <h3 class="box-title">Kategori</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            @if ($message = Session::get('message'))
                    <div class="alert alert-success martop-sm">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <table class="table table-responsive martop-sm">      
                    <thead>
                    <a href="{{ route('tokokategori.create2') }}" class="btn btn-info btn-sm">Tambah Kategori</a>
                    
                        <th>No</th>
                        <th>Nama Kategori</th>
                        
                        <th>Action</th>
                    </thead>
                    <tbody>
                    
                        @foreach ($cat as $c)
                            <tr>  
                            <td>{{ $c->id }}</a></td>    
                            <td>{{ $c->nameCategory }}</a></td>
                            <td>
                                    <form action="{{ route('tokokategori.destroycategory', $c->id) }}" method="post">
                                        {{csrf_field()}}
                                        {{ method_field('DELETE') }}
                                        <a href="{{ route('tokokategori.editcategory', $c->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->

          </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


    

{{--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  --}}
</body>



<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>


@endsection
