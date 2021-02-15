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
                        <h4 class="page-title m-0"> Assets Copies Details</h4>
                    </div>
                   
                    <div class="col-md-6">

                    <a class="btn btn-info btn-md float-right mr-1" href="../"><i class="fas fa-undo">Back to Catalogue</i></a>
                    </div>
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
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body">

                                <table id="datatable-buttons"
                                    class="table-sm table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr >
                                            <th style="width: 6%">#</th>
                                            <th >Asset Name </th>
                                            <th style="width: 15%">Serial No</th>
                                            <th style="width: 15%">Price</th>
                                           
                                            <th style="width: 15%">Assigned to</th>
                                            <th style="width: 15%">Location</th>
                                            
                                            <th ></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 1; ?>
                                            @foreach ($assetcopies as $asset)
                                                <tr id="{{$asset ->asset_copy_id}}">
                                                    <td style="line-height: 10px;">{{ $counter }}</td>
                                                    <td data-target="asset_name">{{ $asset->asset_name }}</td>
                                                   
                                                    <td>{{ $asset->serial_no }}</td>
                                                    <td>{{ number_format($asset->price ,2)}}</td>
                                                    <td>{{  $asset->firstname." ".$asset->othernames }}</td>
                                                    <td>{{ $asset->store_name }}</td>
                                            
                                                    <td>
                                                        
                                                        <a class="btn btn-primary btn-sm" href="catalogue/{{$asset->asset_copy_id}}/editcopy"><i class="fas fa-edit"></i></a>
                                                        <button type="button" class="btn btn-danger btn-sm mr-1 delete-confirm"  href="catalogue/{{$asset->asset_copy_id}}/destroycopy"> <a  data-role="deletepetty"> <i class="fa fa-trash" > </i></a>  </button>  
                                                               
   
                      
                                                
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
    <!-- End Right content here -->
@endsection
