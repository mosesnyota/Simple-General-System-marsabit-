
  

<div class="modal fade bs-example-modal-lg" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h4 class="modal-title">PRINT FEE INVOICES</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="expense/report1" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                        

                    <div class="form-group row">
                        <label for="category_id" class="col-sm-2 col-form-label"> Category</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" autocomplete="off" name="category_id" style="width: 100%;" required>
                                <option value="">--SELECT TERM--</option>
                                <option value="Term 1">Term 1</option>
                                  <option value="Term 2">Term 2</option>
                                  <option value="Term 3">Term 3</option>
                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="paidto" class="col-sm-2 col-form-label"> Status </label>
                        <div class="col-sm-10">
                            <select class="form-control select2" autocomplete="off" name="cur_status" style="width: 100%;" required>
                                <option value="">--SELECT YEAR--</option>
                                  <option value="2022">2022</option>
                                  <option value="2021">2021</option>
                                  <option value="2023">2023</option>
                            </select>
                        </div>
                    </div>


                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">GET REPORT</button>
                    </div>
                </form>           
            </div>
  
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  




