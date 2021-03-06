

  

<div class="modal fade bs-example-modal-lg" id="modal-createrole" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h4 class="modal-title">ADD USER ROLES</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="roles/store" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Role:</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                               
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name of the Role">
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>           
            </div>
  
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>



  <div class="modal fade bs-example-modal-lg" id="modal-createpermission" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h4 class="modal-title">ADD PERMISSION</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="permissions/store" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Permission Name:</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                               
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name of the Permission">
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>           
            </div>
  
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  

  



  