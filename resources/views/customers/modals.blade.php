
  <div class="modal fade bs-example-modal-lg" id="modal-addcustomer" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Customer</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form role="form" method="post" action="customers/store" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                  <div class="form-group row">
                    <label for="supplier_name" class="col-sm-2 col-form-label">Name/Organization</label>
                    <div class="col-sm-10">
                    <input type="text" autocomplete="off" class="form-control" id="customer_names" name="customer_names"  required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                    <input type="text" autocomplete="off" class="form-control" id="address" name="address" required>
                    </div>
                </div>
               
                     <div class="form-group row">
                      <label for="email" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                          <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                  </div>
                                  <input type="text" name="email" id="email" class="form-control"
                                  autocomplete="off" required>
                          </div>
                      </div>
                  </div>
                    
              <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" autocomplete="off" name="phone" id="phone" class="form-control" required>                        </div>
                </div>
            </div>
                </div>
                <!-- /.card-body -->
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>           
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>