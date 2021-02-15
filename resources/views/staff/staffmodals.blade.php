<div class="modal fade bs-example-modal-lg" id="modal_newstaff" tabindex="-1" role="dialog"
aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add New Staff</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form role="form" method="post" action="staff/store" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box-body">
    

                    <div class="form-group row">
                        <label for="firstname" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="firstname" name="firstname" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="othernames" class="col-sm-2 col-form-label">Other Name</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="othernames" name="othernames" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="staffcategory_id" class="col-sm-2 col-form-label">Staff Role</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="staffcategory_id" style="width: 100%;"  required>
                                <option value=""></option>
                                @foreach ($roles as $role)
                                  <option value="{{$role->id}}">{{$role ->name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>


                    


                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" autocomplete="off" name="phone" id="phone" class="form-control" required>
                              
                            </div>
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
                        <label for="chequeno" class="col-sm-2 col-form-label">Temporary Password:</label>
                        <div class="col-sm-10">
                            <input type="password" autocomplete="off" class="form-control" id="password" name="password">
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

