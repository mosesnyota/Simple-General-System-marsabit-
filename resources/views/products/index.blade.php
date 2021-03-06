@extends('layouts.design')
@section('content')

    <!-- Start content -->
    <div class="content">

        <!-- Top Bar Start -->
        <div class="topbar">

        </div>
        <!-- Top Bar End -->
    @php
        $totalitems = 0; 
        $stockvalue = 0 ;
        foreach ($products as $product) {
            $totalitems += $product->quantity;
            $stockvalue += ( $product->quantity * $product->buying_price);
        }
    @endphp
    

        <div class="page-content-wrapper ">

            <div class="container-fluid">

                       
    <div class="row">
          <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4 class="page-title m-0"> CONSUMABLE PRODUCTS INVENTORY </h4>
                    </div>
                    <div class="col-md-6">
                        <div class="float-right d-none d-md-block">
                        <a href="{{URL::to('/')}}/products/productmovements" class="btn btn-success btn-lg float-right mr-1"   role="button"><b class="fa fa-file-pdf"> TRANSACTIONS </b></a>
                                    <button type="button" class="btn btn-warning btn-lg float-right mr-1"
                                                data-toggle="modal" data-target="#modal-addlocation" data-backdrop="static"
                                                data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> ADD NEW
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
                        <h6 class="text-uppercase mt-0 float-left text-white-50"> PRODUCTS </h6>
                        <h4 class="mb-3 mt-0 float-right">{{$products ->count()}}</h4>
                    </div>
                    <div>
                        <span class="badge badge-light text-success"> {{$products ->count()}} </span> <span class="badge badge-light text-success">  Categories </span>
                
                    </div>
                    
                </div>
                
            </div>

        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-info mini-stat text-white">
                <div class="p-3 mini-stat-desc">
                    <div class="clearfix">
                        <h6 class="text-uppercase mt-0 float-left text-white-50"> Value</h6>
                        <h4 class="mb-3 mt-0 float-right">{{number_format($stockvalue,0)}}</h4>
                    </div>
                    <div>
                
                        <span class="badge badge-light text-info"> {{100}} % </span> <span class="ml-2">Total Value </span>
                   
                    
                    </div>
                </div>
               
            </div>
        </div>


        

        
    </div> 


              


                <div class="row">

                    <div class="col-12">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body">

                                <table id="datatable-buttons"
                                    class="table-sm table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 6%">#</th>
                                            <th >Category</th>
                                            <th>Name </th>
                                            <th >Location</th>
                                            <th  style="width: 5%">Qnty</th>
                                            <th  style="width: 5%">#</th>
                                            <th ></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 1; ?>
                                            @foreach ($products as $product)
                                                <tr id="{{$product ->product_id}}">
                                                    <td style="line-height: 10px;">{{ $counter }}</td>
                                                    
                                                    <td>{{ $product->category_name }}</td>
                                                    <td data-target="product_name">{{ $product->product_name }}</td>
                                                    <td>{{ $product->store_name }}</td>
                                                    <td> <?php if ($product->quantity >= $product->reoder_level) { ?>
                                                        <h6> <span class="badge badge-success">{{$product->quantity}}</span> </h6>
                                                        <?php } else { ?>
                                                        <h6> <span class="badge badge-warning">{{$product->quantity}}</span> </h6>
                                                        <?php } ?>
                                                    </td>
                                                    <td>{{ $product->units_of_measure }}</td>
                                             
                                                    
                                                    <td>
                                                        <a class="btn btn-info btn-sm" href="products/{{$product->product_id}}/view"><i class="fas fa-eye"></i></a>
                                                                <a class="btn btn-primary btn-sm" href="products/{{$product->product_id}}/edit"><i class="fas fa-edit"></i></a>
                                                                
                                                               
                                                                <button type="button" class="btn btn-success btn-sm"> <a  data-role="receivestock"  data-id="{{$product->product_id}}"> <i class="fa fa-plus-circle" >RECEIVE </i></a>  </button>  
                                                                <button type="button" class="btn btn-warning btn-sm"> <a  data-role="issuestock"  data-id="{{$product->product_id}}"> <i class="fa fa-minus-circle" >ISSUE ITEN</i></a>  </button>  
                                            

                                               

                      
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


@include('products.modals')
    <!-- End Right content here -->
@endsection
