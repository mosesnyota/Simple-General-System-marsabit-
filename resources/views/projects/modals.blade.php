

<div class="modal fade" id="modal-addvotehead">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Votehead</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
  
                <form role="form" method="post" action="/finance/public/votehead/store" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                        <div class="form-group">
                          <div class="form-group">
                            <label>Votehead: </label>
                            <input type="text" name="votehead_name" id="votehead_name" class="form-control" placeholder="Votehead">
                        </div>
                        </div>
                        <label>Amount: </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar"></i></span>
                            </div>
                            <input type="number" name="amount_allocated" id="amount_allocated" class="form-control" placeholder="Amount">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                    <input type="hidden" name="project_id" value="{{$project->project_id}}" >
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
  

<div class="modal fade bs-example-modal-lg" id="modal-dispersfunds" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Record Funds Release</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="/finance/public/disbursment/store" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                        <div class="form-group row">
                            <label for="budget" class="col-sm-2 col-form-label">Date Issued</label>
                            <div class="col-sm-10">
                              <div class="input-group">
                                <input type="text" class="form-control" autocomplete="off" id="datepicker-autoclose" name="voucherdate" >
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div><!-- input-group -->
                            </div>
                        </div>
  

                    <div class="form-group row">
                            <label for="voucherno" class="col-sm-2 col-form-label">DBAM REF</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="voucherno" name="voucherno" placeholder="DBAM Code : Optional" >
                            </div>
                    </div> 
                

                    <div class="form-group row">
                        <label for="votehead_id" class="col-sm-2 col-form-label">Votehead</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="votehead_id" style="width: 100%;">
                                <option value=""></option>
                                @foreach ($voteheads as $votehead)
                                  <option value="{{$votehead ->votehead_id}}">{{$votehead ->votehead_name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>

                        
                        <div class="form-group row">
                            <label for="debit" class="col-sm-2 col-form-label">Amount</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar"></i></span>
                                    </div>
                                    <input type="number" name="debit" id="debit" class="form-control" placeholder="Amount">
                                </div>
                            </div>
                        </div>

  
                    

                        <div class="form-group row">
                            <label for="narration" class="col-sm-2 col-form-label">Narration</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="narration" name="narration" placeholder="Narration" required>
                            </div>
                          </div> 

                          <div class="form-group row">
                            <label for="paid_to" class="col-sm-2 col-form-label">Paid To</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="paid_to" name="paid_to" placeholder="Paid To: optional" >
                            </div>
                          </div> 


                          <div class="form-group row">
                            <label for="chequeno" class="col-sm-2 col-form-label">Ref/Cheque No</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="chequeno" name="chequeno" placeholder="Reference: optional" >
                            </div>
                          </div> 



                        


                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                    <input type="hidden" name="project_id" value="{{$project->project_id}}" >
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



  
   

  <div class="modal fade" id="modal-addactivity">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Critical Milestone</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
  
                <form role="form" method="post" action="/finance/public/activity/store" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                        <div class="form-group">
                          <div class="form-group">
                            <label>Activity Name </label>
                            <input type="text" name="activityname" id="activityname" class="form-control" placeholder="Activity Name">
                        </div>
                        </div>

                        <div class="form-group">
                            <label>Start Date</label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control" autocomplete="off" id="datepicker-startdate" name="start_date">
                                    <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                </div><!-- input-group -->
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Deadline Date</label>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control" autocomplete="off" id="datepicker-deadline" name="deadline_date">
                                    <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                           

                </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                    <input type="hidden" name="project_id" value="{{$project->project_id}}" >
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





  <div class="modal fade" id="modal-markactivity">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Mark Milestone Complete</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
  
                <form role="form" method="post" action="/finance/public/activity/update/1" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                       
                        <div class="form-group">
                            <div class="form-group">
                              <label>Activity Name </label>
                              <input type="text" name="userd" id="userd" disabled class="form-control" >
                          </div>
                          </div>

                          <div class="form-group">
                            
                            <div class="form-group">
                                <label for="curstatus" class="col-sm-2 col-form-label">Status</label>
                                <select class="form-control select2" name="curstatus" id="curstatus" style="width: 100%;">
                                    <option value="ongoing">Ongoing</option>
                                    <option value="Completed">Completed</option>
                                    <option value="onhold">On Hold</option>
                                </select>
                            </div>
                        </div>

        
                        
                        <div class="form-group">
                            <label>Date Completed</label>
                            <div class="input-group date" id="activityenddate" data-target-input="nearest">
                                <input type="text" name="activityenddate" class="form-control datetimepicker-input" data-target="#activityenddate"/>
                                <div class="input-group-append" data-target="#activityenddate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                           </div>
                </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                    <input type="hidden" name="userId" id="userId" class="form-control" >
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




  


  <div class="modal fade" id="modal-uploadexcel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">UPLOAD EXCEL FROM DBAMS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
  
                <form role="form" method="post" action="/finance/public/disbursment/uploadexcel" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
  
  
                        <div class="form-group">
                          <div class="form-group">
                            <label>Upload Excel/Csv from DBAMS </label>
                            <input type="file" accept=".xls,.xlsx,.csv" name="import_file" id="import_file" class="form-control" size="150">
                        </div>

                        
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                        <input type="hidden" name="project_id" value="{{$project->project_id}}" >
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





  
<div class="modal fade" id="modal-assignvotehead">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Assign Vote Head</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="/finance/public/viewproject/updatevoteheads/1" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                        <div class="form-group">
                            <div class="form-group">
                              <label>Narration </label>
                              <input type="text" name="narration22" id="narration22" disabled class="form-control" >
                          </div>
                          </div>
                       <div class="form-group">
                        <div class="form-group">
                          <label>Votehead </label>
                          <select class="form-control select2" name="votehead_id" style="width: 100%;">
                            <option value=""></option>
                            @foreach ($voteheads as $votehead)
                              <option value="{{$votehead ->votehead_id}}">{{$votehead ->votehead_name}}</option>
                            @endforeach
                        </select>
                      </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                        <input type="hidden" name="disbursmentid" id="disbursmentid" class="form-control" >
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


  


  
  <div class="modal fade bs-example-modal-lg" id="modal-addfunds" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ADD BUDGET TO PROJECT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form role="form" method="post" action="/finance/public/budget/store/{{$project->project_id}}" enctype="multipart/form-data" >
                    {{ csrf_field() }} 
                    <div class="box-body"> 
                        
  

                        <div class="form-group row">
                            <label for="debit" class="col-sm-2 col-form-label">Amount</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar"></i></span>
                                    </div>
                                    <input type="number" name="amount" id="debit" class="form-control" placeholder="Amount">
                                </div>
                            </div>
                        </div>

  
        
                    <div class="form-group row">
                            <label for="narration" class="col-sm-2 col-form-label">Narration</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="narration" name="narration" placeholder="Narration" required>
                            </div>
                        </div> 
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                    <input type="hidden" name="project_id" value="{{$project->project_id}}" >
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