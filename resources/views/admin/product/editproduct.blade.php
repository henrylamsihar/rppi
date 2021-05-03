@extends('layouts.master')

@section('content1')

<h4>Ubah Artikel</h4>
<form action="{{ route('product.update', $product->id) }}" method="post">
    {{csrf_field()}}    
    {{ method_field('PUT') }}
    <div class="form-group {{ $errors->has('nameProduct') ? 'has-error' : '' }}">
        <label for="nameProduct" class="control-label">nameProduct</label>
        <input type="text" class="form-control" name="nameProduct" placeholder="nameProduct" value="{{ $product->nameProduct }}">
        @if ($errors->has('nameProduct'))
            <span class="help-block">{{ $errors->first('nameProduct') }}</span>
        @endif
    </div>
    <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
        <label for="price" class="control-label">price</label>
        <textarea name="price" cols="30" rows="5" class="form-control">{{ $product->price }}</textarea>
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