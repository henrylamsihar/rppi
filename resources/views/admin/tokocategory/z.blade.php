@extends('layouts.master')

@section('title2')
Tambah Produk
@endsection

@section('content1')

<form action="{{ route('tokokategori.store') }}" method="post">
    {{csrf_field()}}
    <div class="form-group {{ $errors->has('nameCategory') ? 'has-error' : '' }}">
        <label for="nameCategory" class="control-label">Nama Kategori</label>
        <input type="text" class="form-control" name="nameCategory" placeholder="nameCategory">
        @if ($errors->has('nameCategory'))
            <span class="help-block">{{ $errors->first('nameCategory') }}</span>
        @endif  
   
    <div class="form-group">
        <button type="submit" class="btn btn-info">Simpan</button>
        <a href="{{ route('tokokategori.index') }}" class="btn btn-default">Kembali</a>
    </div>
</form>
@endsection