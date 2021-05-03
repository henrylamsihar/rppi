@extends('layouts.master')

@section('title2')
Edit Toko
@endsection
@section('content1')


<form action="{{ route('tokokategori.update', $toko->id) }}" method="post">
    {{csrf_field()}}    
    {{ method_field('PUT') }}
    <div class="form-group {{ $errors->has('nameStore') ? 'has-error' : '' }}">
        <label for="nameStore" class="control-label">Nama Toko</label>
        <input type="text" class="form-control" name="nameStore" placeholder="nameStore" value="{{ $toko->nameStore }}">
        @if ($errors->has('nameStore'))
            <span class="help-block">{{ $errors->first('nameStore') }}</span>
        @endif
    </div>

    <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
        <label for="telephone" class="control-label">Nomor Telepon</label>
        <input type="text" class="form-control" name="telephone" value="{{ $toko->telephone }}" >
        @if ($errors->has('telephone'))
            <span class="help-block">{{ $errors->first('telephone') }}</span>
        @endif  
    </div>

    <div>
        <label for="addressStore" class="control-label">addressStore</label>
        <textarea name="addressStore" cols="30" rows="5" class="form-control">{{ $toko->addressStore }}</textarea>
      
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info">Simpan</button>
        <a href="{{ route('tokokategori.index') }}" class="btn btn-default">Kembali</a>
    </div>
</form>
@endsection