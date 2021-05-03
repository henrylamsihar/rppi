<div class="modal" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="form-product" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                        </button>
                        <h3 class="modal-title"></h3>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        
                        


                        <div class="form-group">
                          <label for="idProduct" class="col-md-3 control-label" >Nama Barang</label>
                          <div class="col-md-6">
                          <select class="form-control" name="idProduct" id="idProduct">
                            <option value="0" disable="true" selected="true">Pilih Product</option>
                                @foreach ($prod as $key => $value)
                                <option value="{{$value->id}}">{{ $value->nameProduct }} (Toko : {{$value->toko['nameStore']}})</option>
                                @endforeach

                            </select>
                              <span class="help-block with-errors"></span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="quantity" class="col-md-3 control-label">Jumlah</label>
                          <div class="col-md-2">
                          <input type="text" id="quantity" name="quantity" class="form-control" required onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                              
                              <span class="help-block with-errors"></span>
                          </div>
                        </div>

                       
                   
                  
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-save">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
