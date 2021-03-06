
  <div class="modal fade bs-example-modal-lg" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h4 class="modal-title">INVOICES REPORT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="invoice/report1" enctype="multipart/form-data" >
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






  
  <div class="modal fade bs-example-modal-lg" id="modal-departreport" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h4 class="modal-title">INVOICES TOTALS PER DEPARTMENT </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="invoices/departreport" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                        

                        <div class="form-group">
                            <label>SELECT DATE RANGE</label>
                            <div>
                                <div class="input-daterange input-group" id="date-range2">
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



  <div class="modal fade bs-example-modal-lg" id="modal-payments" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h4 class="modal-title">PAYMENTS REPORT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="invoice/report2" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                        

                        <div class="form-group">
                            <label>SELECT DATE RANGE</label>
                            <div>
                                <div class="input-daterange input-group" id="date-range1">
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




  <div class="modal fade bs-example-modal-lg" id="modal-payinvoice" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-info">
          <h4 class="modal-title">COLLECT INVOICE PAYMENT </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form role="form" method="post" action="invoice/pay" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                    <div class="form-group row">
                        <label for="narration1" class="col-sm-2 col-form-label">Narration:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="narration1" name="narration1" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="customer1" class="col-sm-2 col-form-label">Customer:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="customer1" name="customer1" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="balance" class="col-sm-2 col-form-label"> Balance:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="balance1" name="balance1" disabled>
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
                            <input type="text" autocomplete="off" class="form-control" id="amount" name="amount" required>
                        </div>
                </div>

                <div class="form-group row">
                        <label for="sponsor_id" class="col-sm-2 col-form-label">Payment Method</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="payment_method" style="width: 100%;"  required>
                            <option value="">----Select Payment Method-----</option>
                                <option value="Cash">Cash</option>
                                <option value="Mpesa Paybill">Mpesa Paybill</option>
                                <option value="Bank Deposit">Bank Deposit</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="reference" class="col-sm-2 col-form-label"> Reference:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="reference" name="reference" required>
                        </div>
                    </div>


                </div>
                <!-- /.card-body -->
                <div class="modal-footer">
                    <input type="hidden" id="invoice_id" name="invoice_id" >
                    <button type="submit" class="btn btn-primary">SAVE</button>
                </div>
            </form>           
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


