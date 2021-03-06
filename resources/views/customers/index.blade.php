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
                            <div class="row align-items-center no-gutter">
                                <div class="col-md-3">
                                 
                                    <div class="card bg-primary mini-stat">
                                        <div class="p-3 mini-stat-desc">
                                            <div class="clearfix">
                                                <h6 class="text-uppercase mt-0 float-left text-white-50">Customers: </h6>
                                                <h4 class="mb-3 mt-0 float-right">{{$details['totalcustomers']}}</h4>
                                            </div>
                                        </div>
                                    </div>
                               
                                </div>
                                <div class="col-md-3">
                                  <div class="card bg-info mini-stat">
                                    <div class="p-3 mini-stat-desc">
                                        <div class="clearfix">
                                            <h6 class="text-uppercase mt-0 float-left text-white-50">Open Invoices</h6>
                                            <h4 class="mb-3 mt-0 float-right">{{$details['noOfInvoice']}}</h4>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              
                              <div class="col-md-6">
                                        <button type="button"  class="btn btn-success btn-md float-right mr-1"  data-toggle="modal" data-target="#modal-addcustomer" data-backdrop="static" data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> New Customer </b></button>
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
                          <table id="mytable" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                          <thead>
                          <tr>
                            <th width="7%">#</th>
                            <th>Name/Organization</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th></th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php $counter = 1 ; ?>
                            @if(count($customers) > 0)
                            @foreach($customers as $customer)
                                    <tr>
                                        <td>{{$counter}}</td>
                                        <td>{{$customer ->customer_names}}</td>
                                        <td>{{$customer ->email}}</td>
                                        <td>{{$customer ->phone}}</td>
                                        
                                        <td>
                                          <a class="btn btn-primary btn-sm" href="customers/{{$customer->customer_id}}/edit"><i class="fas fa-edit"></i></a>
                                          <button type="button" class="btn btn-danger btn-sm mr-1 delete-confirm"  href="customers/{{$customer->customer_id}}/destroy"> <a  data-role="deletecustomer"  data-id="{{$customer->customer_id}}"> <i class="fa fa-trash" > </i></a>  </button>  
                                           
                                          <a class="btn btn-primary btn-sm" href="customers/{{$customer->customer_id}}/view"><i class="fas fa-eye"></i></a>

                                        </td> 
                                         <?php $counter += 1 ; ?>
                                    </tr>
                                @endforeach 
                        @endif
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

    


    @include('customers.modals')

    <!-- End Right content here -->
@endsection


