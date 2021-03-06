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
                                <h4 class="page-title m-0">{{$sponsor->sponsornames}}</h4>
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
          
                  <div class="col-4">
                    
                    <div class="card">

                        <img src="{{asset('images/tot3.png')}}" alt="LOGO"  width="200" height="200" class="centre">
                        <!-- /.card-header -->
                     <div class="card-body p-0">
                        <!-- .table-responsive -->
                
                        <div class="table-responsive">
                            <table class="table m-0">
                              <thead>
                              <tr>
                                <th></th>
                                <th></th>                            
                              </tr>
                              </thead>
                              <tbody>
                               
                            <tr>
                                <td>Total Funds</td>
                                
                                <td><span class="badge badge-success">{{number_format($details['total'],2)}}</span></td>
                            </tr>
                            
                            <tr>
                                <td><a>Projects</a></td>
                                <td><span class="badge badge-warning">{{$details['projects']}}</span></td>
                              
                                
                            </tr>
                            <tr>
                                <td><a>With Us From</a></td>
                               
                                <td><span class="badge badge-primary">{{$sponsor->startdate}}</span></td>
                            </tr>
                           
                           
                          
                              
                              </tbody>
                            </table>
                          </div>
                          <!-- /.table-responsive -->
                        </div>
                        
                    </div>




                   



                    <!-- /.card -->
                  </div>

                  <div class="col-8">

                   <div class="card">
                    <!-- /.card-header -->
                 <div class="card-body p-0">
                    <!-- .table-responsive -->
            
                    <div class="table-responsive">
                                                                          <table class="table m-0">
                                                                            <thead>
                                                                            <tr>

                                                                                <th>#</th>
                                                                              <th>Project</th>
                                                                              <th>Location</th>
                                                                              <th>Budget</th>
                                                                              <th>Start Date</th>
                                                                              <th>Status</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                              <?php $counter = 1 ; ?>
                                                                          @foreach ($projects as $project)
                                                                         
                                                                            <tr id="{{$project ->project_id}}">
                                                                             
                                                                              <td><span class="badge badge-success"><a>PRJ0{{$counter}}</a></span></td>
                                                                              <td>{{$project->project_name}}</td>
                                                                              <td>{{$project ->location}}</td>
                                                                              <td>{{number_format($project ->budget,0)}}</td>
                                                                              <td>{{$project ->start_date}}</td>
                                                                             
                                                                              @if($project ->cur_status == "Completed") 
                                                                              <td><span class="badge badge-success">{{$project ->cur_status}}</span></td>
                                                                            @elseif($project ->cur_status == "Active")
                                                                              <td><span class="badge badge-warning">{{"In Progress"}}</span></td>
                                                                            @elseif($project ->cur_status == "onhold")
                                                                              <td><span class="badge badge-danger">{{"On Hold"}}</span></td>
                                                                            @endif 
 
                                                                          </tr>
                                                                          <?php $counter += 1 ; ?>
                                                                          @endforeach
                                                                            
                                                                            </tbody>
                                                                          </table>
                                                                        </div>
                      <!-- /.table-responsive -->
                    </div>
                </div>
                <a class="btn btn-success btn-sm" href="../../{{$sponsor->sponsor_id}}/view"> <i class="fa fa-arrow-alt-circle-left">  BACK   </i></a>
                <a class="btn btn-success btn-sm" href="../../printsponsorprojects/{{$sponsor->sponsor_id}}/print" target="_blank"> <i class="fa fa-print">  PRINT   </i></a>


            </div>
                  <!-- /.col -->
         </div>

                

            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->

    


@endsection