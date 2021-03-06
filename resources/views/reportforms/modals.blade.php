

  

<div class="modal fade bs-example-modal-lg" id="modal-recordmarks" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h4 class="modal-title">RECORD EXAM MARKS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="marks/proceed" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                        
                    <div class="form-group row">
                        <label for="subject" class="col-sm-2 col-form-label">Course</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="course_id" style="width: 100%;">
                            <option selected value="">---------------Select Course---------------</option>
                            @foreach($courses as $course)
                                <option  value="{{$course ->course_id}}">{{$course ->course_name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>


                      <div class="form-group row">
                        <label for="subject_id" class="col-sm-2 col-form-label">Subject</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="subject_id" style="width: 100%;">
                            <option selected value="">---------------Select Subject---------------</option>
                            @foreach($subjects as $subject)
                                <option  value="{{$subject ->subject_id}}">{{$subject ->subject_name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="subject" class="col-sm-2 col-form-label">Year</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="examyear" style="width: 100%;">
                            <option selected value="">---------------Select Year---------------</option>
                                <option  value="1">Year 1</option>
                                <option  value="2">Year 2</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                                    <label for="term" class="col-sm-2 col-form-label">Term</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="term" style="width: 100%;" required>
                                                <option selected value="">---------------Select Term---------------</option>
                                                <option  value="Term 1 {{date('Y')}}"> Term 1 {{date('Y')}}</option>
                                                <option  value="Term 1 {{date('Y')}}">Term 2 {{date('Y')}}</option>
                                                <option  value="Term 1 {{date('Y')}}">Term 3 {{date('Y')}}</option>
                                       
                                        </select>
                                    </div>
                    </div>

                    <div class="form-group row">
                                    <label for="examtype" class="col-sm-2 col-form-label">Exam Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="examtype" style="width: 100%;" required>
                                                <option selected value="">---------------Select Exam Type---------------</option>
                                                <option  value="Mid Term">Mid Term</option>
                                                <option   value="End Term">End Term</option>
                                               
                                       
                                        </select>
                                    </div>
                    </div>


                   
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                      
                        
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Proceed To Record</button>
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


  
