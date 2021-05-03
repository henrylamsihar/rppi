                @if ($message = Session::get('message'))
                    <div class="alert alert-success martop-sm">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <table class="table table-responsive martop-sm">      
                    <thead>
                    <a href="{{ route('category.create') }}" class="btn btn-info btn-sm">Tambah Kategori</a>
                    
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
                                    <form action="{{ route('category.destroy', $c->id) }}" method="post">
                                        {{csrf_field()}}
                                        {{ method_field('DELETE') }}
                                        <a href="{{ route('category.edit', $c->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>