@extends('layouts.master')

@section('title1')
Product
@endsection

@section('content1')
 
<body>
    <div class="box-body">
  {{--  <div class="container martop-lg">  --}}
      {{--  <div class="panel panel-default">  --}}
          {{--  <div class="panel-body">  --}}
            <a href="{{ route('product.create') }}" class="btn btn-info btn-sm">Tambah Produk Baru</a>
  
  @if ($message = Session::get('message'))
      <div class="alert alert-success martop-sm">
          <p>{{ $message }}</p>
      </div>
  @endif

  <table class="table table-responsive martop-sm">
      <thead>
          <th>Image</th>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Action</th>
      </thead>
      <tbody>
          @foreach ($products as $product)
              <tr>
                <td width="5%"><img src="/adminlte/product/{{ $product->img_product}}" height="30px" width="30px" /></td>
                  
                  <td><a href="{{ route('product.show', $product->id) }}">{{ $product->nameProduct }}</a></td>
                  <td>{{ $product->price }}</td>
                  <td>
                      <form action="{{ route('product.destroy', $product->id) }}" method="post">
                          {{csrf_field()}}
                          {{ method_field('DELETE') }}
                          <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                          <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                      </form>
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>
</div>
          {{--  </div>  --}}
      {{--  </div>  --}}
  {{--  </div>  --}}
  
  {{--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  --}}
</body>
@endsection
