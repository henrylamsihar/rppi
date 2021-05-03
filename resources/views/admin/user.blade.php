@extends('layouts.master')

@section('title2')
Customer List
@endsection

@section('content1')

<div class="box-body">       
                @if ($message = Session::get('message'))
                    <div class="alert alert-success martop-sm">
                        <p>{{ $message }}</p>
                    </div>
                @endif
<?php $no=1 ?>
                <table class="table table-responsive martop-sm">      
                    <thead>
                    
                        <th>ID user</th>
                        <th>Nama user</th>
                        <th>username</th>
                        <th>No. Telefon</th>
                        <th>Alamat</th>
                        <th>email</th>
                        <th>Action</th>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>  
                            <td>{{ $no++ }}</a></td>    
                            <td>{{ $user->fullname }}</a></td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->telephone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                            @if($user->verified == "0")
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info btn-sm">Approve</a>
                            @endif        
                                    </form>
                                </td>
                            </tr>
                            
                            
                        @endforeach
                    </tbody>
                </table>

{{--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  --}}
</body>



<!-- <script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script> -->


@endsection
