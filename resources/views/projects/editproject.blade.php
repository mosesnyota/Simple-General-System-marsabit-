@extends('layouts.design')
@section('content')
<!-- Start content -->
<div class="content">



<div class="page-content-wrapper ">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title m-0">Edit Project</h4>
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end page-title-box -->
            </div>
        </div> 
        <!-- end page title -->

        

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="../../../editproject/saveupdatedproject/{{$project->project_id}}" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                          <div class="card-body">
                            <div class="form-group row">
                              <label for="project_name" class="col-sm-2 col-form-label">Project Name</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="project_name" name="project_name" value="{{$project ->project_name}}">
                              </div>
                            </div> 
                            <div class="form-group row">
                              <label for="location" class="col-sm-2 col-form-label">Location</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="location" name="location" value="{{$project ->location}}">
                              </div>
                            </div>
                              
                          
          
                          <div class="form-group row">
                            <label for="budget" class="col-sm-2 col-form-label">Start Date</label>
                            <div class="col-sm-10">
                              <div class="input-group">
                                <input type="text" class="form-control" value="{{ date('m/d/Y', strtotime( $project ->start_date)) }}" id="datepicker-startdate" name="start_date">
                                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                            </div><!-- input-group -->
                            </div>
                        </div>
                            
                        <div class="form-group row">
                          <label for="budget" class="col-sm-2 col-form-label">Deadline</label>
                          <div class="col-sm-10">
                            <div class="input-group">
                              <input type="text" class="form-control" value="{{ date('m/d/Y', strtotime( $project ->deadline)) }}" id="datepicker-deadline" name="deadline">
                              <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                          </div><!-- input-group -->
                          </div>
                      </div>
                          
                              <div class="form-group row">
                                  <label for="sponsor_id" class="col-sm-2 col-form-label">Funded By</label>
                                  <div class="col-sm-10">
                                      <select class="form-control select2" name="sponsor_id" style="width: 100%;">
                                          @foreach ($sponsors as $sponsor)
                                              @if ($sponsor->sponsor_id == $project ->sponsor_id)
                                                <option selected value="{{$sponsor -> sponsor_id}}">{{$sponsor -> sponsornames}}</option>
                                              @else
                                              <option value="{{$sponsor -> sponsor_id}}">{{$sponsor -> sponsornames}}</option>
                                             @endif
                                            
                                          @endforeach
                                          
                                      </select>
                                  </div>
                              </div>
                              
                              <div class="form-group row">
                                <label for="staff_id" class="col-sm-2 col-form-label">Assigned to:</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="staff_id" id="staff_id" style="width: 100%;">
                                       
                                        @foreach ($staffs as $staff)
                                             @if ($staff ->staffid == $project ->staff_id)
                                             <option selected value="{{$staff -> staffid}}">{{$staff ->firstname ." ". $staff ->othernames}}</option>
                                             @else
                                             <option value="{{$staff -> staffid}}">{{$staff ->firstname ." ". $staff ->othernames}}</option>
                                             @endif
          
                                          
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                              
                          
                          
                          <div class="form-group row">
                              <label for="budget" class="col-sm-2 col-form-label">Total Budget</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="budget" name="budget" value="{{$project ->budget}}">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="details" class="col-sm-2 col-form-label">Project Details</label>
                              <div class="col-sm-10">
                                <textarea class="form-control" rows="5" name="details" id="details" >{{$project ->details}}</textarea>
                              </div>
                          </div>
                              
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer">
                              <div class="col text-center">
                                  <button type="submit" class="btn btn-secondary">Save Project</button>
                              </div>
                            
                          </div>
                          
                          <!-- /.card-footer -->
                        </form>
                    
              
                       

                        

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->            

    </div><!-- container fluid -->

</div> <!-- Page content Wrapper -->

</div> <!-- content -->



<!-- End Right content here -->
@endsection