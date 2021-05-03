@extends('layouts.master')

@section('title2')
Tambah Toko
@endsection

@section('content1')

<form action="{{ route('tokokategori.store') }}" method="post">
    {{csrf_field()}}
    <div class="form-group {{ $errors->has('nameStore') ? 'has-error' : '' }}">
        <label for="nameStore" class="control-label">Nama Toko</label>
        <input type="text" class="form-control" name="nameStore">
        @if ($errors->has('nameStore'))
            <span class="help-block">{{ $errors->first('nameStore') }}</span>
        @endif  
    </div>
    
    <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
        <label for="telephone" class="control-label">Nomor Telepon</label>
        <input type="text" class="form-control" name="telephone">
        @if ($errors->has('telephone'))
            <span class="help-block">{{ $errors->first('telephone') }}</span>
        @endif  
    </div>

    <div class="form-group {{ $errors->has('addressStore') ? 'has-error' : '' }}">
        <label for="addressStore" class="control-label">Alamat Toko</label>
        <textarea name="addressStore" cols="30" rows="5" class="form-control"></textarea>
        @if ($errors->has('addressStore'))
            <span class="help-block">{{ $errors->first('addressStore') }}</span>
        @endif
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info">Simpan</button>
        <a href="{{ route('tokokategori.index') }}" class="btn btn-default">Kembali</a>
    </div>
</form>
@endsection