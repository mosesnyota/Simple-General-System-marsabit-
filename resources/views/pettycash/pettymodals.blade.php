
  <div class="modal fade" id="modal-addfunds">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h4 class="modal-title">Add Funds to Petty Cash</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
  
                <form role="form" method="post" action="pettycash/store" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                   

                        <div class="form-group row">
                            <label for="transaction_date" class="col-sm-2 col-form-label">Date:</label>
                            <div class="col-sm-10">
                              <div class="input-group">
                                <input type="text" class="form-control" placeholder="Click here to select date" autocomplete="off" id="datepicker-deadline" name="transaction_date">
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div><!-- input-group -->
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="amount" class="col-sm-2 col-form-label">Amount:</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar"></i></span>
                                    </div>
                                    <input type="number" name="amount" id="amount" class="form-control" placeholder="Amount">
                                </div>
                            </div>
                        </div>


  
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Narration:</label>
                            <div class="col-sm-10">
                                <input type="text" autocomplete="off" class="form-control" id="description" name="description" required>
                            </div>
                        </div>

                        
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                        <input type="hidden" name="transactiontype" value="Deposit" >
                        <input type="hidden" name="issuedto" value="-" >
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



  <div class="modal fade bs-example-modal-lg" id="modal-issuefunds" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-info">
          <h4 class="modal-title">Issue Petty Cash</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <form role="form" method="post" action="pettycash/store" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                    
                    <div class="form-group row">
                        <label for="transaction_date" class="col-sm-2 col-form-label">Date Issued:</label>
                        <div class="col-sm-10">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Click here to select date" autocomplete="off" id="datepicker-startdate" name="transaction_date">
                            <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                        </div><!-- input-group -->
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="issuedto" class="col-sm-2 col-form-label">Issued To:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="issuedto" name="issuedto" required>
                        </div>
                    </div>
  
                    <div class="form-group row">
                      <label for="amount" class="col-sm-2 col-form-label">Amount:</label>
                      <div class="col-sm-10">
                          <input type="number" autocomplete="off" class="form-control" id="amount" name="amount" required>
                      </div>
                  </div>
  
                  <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Narration: </label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="description" name="description" required>
                        </div>
                    </div>  


                    <div class="form-group row">
                        <label for="cur_status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="cur_status" style="width: 100%;"  required>
                               
                                <option value="">-----------Select Status of this Transaction ------------</option>
                                  <option value="Complete">Completed</option>
                                  <option value="Incomplete">To be Completed</option>
                               
                                
                            </select>
                        </div>
                    </div>



                      


                </div>
                <!-- /.card-body -->
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="transactiontype" value="Withdraw" >
                    
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


  
  <div class="modal fade bs-example-modal-lg" id="modal-pettycashreport" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h4 class="modal-title">PETTY CASH REPORT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="pettycash/report1" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                        

                        <div class="form-group">
                            <label>SELECT DATE RANGE</label>
                            <div>
                                <div class="input-daterange input-group" id="date-range">
                                    <input type="text" autocomplete="off" class="form-control" name="start" placeholder="Start Date" />
                                    <input type="text" autocomplete="off" class="form-control" name="end" placeholder="End Date" />
                                </div>
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





