@extends('layouts.master')

@section('title2')
Edit Kategori
@endsection

@section('content1')

<form action="{{ route('tokokategori.update', $cat->id) }}" method="post">
    {{csrf_field()}}    
    {{ method_field('PUT') }}
    <div class="form-group {{ $errors->has('nameCategory') ? 'has-error' : '' }}">
        <label for="nameCategory" class="control-label">Nama Kategori</label>
        <input type="text" class="form-control" name="nameCategory" placeholder="nameCategory" value="{{ $cat->nameCategory }}">
        @if ($errors->has('nameCategory'))
            <span class="help-block">{{ $errors->first('nameCategory') }}</span>
        @endif
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-info">Simpan</button>
        <a href="{{ route('tokokategori.index') }}" class="btn btn-default">Kembali</a>
    </div>
</form>
@endsection