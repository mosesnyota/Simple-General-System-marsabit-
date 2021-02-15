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
                                <div class="col-md-6">
                                    <h4 class="page-title m-0">PRINT REPORT</h4>
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
          
                  <div class="col-3">
                    
                    <div class="card">

                       

                        <img src="{{asset('images/report3.png')}}" alt="LOGO"  width="100%" height="230" class="centre">
                        <!-- /.card-header -->
                     <div class="card-body p-0">
                        <!-- .table-responsive -->
                
                        <div class="table-responsive">
                            <table class="table m-0" >
                              <thead>
                              <tr>
                                <th></th>
                                <th></th>                            
                              </tr>
                              </thead>
                              <tbody>
                               
                            <tr>
                                <td>Report Forms are Ready</td>
                                
                                <td><span class="badge badge-success"></span></td>
                            </tr>
                            
                           
                           
                           
                           
                          
                        
                              </tbody>
                            </table>
                          </div>
                          <!-- /.table-responsive -->
                        </div>
                        
                    </div>




                   



                    <!-- /.card -->
                  </div>

                  <div class="col-9">
                    
                   <div class="card">
                    <!-- /.card-header -->
                 <div class="card-body p-0">
                    <form role="form" method="post" action="reportforms/print" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <div class="box-body"> 
                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer justify-content-between">
                        <input type="hidden" name="course_id" value="{{$inputs['course_id']}}">
                        <input type="hidden" name="examyear" value="{{$inputs['examyear']}}">
                        <input type="hidden" name="term" value="{{$inputs['term']}}">
                        <input type="hidden" name="examtype" value="{{$inputs['examtype']}}">
                       
                        
                
                        <button type="submit" target="_blank" class="btn btn-warning"><i class="fa fa-print">DOWNLOAD REPORT</i></button>
                        </div>
                    </form>   

                </div>
                </div>
                
            </div>
                  <!-- /.col -->
         </div>

                

            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->

   


@endsection