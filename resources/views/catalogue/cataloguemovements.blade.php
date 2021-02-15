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
                                <div class="col-md-8">

                                    <div class="row">

                                        <div class="col-xl-7 col-md-6">
                                            <div class="card bg-primary mini-stat text-white">
                                                <div class="p-3 mini-stat-desc">
                                                    <div class="clearfix">
                                                        <h6 class="text-uppercase mt-0 float-left text-white-50">{{"IVENTORY MOVEMENTS  : "}}</h6>
                                                        <h6 class="mb-3 mt-0 float-right">{{$transactions ->count()}}</h6>
                                                    </div>
                                                </div>
                                               
                                               
                                            </div>
                                        </div>

                                        
                                       
                        
                                       
                                    </div>
                                </div>


                                <div class="col-md-4">
                                  

                                    
                                <a href="{{URL::to('/')}}/products" class="btn btn-success btn-md"   role="button"><b class="fa fa-undo"> BACK </b></a>

                                     

                                     
                                  
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
                                        <tr>
                                            <th style="width: 10%">#</th>
                                            <th>Product</th>
                                            <th>Transaction Type </th>
                                            <th>Date/Time</th>
                                            
                                            <th>Quantity</th>
                                            <th>By</th>
                                            <th>Qnty Before</th>
                                            <th>Qnty After</th>
                                           
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 1; ?>
                                            @foreach ($transactions as $transaction)
                                                <tr>
                                                    <td style="line-height: 10px;">{{ $counter }}</td>
                                                    <td>{{ $transaction->product_name }}</td>
                                                    <td>{{ $transaction->trans_type }}</td>
                                                    <td>{{ $transaction->created_at }}</td>
                                                    
                                                    <td>{{ $transaction->quantity }}</td>
                                                    <td>{{ $transaction->transacted_by }}</td>
                                                    <td>{{ $transaction->qnty_before }}</td>
                                                    <td>{{ $transaction->qnty_after }}</td>
                                                    
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
