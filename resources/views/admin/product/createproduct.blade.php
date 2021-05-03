@extends('layouts.master')

@section('title1')
Tambah Produk
@endsection

@section('content1')

<form action="{{ route('product.store') }}" method="post">
    {{csrf_field()}}
    <div class="form-group {{ $errors->has('nameProduct') ? 'has-error' : '' }}">
        <label for="nameProduct" class="control-label">Nama Produk</label>
        <input type="text" class="form-control" name="nameProduct" placeholder="nameProduct">
        @if ($errors->has('nameProduct'))
            <span class="help-block">{{ $errors->first('nameProduct') }}</span>
        @endif  
    </div>
    <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
        <label for="price" class="control-label">price</label>
        <textarea name="price" cols="30" rows="5" class="form-control"></textarea>
        @if ($errors->has('price'))
            <span class="help-block">{{ $errors->first('price') }}</span>
        @endif
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info">Simpan</button>
        <a href="{{ route('product.index') }}" class="btn btn-default">Kembali</a>
    </div>
</form>
@endsection