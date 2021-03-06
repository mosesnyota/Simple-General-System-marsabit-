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
                                <td>Total Donations</td>
                                
                                <td><span class="badge badge-success">{{number_format($details['total'],2)}}</span></td>
                            </tr>
                            
                            <tr>
                                <td><a>Projects</a></td>
                                <td><span class="badge badge-warning">{{number_format($details['projects'],2)}}</span></td>
                              
                                
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
                                                                              <th>Date</th>
                                                                              <th>Currency</th>
                                                                              <th>Amount</th>
                                                                              <th>Rate</th>
                                                                              <th>Local Cur</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                              <?php $counter = 1 ; ?>
                                                                          @foreach ($fundings as $funding)
                                                                         
                                                                            <tr id="{{$funding ->funding_id}}">
                                                                              <td><a>ACT0{{$counter}}</a></td>
                                                                              <td>{{$funding->funding_date}}</td>
                                                                              <td><h6 class="badge badge-success">{{$funding ->currency}}</h6></td>
                                                                              <td>{{number_format($funding ->original_amount,2)}}</td>
                                                                              <td>{{number_format($funding ->exchangerate,2)}}</td>
                                                                              <td>{{number_format($funding ->final_amount,2)}}</td>
 
                                                                          </tr>
                                                                          <?php $counter += 1 ; ?>
                                                                          @endforeach
                                                                            
                                                                            </tbody>
                                                                          </table>
                                                                        </div>
                      <!-- /.table-responsive -->
                    </div>
                </div>
                <a class="btn btn-success btn-sm" href="../../{{$sponsor->sponsor_id}}/view"> <i class="fa fa-arrow-circle-left">  BACK   </i></a>

                
                <a class="btn btn-success btn-sm" href="../../printsponsorfundings/{{$sponsor->sponsor_id}}/print" target="_blank"> <i class="fa fa-print">  PRINT   </i></a>

            </div>
                  <!-- /.col -->
         </div>

                

            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->

    


@endsection