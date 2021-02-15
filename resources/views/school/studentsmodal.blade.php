
  
  <div class="modal fade bs-example-modal-lg" id="modal-classlists" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h4 class="modal-title">GET STUDENTS REPORTS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="getclasslists" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                        

                    <div class="form-group row">
                        <label for="sponsor_id" class="col-sm-2 col-form-label">Course</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="course_id" style="width: 100%;"  required>
                                <option value="">----Select Course-----</option>
                                @foreach ($courses as $course)
                                  <option value="{{$course -> course_id}}">{{$course -> course_name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="sponsor_id" class="col-sm-2 col-form-label">Year</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="cur_year" style="width: 100%;"  required>
                                <option value="">----Select Year-----</option>
                                  <option value="1">1st Years</option>
                                  <option value="2">2nd Years</option>
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