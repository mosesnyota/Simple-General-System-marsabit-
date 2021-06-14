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
                        <h4 class="page-title m-0"> Assign Assets </h4>
                    </div>
                    <div class="col-md-6"> 
                        <div class="float-right d-none d-md-block">
                       
                        <a href="{{URL::to('/')}}/catalogue" class="btn btn-info btn-md float-right mr-1"   role="button"><b class="fa fa-file-pdf"> Back To Assets </b></a>
                       

                                               

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

                    <div class="col-xl-6">
                        
                        
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body">

                                <table id="datatable"
                                    class="table-sm table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr >
                                            <th style="width: 6%">Barcode</th>
                                            
                                            <th >Asset </th>
                                          
                                            <th style="width: 25%"></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 1; ?>
                                            @foreach ($assets as $asset)
                                                <tr id="{{$asset ->asset_id}}">
                                                    <td style="line-height: 10px;">{{ $asset->barcode }}</td>
                                                   
                                                  
                                                    <td data-target="asset_name">{{ $asset->asset_name }}</td>
                                                   

                                                    <td>
                                                        
                                                      
                                                       
                                                <a class="btn btn-info btn-sm" href="{{$asset->asset_id}}/pick"><i class="fas fa-check">Pick</i></a>   
                                                   
                                                   
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

                    <div class="col-xl-6">

                        <div class="card">

<!-- /.card-header -->
                                    <div class="card-body">

                                    <form action="saveissueditems" method="POST">
                                    {{ csrf_field() }}
                                        <table  class="table m-0"  >
                                            <thead>
                                                <tr >
                                                    <th>Asset</th>
                                                    
                                                    <th>Qnty </th>
                                                
                                                    <th ></th>
                                                
                                                </tr>
                                            </thead>
                                            <tbody>


                                                <?php $counter = 1;   
                                                $pdt = Session::get('products');
                                                
                                            
                                                ?>

                                                @if (Session::has('products'))

                                                <?php   for ($x = 0; $x < count($pdt); $x++){    ?>
                                                   
                                                   @if (isset($pdt[$x]))
                                                        <tr id="{{$asset ->asset_id}}">
                                                            <td> {{$pdt[$x]->asset_name}}</td>                                                      
                                                            <td>1</td>
                                                            <td>
                                                                <a class="btn btn-warning btn-sm" href="{{$pdt[$x]->asset_id}}/remove"><i class="fas fa-window-close">Remove</i></a>   
                                                            <?php $counter += 1; ?>
                                                        </tr>
                                                    @endif

                                                    <?php } ?>
                                                
                                                @endif
                                                   
                                            
                                            </tbody>

                                        </table>

                                        <div class="text-center">
                                  
                                    <button type="submit" class="btn btn-lg btn-primary">Save</button>
                                </div>
                                        </FORM>

                                    </div>
                                    <!-- /.card-body -->
                                    </div>
                    </div>
                    <!-- /.col -->
                </div>



            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->



    <!-- End Right content here -->
@endsection
