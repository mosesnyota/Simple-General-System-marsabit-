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
                                <div class="col-md-5">

                                    <div class="row">

                                        <div class="col-xl-7 col-md-6">
                                            <div class="card bg-primary mini-stat text-white">
                                                <div class="p-3 mini-stat-desc">
                                                    <div class="clearfix">
                                                        <h6 class="text-uppercase mt-0 float-left text-white-50">{{"IVENTORY MOVEMENTS  : "}}</h6>
                                                       
                                                    </div>
                                                </div>
                                               
                                               
                                            </div>
                                        </div>

                                        
                                       
                        
                                       
                                    </div>
                                </div>


                                <div class="col-md-7">
                                  

                                <button type="button"  class="btn btn-info btn-lg float-right mr-1"  target="_blank"  data-toggle="modal" data-target="#modal-productmovements" data-backdrop="static" data-keyboard="false" href="#"> <b class="mdi mdi-file-pdf" aria-hidden="true"> Full Report </b></button>
                                <button type="button"  class="btn btn-success btn-lg float-right mr-1"  target="_blank"  data-toggle="modal" data-target="#modal-summaryreport" data-backdrop="static" data-keyboard="false" href="#"> <b class="mdi mdi-file-pdf" aria-hidden="true"> Summary </b></button>
                                <button type="button"  class="btn btn-success btn-lg float-right mr-1"  target="_blank"  data-toggle="modal" data-target="#modal-breakdown" data-backdrop="static" data-keyboard="false" href="#"> <b class="mdi mdi-file-pdf" aria-hidden="true"> By Reason </b></button>

                                <a href="{{URL::to('/')}}/products" class="btn btn-success btn-lg float-right mr-1"   role="button"><b class="fa fa-undo"> BACK </b></a>

                                     

                                     
                                  
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
                                        <th style="width: 6%">#</th>
                                            <th>Product</th>
                                            <th>Trns Type </th>
                                            <th>Date/Time</th>
                                            <th>To</th>
                                            <th>Reason</th>
                                            <th style="width: 6%">Qnty</th>
                                            <th style="width: 6%">BF</th>
                                            <th style="width: 6%">AF</th>
                                            <th style="width: 5%"></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 1; ?>
                                        @foreach ($transactions as $transaction)
                                                <tr>
                                                    <td style="line-height: 10px;">{{ $counter }}</td>

                                                 @if($transaction->trans_type == 'Received Stock')

                                                    <td> {{ $transaction->product_name }}</td>
                                                    <td><span class="badge badge-success">{{ $transaction->trans_type }}</span></td>
                                                    <td>{{ date('d-M-Y', strtotime($transaction->created_at))  }}</td>
                                                    
                                                    <td>{{ $transaction->issued_to }}</td>
                                                    <td>{{ $transaction->description }}</td>
                                                    <td>{{ $transaction->quantity }}</td>
                                                    <td>{{ $transaction->qnty_before }}</td>
                                                    <td>{{ $transaction->qnty_after }}</td>
                                                    @else

                                                    <td>{{ $transaction->product_name }}</td>
                                                    <td><span class="badge badge-warning">{{ $transaction->trans_type }}</span></td>
                                                    <td>{{ date('d-M-Y', strtotime($transaction->created_at))  }}</td>
                                                    
                                                    <td>{{ $transaction->issued_to }}</td>
                                                    <td>{{ $transaction->description }}</td>
                                                    <td>{{ $transaction->quantity }}</td>
                                                    <td>{{ $transaction->qnty_before }}</td>
                                                    <td>{{ $transaction->qnty_after }}</td>

                                                    @endif



                                                    <td><a class="btn btn-primary btn-sm" href="#"><i class="fas fa-edit"></i></a></td>
                                                    
                                                    
                                                    
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
@include('products.reportsmodal')
@include('products.summarymodal')
    <!-- End Right content here -->
@endsection
