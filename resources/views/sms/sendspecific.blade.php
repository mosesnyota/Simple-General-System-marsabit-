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
                                <div class="col-md-12">
                                <h4 class="page-title m-0">Communication</h4>
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
                  <div class="col-2">
                  <div class="sidebar-inner slimscrollleft">
                   <div id="sidebar-menu">
                     <ul>
                        
                        <li><a href="{{URL::to('/')}}/smscommunication"><b class="fa fa-sms" style="color:green" aria-hidden="true"> Send SMS </b></a></li>
                        <li><a href="{{URL::to('/')}}/smsspecificno"><b class="fa fa-sms" style="color:green" aria-hidden="true"> Send One SMS </b></a></li>
                        <li><a href="{{URL::to('/')}}/smscommunication/sentsms"><b class="fa fa-sms" style="color:green" aria-hidden="true"> SMS Logs</b></a></li>
                     </ul>
                    </div>   
                  </div>  
                  </div>
                  <div class="col-9">
                  <div class="card">
                    <!-- /.card-header -->
                 <div class="card-body">
          <form class="form-horizontal" method="post" action="smsspecificno/sendsms2" enctype="multipart/form-data" >
                  {{ csrf_field() }}
                <div class="card-body"> 
                  <div class="form-group row">
                    <label for="targetgroup" class="col-sm-2 col-form-label">Phone No: </label>
                    <div class="col-sm-10">
                    <input class="form-control"  id="phone" required name="phone" placeholder="Phone e.g 254722000000"></input>
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Message: </label>
                    <div class="col-sm-10">
                    <textarea class="form-control" required rows="5" name="messages" id="messages" placeholder="Message"></textarea>
                    </div>
                  </div>



               


                 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-secondary">Send SMS</button>
                    </div>
                 </div>
                <!-- /.card-footer -->
              </form>
           </div>   

                   </div>
                  <!-- /.col -->
         </div>

                

            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->

    


@endsection