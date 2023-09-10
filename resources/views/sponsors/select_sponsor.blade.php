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
                            <h4 class="page-title m-0">Assign Sponsorshipt to: {{$student->first_name." ".$student->middle_name." ".$student->surname}}</h4>
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
            <div class="col-8">
                <div class="card m-b-30">
                    <div class="card-body">

                    <form role="form" method="post" action="savesponsorship" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group row">
                                <label for="sponsornames" class="col-sm-2 col-form-label">Student</label>
                                <div class="col-sm-10">
                                <input type="text" autocomplete="off" class="form-control" id="studentid" name="studentid" value = "{{$student->first_name.' '.$student->middle_name.' '.$student->surname}}" disabled>
                                </div>
                            </div>
                            

                            <div class="form-group row">
                              <label for="currency" class="col-sm-2 col-form-label">Sponsorship Type</label>
                              <div class="col-sm-10">
                                  <select class="form-control select2" name="sponsorshiptype" style="width: 100%;" required>
                                        <option value="">--SELECT SPONSORSHIP TYPE--</option>
                                        <option value="Full">Full Scholarship</option>
                                        <option value="Partial">Partial</option>
                                  </select>
                              </div>
                            </div>


                            <div class="form-group row">
                              <label for="currency" class="col-sm-2 col-form-label">Sponsor</label>
                              <div class="col-sm-10">
                                  <select class="form-control select2" name="sponsor_id" style="width: 100%;" required>
                                        <option value="">--SELECT SPONSOR--</option>
                                    @foreach($sponsors as $sponsor)
                                        <option value="{{$sponsor->sponsor_id}}">{{$sponsor->sponsornames}}</option>
                                    @endforeach
                                  </select>
                              </div>
                            </div>
        
                          
                            <div class="form-group row">
                                <label for="address" class="col-sm-2 col-form-label">Comment</label>
                                <div class="col-sm-10">
                                <input type="text" autocomplete="off" class="form-control" id="comment" name="comment"  >
                                </div>
                            </div>
        
                           
                            
        
                        </div>
                        <!-- /.card-body -->
                        

                        <div class="modal-footer center" style="text-align: center;">
                            <button type="submit" class="btn btn-primary text-center">Save</button>
                        </div>
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