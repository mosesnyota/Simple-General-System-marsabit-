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
                        <h4 class="page-title m-0"> Assets Summary Dashboard {{date('Y')}} </h4>
                    </div>
                    <div class="col-md-6"> 
                        <div class="float-right d-none d-md-block">
                        <a href="{{URL::to('/')}}/assetreport" class="btn btn-primary btn-md float-right mr-1"   role="button"><b class="fa fa-file-pdf"> REPORT </b></a>
 
                        <button type="button" class="btn btn-warning btn-md float-right mr-1"
                                                data-toggle="modal" data-target="#modal-addasset" data-backdrop="static"
                                                data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> ADD NEW
                                                </b></button>

                        <button type="button" class="btn btn-info btn-md float-right mr-1"
                                                data-toggle="modal" data-target="#modal-issue" data-backdrop="static"
                                                data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> ISSUE ASSET
                                                </b></button>

                                               

                        </div> 
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end page-title-box -->
        </div>
    </div>


    <div class="row">

    
        <div class="col-xl-3 col-md-6">
        
            <div class="card bg-primary mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <h6 class="text-uppercase mt-0 float-left text-white-50"> ASSETS</h6>
                        <h4 class="mb-3 mt-0 float-right">{{$totalAssets}}</h4>
                    </div>
                    <div>
                        <span class="badge badge-light text-success"> {{$categories->count()}} </span> <span class="badge badge-light text-success">  Categories </span>
                
                    </div>
                    
                </div>
                
            </div>

        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card bg-info mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <h6 class="text-uppercase mt-0 float-left text-white-50"> Value</h6>
                        <h4 class="mb-3 mt-0 float-right">{{number_format($stockvalue,2)}}</h4>
                    </div>
                    <div>
                    

                    @if(0 > 0)
                        <span class="badge badge-light text-success"> {{ 0}} % </span> <span class="ml-2">Compared</span>
                    @else
                        <span class="badge badge-light text-info"> {{ 3}} % </span> <span class="ml-2">Depreciation / year  </span>
                    @endif
                    
                    </div>
                </div>
               
            </div>
        </div>


        

        
    </div> 


               
                <!-- end page title -->


   

                <div class="row">

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
                                            <th>Barcode</th>
                                            <th >Asset Name </th>
                                            <th style="width: 10%">Copies</th>
                                            
                                            <th style="width: 25%"></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 1; ?>
                                            @foreach ($assets as $asset)
                                                <tr id="{{$asset ->asset_id}}">
                                                    <td style="line-height: 10px;">{{ $counter }}</td>
                                                   
                                                    <td>{{ $asset->barcode }}</td>
                                                    <td data-target="asset_name">{{ $asset->asset_name }}</td>
                                                   
                                                    <td>{{ $asset->totalassets }}</td>
                                                    
                                                    
                                            
                                                    <td>
                                                        
                                                        <a class="btn btn-primary btn-sm" href="catalogue/{{$asset->asset_id}}/edit"><i class="fas fa-edit"></i></a>
                                                        <button type="button" class="btn btn-danger btn-sm mr-1 delete-confirm"  href="catalogue/{{$asset->asset_id}}/destroy"> <a  data-role="deletepetty"> <i class="fa fa-trash" > </i></a>  </button>  
                                                               
   
                      
                                                <button type="button" class="btn btn-info btn-sm"> <a  data-role="addcopy"  data-id="{{$asset->asset_id}}"> <i class="fa fa-plus-circle" >ADD </i></a>  </button>  
                                                <a class="btn btn-info btn-sm" href="catalogue/{{$asset->asset_id}}/view"><i class="fas fa-eye">VIEW</i></a>   
                                                   
                                                   
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
                    <!-- /.col -->
                </div>



            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->


@include('catalogue.modals')
    <!-- End Right content here -->
@endsection
