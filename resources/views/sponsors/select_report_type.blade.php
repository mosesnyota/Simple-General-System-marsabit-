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
                            <h4 class="page-title m-0">SELECT REPORT TYPE TO GENERATE PDF OF SPONSORED STUDENTS</h4>
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

                    <form role="form" method="post" action="getsponsoredstudent" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                           
                            <div class="form-group row">
                              <label for="currency" class="col-sm-2 col-form-label">Sponsorship Type</label>
                              <div class="col-sm-10">
                                  <select class="form-control select2" name="sponsorshiptype" style="width: 100%;" required>
                                        <option value="">--SELECT SPONSORSHIP TYPE--</option>
                                        <option value="Partial">Partial Sponsorship</option>
                                        <option value="Full">Full Sponsorship</option>
                                        <option value="All">All</option>
                                  </select>
                              </div>
                            </div>
        
                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer center" style="text-align: center;">
                            <button type="submit" class="btn btn-primary text-center">Get Report</button>
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