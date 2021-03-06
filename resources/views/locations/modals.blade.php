  <div class="modal fade bs-example-modal-lg" id="modal-addlocation" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-info">
          <h4 class="modal-title">ADD STORE or LOCATION</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <form role="form" method="post" action="locations/store" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                    
                    

                    <div class="form-group row">
                        <label for="store_name" class="col-sm-2 col-form-label">Store Name:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="store_name" name="store_name" required>
                        </div>
                    </div>
  
                    <div class="form-group row">
                      <label for="description" class="col-sm-2 col-form-label">Description:</label>
                      <div class="col-sm-10">
                          <input type="text" autocomplete="off" class="form-control" id="description" name="description" placeholder="Optional">
                      </div>
                  </div>
  
                  


                </div>
                <!-- /.card-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>           
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>