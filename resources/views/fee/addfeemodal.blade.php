  <div class="modal fade bs-example-modal-lg" id="modal-addfee" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-info">
          <h4 class="modal-title">ADD FEE TO THIS STUDENT </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form role="form" method="post" action="savenewfee" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                
               

                <div class="form-group row">
                        <label for="sponsor_id" class="col-sm-2 col-form-label">Votehead</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="votehead_id" style="width: 100%;"  required>
                            <option value="">----Select Votehead-----</option>
                            @foreach($voteheads as $votehead)
                                 <option value="{{$votehead->votehead_id}}">{{$votehead->votehead}}</option>
                            @endforeach
                               
                                
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="amount" class="col-sm-2 col-form-label"> Amount:</label>
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


  @php
                    $current_year = date('Y');
                    $lastyear = $current_year - 1;
                    $nextyear = $lastyear + 2;
  @endphp


  <div class="modal fade bs-example-modal-lg" id="modal-addfeeinv" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header modal-header-info">
          <h4 class="modal-title">ADD FEE INVOICE TO THIS STUDENT </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form role="form" method="post" action="addfeeinvoice" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                
               

                <div class="form-group row">
                        <label for="sponsor_id" class="col-sm-2 col-form-label">Votehead</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="votehead_id" style="width: 100%;"  required>
                            <option value="">----Select Votehead-----</option>
                            @foreach($voteheads as $votehead)
                                 <option value="{{$votehead->votehead_id}}">{{$votehead->votehead}}</option>
                            @endforeach
                               
                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="staff_id" class="col-sm-2 col-form-label">Year:</label>
                      <div class="col-sm-10">
                          <select class="form-control select2" name="inv_year" id="inv_year" style="width: 100%;"  required>
                              <option value="{{$lastyear}}">{{$lastyear}}</option>
                              <option selected value="{{$current_year}}">{{$current_year}}</option>
                              <option value="{{$nextyear}}">{{$nextyear}}</option>
                              
                          </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staff_id" class="col-sm-2 col-form-label">Term:</label>
                      <div class="col-sm-10">
                          <select class="form-control select2" name="term" id="term" style="width: 100%;"  required>
                              <option value="Term 1">Term 1</option>
                              <option selected value="Term 2">Term 2</option>
                              <option value="Term 3">Term 3</option>
                              
                          </select>
                      </div>
                    </div>



                    <div class="form-group row">
                        <label for="amount" class="col-sm-2 col-form-label"> Amount:</label>
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



