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
                                <h4 class="page-title m-0">{{$staff->firstname}}</h4>
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

                        <img src="{{asset('images/art.png')}}" alt="LOGO"  width="100%" height="240" class="centre">
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
                                <td>Items Issued</td>
                                
                                <td><span class="badge badge-success"></span></td>
                            </tr>
                            
                            <tr>
                                <td><a>Unreturned Items</a></td>
                                <td><span class="badge badge-warning"></span></td>
                              
                                
                            </tr>
                            <tr>
                                <td><a>Role</a></td>
                               
                                <td><span class="badge badge-primary">{{$staff->name}}</span></td>
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
                            <td><a>Name</a></td>
                            <td><a>{{$staff->firstname." ".$staff->othernames}}</a></td>
                            
                        </tr>
                        <tr>
                          <td><a>Role</a></td>
                          <td><a>{{$staff->name}}</a></td>
                          
                      </tr>
                       
                        
                        <tr>
                            <td><a>Phone</a></td>
                            <td><a>{{$staff->phone}}</a></td>
                            
                        </tr>
                        
                      
                          
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
                </div>
               
                <div class="col-12">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body">

                                <table id="datatable-buttons"
                                    class="table-sm table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr >
                                            <th style="width: 6%">#</th>
                                            <th>Name</th>
                                            <th >Issue Date </th>
                                            <th style="width: 10%">Status</th>
                                           
                                            <th style="width: 25%"></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 1; ?>
                                           
                                        @foreach($issuedAssets as $issued)
                                                <tr id="">
                                                    <td style="line-height: 10px;">{{$counter}}</td>
                                                    <td>{{$issued->asset_name}}</td>
                                                    <td data-target="asset_name">{{ date_format(date_create($issued->issue_date),"d-m-Y") }}</td>

                                                    <td style="width: 15%" >{{$issued->cur_status}}</td>
                                                   
                                                    
                                            
                                                    <td>
                                                        <button type="button" class="btn btn-success btn-sm mr-1 delete-confirm"  href="1"> <a  data-role="deletepetty"> <i class="fa fa-undo" > Return Item</i></a>  </button>  
                                                    </td>
                                                   
                                                    <?php $counter += 1; ?>
                                                </tr>
                                         @endforeach
                                      
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>


            </div>

            
                  <!-- /.col -->
         </div>

                

            </div><!-- container fluid -->
        </div> <!-- Page content Wrapper -->
    </div> <!-- content -->

    


@endsection