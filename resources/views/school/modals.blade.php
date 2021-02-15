

  

<div class="modal fade bs-example-modal-lg" id="modal-addfundings" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h4 class="modal-title">RECORD RECEIVED FUNDS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="funds/store" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                        <div class="form-group row">
                            <label for="funding_date" class="col-sm-2 col-form-label">Date Received</label>
                            <div class="col-sm-10">
                              <div class="input-group">
                                <input type="text" class="form-control" autocomplete="off" id="datepicker-autoclose" name="funding_date" placeholder="Click here to select date">
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div><!-- input-group -->
                            </div>
                        </div>

                    <div class="form-group row">
                        <label for="original_amount" class="col-sm-2 col-form-label">Amount:</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar"></i></span>
                                </div>
                                <input type="number" name="original_amount" id="original_amount" class="form-control" placeholder="Amount in Original Currency">
                            </div>
                        </div>
                    </div>

                    

                      <div class="form-group row">
                        <label for="currency" class="col-sm-2 col-form-label">Currency</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="currency" style="width: 100%;">
                                  <option value="">--SELECT CURRENCY--</option>
                                  <option value="USD">USD</option>
                                  <option value="Euro">Euro</option>
                                  <option value="KSH">KSH</option>
                                  <option value="TSH">TSH</option>
                                  <option value="$">$</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exchangerate" class="col-sm-2 col-form-label">Exchange Rate</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar"></i></span>
                                </div>
                                <input type="number" name="exchangerate" id="exchangerate" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sponsor_id" class="col-sm-2 col-form-label">Financier/Source</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="sponsor_id" style="width: 100%;">
                                <option value="">--SELECT SOURCE OF FUNDS--</option>
                                @foreach ($sponsors as $sponsor)
                                  <option value="{{$sponsor ->sponsor_id}}">{{$sponsor ->sponsornames}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>

                   
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                        <input type="hidden" name="final_amount" id="final_amount" value='1'>
                        
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




  

  

<div class="modal fade bs-example-modal-lg" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h4 class="modal-title">RECEIVED FUNDS REPORT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="funds/report1" enctype="multipart/form-data" >
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


  
