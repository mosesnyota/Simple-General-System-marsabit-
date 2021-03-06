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
                            <h4 class="page-title m-0">CREATE FEES INVOICE</h4>
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
              
                    <form role="form" method="post" action="savefeeinvoice" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                <div class="box-body"> 
                    <div class="form-group row">
                      <label for="staff_id" class="col-sm-2 col-form-label">Course:</label>
                      <div class="col-sm-10">
                          <select class="form-control select2" name="course_id" id="course_id" style="width: 100%;"  required>
                              <option value="">----Select Course-----</option>
                              @foreach ($courses as $course)
                                <option value="{{$course -> course_id}}">{{$course -> course_name}}</option>
                              @endforeach
                          </select>
                      </div>
                    </div>
                  
                  @php
                    $current_year = date('Y');
                    $lastyear = $current_year - 1;
                    $nextyear = $lastyear + 1;
                  @endphp
                 
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


                    @foreach($voteheads as $votehead)
                    <div class="form-group row">
                        <label for="asset_category" class="col-sm-2 col-form-label">{{$votehead->votehead}}:</label>
                        <div class="col-sm-10">
                            <input type="number" autocomplete="off" class="form-control"  name="{{$votehead->votehead_id}}" value="{{$votehead->amount}}" >
                        </div>
                    </div>
                    @endforeach
                  
                                 
                
                                </div>
                                <!-- /.card-body -->
                                <div class="modal-footer center">
                                  
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form> 
                            
    
                        
                       
                        </div>
                        
                       
                       
                    </form>           
                </div>
                <!-- /.card-body -->
                
                
                <!-- /.card-footer -->
              
                       

                        

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->            

    </div><!-- container fluid -->

</div> <!-- Page content Wrapper -->

</div> <!-- content -->



<!-- End Right content here -->
@endsection