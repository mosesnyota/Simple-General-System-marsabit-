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
                        <h4 class="page-title m-0"> Items in: {{$assetfull->asset_name}} </h4>
                    </div>
                   
                    <div class="col-md-6">

                    <a class="btn btn-info btn-md float-right mr-1" href="../../"><i class="fas fa-undo">Back to Catalogue</i></a>
                   
                    <button type="button" class="btn btn-warning btn-md float-right mr-1"
                                                data-toggle="modal" data-target="#modal-additem" data-backdrop="static"
                                                data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> ADD ITEM
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
                                            <th >Item Name </th>
                                            <th style="width: 15%">Quantity</th>
                                            
                                           
                                         
                                            
                                            <th ></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 1; ?>
                                            @foreach ($copies as $asset)
                                                <tr id="{{$asset ->asset_item_id}}">
                                                    <td style="line-height: 10px;">{{ $counter }}</td>
                                                    <td data-target="asset_name">{{ $asset->name }}</td>
                                                   
                                                    <td>{{ $asset->quantity }}</td>
                                                   
                                             
                                                    <td>
                                                        
                                                        <a class="btn btn-primary btn-sm" href="asetitem/{{$asset->asset_item_id}}/edit"><i class="fas fa-edit"></i></a>
                                                        <button type="button" class="btn btn-danger btn-sm mr-1 delete-confirm"  href="catalogue/{{$asset->asset_item_id}}/destroy"> <a  data-role="deletepetty"> <i class="fa fa-trash" > </i></a>  </button>  
                                                               
                                                        
                                                
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
    @include('catalogue.modal_item')
@endsection
