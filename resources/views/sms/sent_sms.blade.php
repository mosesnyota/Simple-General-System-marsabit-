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
                        <li><a href="{{URL::to('/')}}/smscommunication/sentsms"><b class="fa fa-sms" style="color:green" aria-hidden="true"> SMS Logs</b></a></li>
                     </ul>
                    </div>   
                  </div>  
                  </div>
                  <div class="col-10">
                  <div class="card">
                    <!-- /.card-header -->
                      <div class="card-body">
                      <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                                            <thead>
                                                                            <tr>
                                                                              <th>#</th>
                                                                              <th>Status</th>
                                                                              <th>To</th>
                                                                              <th>Name</th>
                                                                              <th>Date</th>
                                                                              <th>Msg</th>
                                                                              
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                              <?php $counter = 1 ; ?>
                                                                          @foreach ($sms as $msg)
                                                                            <tr>
                                                                              <td><a>{{$counter}}</a></td>
                                                                              <td><a>{{$msg->statusdesc}}</a></td>
                                                                              <td>{{$msg->phone}}</td>
                                                                              <td>{{$msg->name}}</td>
                                                                              <td>{{$msg->timestampss}}</td>
                                                                              <td>{{$msg->messages}}</td> 
                                                                               
 
                                                                          </tr>
                                                                        
                                                                          <?php $counter += 1 ; ?>
                                                                          @endforeach
                                                                            
                                                                            </tbody>
                                                                          </table>




                      </div>   

                   </div>
                  <!-- /.col -->
         </div>

                

            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->

    


@endsection