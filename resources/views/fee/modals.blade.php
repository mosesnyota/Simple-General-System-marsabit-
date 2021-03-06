  <div class="modal fade bs-example-modal-lg" id="modal-addvotehead" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-info">
          <h4 class="modal-title">ADD SCHOOL FEES VOTEHEAD</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form role="form" method="post" action="feevotehead/store" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                    <div class="form-group row">
                        <label for="asset_category" class="col-sm-2 col-form-label">Votehead Name:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="votehead" name="votehead" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="asset_category" class="col-sm-2 col-form-label">Votehead Amount:</label>
                        <div class="col-sm-10">
                            <input type="number" autocomplete="off" class="form-control" id="amount" name="amount" required>
                        </div>
                    </div>


                </div>
                <!-- /.card-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">SAVE</button>
                </div>
            </form>           
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>




  <div class="modal fade bs-example-modal-lg" id="modal-payfee" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-info">
          <h4 class="modal-title">COLLECT SCHOOL FEES </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form role="form" method="post" action="fee/pay" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                    <div class="form-group row">
                        <label for="student_name" class="col-sm-2 col-form-label">Student Name:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="student_name" name="student_name" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="balance" class="col-sm-2 col-form-label">Current Balance:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="balance" name="balance" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                    <label for="budget" class="col-sm-2 col-form-label"> Date Paid: </label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <input type="text" class="form-control" autocomplete="off" id="datepicker-startdate" name="payment_date" required>
                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                    </div><!-- input-group -->
                    </div>
                </div> 


                <div class="form-group row">
                        <label for="amount" class="col-sm-2 col-form-label"> Amount:</label>
                        <div class="col-sm-10">
                            <input type="number" autocomplete="off" class="form-control" id="amount" name="amount" required>
                        </div>
                    </div>

                <div class="form-group row">
                        <label for="sponsor_id" class="col-sm-2 col-form-label">Payment Method</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="payment_method" style="width: 100%;"  required>
                            <option value="">----Select Payment Method-----</option>
                                <option value="Cash">Cash</option>
                                <option value="Mpesa">Mpesa</option>
                                <option value="Bank Deposit">Bank Deposit</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="amount" class="col-sm-2 col-form-label"> Reference:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="reference" name="reference" required>
                        </div>
                    </div>


                </div>
                <!-- /.card-body -->
                <div class="modal-footer">
                    <input type="hidden" id="student_id" name="student_id" >
                    <button type="submit" class="btn btn-primary">SAVE</button>
                </div>
            </form>           
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>






  <div class="modal fade bs-example-modal-lg" id="modal-addlocation" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-info">
          <h4 class="modal-title">ADD COURSE</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form role="form" method="post" action="courses/store" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                    <div class="form-group row">
                        <label for="asset_category" class="col-sm-2 col-form-label">Course Name:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="course_name" name="course_name" required>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">SAVE</button>
                </div>
            </form>           
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>