@extends('layouts.design')
@section('content')
<!-- Start content -->
<div class="content">

<!-- Top Bar Start -->
<div class="topbar">

</div>
<!-- Top Bar End -->

<div class="page-content-wrapper ">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title m-0">GET STUDENT'S FEE REPORTS</h4>
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

                     <!-- form start -->
              
                <div class="modal-body">
              
                    <form role="form" method="post" action="getstudentfeeslist" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                <div class="box-body"> 
                   
                  
                  @php
                    $current_year = date('Y');
                    $lastyear = $current_year - 1;
                    $nextyear = $lastyear + 1;
                  @endphp
                 
                    <div class="form-group row">
                    <label for="staff_id" class="col-sm-1 col-form-label">Course:</label>
                    <div class="col-sm-3">
                          <select class="form-control select2" name="course_id" id="course_id" style="width: 100%;"  required>
                              <option value="All">All Courses</option>
                              @foreach ($courses as $course)
                                <option value="{{$course -> course_id}}">{{$course -> course_name}}</option>
                              @endforeach
                          </select>
                      </div>

                      <label for="staff_id" class="col-sm-1 col-form-label">Type</label>
                      <div class="col-sm-3">
                          <select class="form-control select2" name="students_type" id="students_type" style="width: 100%;"  required>
                             
                              <option selected value="All"> Both Current & Past Students</option>
                              <option value="Active">Current Students Only</option>
                              <option value="Past">Past Students Only</option>
                              
                          </select>
                      </div>
                      <label for="staff_id" class="col-sm-1 col-form-label">Gender</label>
                      <div class="col-sm-2">
                          <select class="form-control select2" name="gender" id="gender" style="width: 100%;"  required>
                              <option value="All">All</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                          </select>
                      </div>

                      <button type="submit" class="btn btn-sm btn-primary">Get List</button>
                     

                    </div>
                 </div>        
                </form>        
            </div>
                        
                       
                       
                          
                </div>
                <!-- /.card-body -->
                
                
                <!-- /.card-footer -->
              
                       

                        

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->    


       
        


        

    </div><!-- container fluid -->


        </div> <!-- end row --> 




</div> <!-- Page content Wrapper -->

</div> <!-- content -->



<!-- End Right content here -->
@endsection