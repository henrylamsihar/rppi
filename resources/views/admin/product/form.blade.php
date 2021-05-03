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
                            <label for="nameProduct" class="col-md-3 control-label">Name</label>
                            <div class="col-md-6">
                                <input type="text" id="nameProduct" name="nameProduct" class="form-control" autofocus required>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                          <label for="priceModal" class="col-md-3 control-label">Harga Modal</label>
                          <div class="col-md-6">
                              <input type="priceModal" id="priceModal" name="priceModal" class="form-control" required>
                              <span class="help-block with-errors"></span>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="price" class="col-md-3 control-label">Harga</label>
                          <div class="col-md-6">
                              <input type="price" id="price" name="price" class="form-control" required>
                              <span class="help-block with-errors"></span>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="idStore" class="col-md-3 control-label" >Toko</label>
                          <div class="col-md-6">
                          <select class="form-control" name="idStore" id="idStore">
                            <option id="idStore" disable="true" selected="true">Pilih Toko</option>
                                @foreach ($toko as $key => $value)
                                <option value="{{$value->id}}">{{ $value->nameStore }}</option>
                                @endforeach

                            </select>
                              <span class="help-block with-errors"></span>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="idCategory" class="col-md-3 control-label">Category</label>
                          <div class="col-md-6">
                          <select class="form-control" name="idCategory" id="idCategory">
                            <option id="idCategory" disable="true" selected="true">Pilih Kategori</option>
                                @foreach ($category as $key => $value)
                                <option value="{{$value->id}}">{{ $value->nameCategory }}</option>
                                @endforeach

                            </select>
                              <span class="help-block with-errors"></span>
                          </div>
                        </div>

                       

                        
                        <div class="form-group">
                        <label for="imgProduct" class="col-md-3 control-label">imgProduct</label>
                        <div class="col-md-6">
                            <input type="file" id="imgProduct" name="imgProduct" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                          <label for="description" class="col-md-3 control-label">Description</label>
                          <div class="col-md-6">
                          <textarea type="description" id="description" name="description" cols="30" rows="5" class="form-control">asd</textarea>
                       
                              <span class="help-block with-errors"></span>
                          </div>
                        </div>
                   
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-save">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    
