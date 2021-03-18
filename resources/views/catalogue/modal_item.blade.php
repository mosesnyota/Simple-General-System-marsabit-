
  <div class="modal fade bs-example-modal-lg" id="modal-additem" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-info">
          <h4 class="modal-title">ADD ITEM</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <form role="form" method="post" action="saveitem" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
 
 
                <div class="form-group row">
                      <label for="asset_name" class="col-sm-2 col-form-label">Item Name:</label>
                      <div class="col-sm-10">
                          <input type="text"  class="form-control" id="name" name="name" required>
                      </div>
                  </div>

 
                   <div class="form-group row">
                        <label for="barcode" class="col-sm-2 col-form-label">Quantity:</label>
                        <div class="col-sm-10">
                            <input type="number" autocomplete="off" class="form-control" id="quantity" name="quantity" required>
                        </div>
                    </div>

                    

            
                </div>
                <!-- /.card-body -->
                  <div class="text-center">
                  
                    <input type="hidden"  id="asset_id" name="asset_id" >
                    <button type="submit" class="btn btn-lg btn-primary">SAVE</button>
                  </div>
                
            </form>           
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>






  <div class="modal fade bs-example-modal-lg" id="modal-additem2" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-info">
          <h4 class="modal-title">ADD ITEM</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <form role="form" method="post" action="saveitem" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
 
 
                <div class="form-group row">
                      <label for="asset_name" class="col-sm-2 col-form-label">Item Name:</label>
                      <div class="col-sm-10">
                          <input type="text"  class="form-control" id="name" name="name" required>
                      </div>
                  </div>

 
                   <div class="form-group row">
                        <label for="barcode" class="col-sm-2 col-form-label">Quantity:</label>
                        <div class="col-sm-10">
                            <input type="number" autocomplete="off" class="form-control" id="quantity" name="quantity" required>
                        </div>
                    </div>

                    

            
                </div>
                <!-- /.card-body -->
                  <div class="text-center">
                  
                    <input type="hidden"  id="asset_id" name="asset_id" >
                    <button type="submit" class="btn btn-lg btn-primary">SAVE</button>
                  </div>
                
            </form>           
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>




