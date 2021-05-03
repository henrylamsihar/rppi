@extends('layouts.master')

@section('content1')



<div class="col-md-6">
          <!-- Toko Rekanan -->
       


<table class="table table-responsive martop-sm">       
                    <thead>
                    

                        <th width=50%>Nama Barang</th>
                        <th width=10%>Quantity</th>
                        <th width=50%>Unit</th>
                    </thead>
                    <tbody>
                    
                        @foreach ($orderdetails as $o)
                        <form action="{{ route('pesanan.update', $o->idOrder) }}" method="post">
                        {{csrf_field()}}    
                        {{ method_field('PUT') }}
                    
                    
                            <tr>  
                    
                            <input type="hidden" class="form-control" name="id[]" placeholder="id{{$o->id}}" value=" {{$o->id}}" style="width: 50px; height:25px; hidden:true"></a>

                            <td><label for="quantity{{$o->id}}" class="control-label">{{$o->product['nameProduct']}}</label></a></td>    
                            <td><input class="form-control" name="quantity[]" placeholder="quantity{{$o->id}}" value=" {{$o->quantity}}" style="width: 50px; height:25px"></a></td>
                            <td> {{$o->unit}}</td>
                         
                            </tr>
                        @endforeach
                    </tbody>
                </table>



    <div class="form-group">
        <button type="submit" class="btn btn-info">Konfirmasi Pesanan</button>
        <a href="{{ route('pesanan.dec', $o->idOrder) }}" class="btn btn-danger">Tolak Pesanan</a>
        <a href="{{ route('pesanan.index') }}" class="btn btn-default">Kembali</a>
    </div>
</form>

</div>







@endsection