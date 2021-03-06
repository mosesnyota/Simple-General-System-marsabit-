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
                                 
                                    <div class="card bg-secondary mini-stat">
                                        <div class="p-3 mini-stat-desc">
                                            <div class="clearfix">
                                                <h6 class="text-uppercase mt-0 float-left text-white-50">Suppliers: </h6>
                                                <h4 class="mb-3 mt-0 float-right">{{$details['totalsuppliers']}}</h4>
                                            </div>
                                        </div>
                                    </div>
                               
                                </div>
                                <div class="col-md-3">
                                  <div class="card bg-info mini-stat">
                                    <div class="p-3 mini-stat-desc">
                                        <div class="clearfix">
                                            <h6 class="text-uppercase mt-0 float-left text-white-50">Bills</h6>
                                            <h4 class="mb-3 mt-0 float-right">{{$details['bills']}}</h4>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="card bg-secondary mini-stat">
                                  <div class="p-3 mini-stat-desc">
                                      <div class="clearfix">
                                          <h6 class="text-uppercase mt-0 float-left text-white-50">Pending</h6>
                                          <h4 class="mb-3 mt-0 float-right">{{number_format($details['unpaid'],0)}}</h4>
                                      </div>
                                  </div>
                              </div>
                            </div>

                            

                                
                                <div class="col-md-3">
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti-settings mr-1"></i> Options
                                            </button>
                                            
                                        </div>
                                    </div>
                                        <button type="button"  class="btn btn-success btn-md float-right mr-1"  data-toggle="modal" data-target="#modal-addsupplier" data-backdrop="static" data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> Add New </b></button>
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
                            <th width="10%">#</th>
                            <th>Name/Organization</th>
                            <th>Services</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th></th>
                            
                          </tr>
                          </thead>
                          <tbody>
                            <?php $counter = 1 ; ?>
                            @if(count($suppliers) > 0)
                            @foreach($suppliers as $supplier)
                                    <tr>
                                        <td>{{$counter}}</td>
                                        <td>{{$supplier ->supplier_name}}</td>
                                        <td>{{$supplier ->services}}</td>
                                        <td>{{$supplier ->email}}</td>
                                        <td>{{$supplier ->phone}}</td>
                                        
                                        <td>
                                          <a class="btn btn-primary btn-sm" href="editsupplier/{{$supplier->supplier_id}}"><i class="fas fa-edit"></i></a>
                                          <button type="button" class="btn btn-danger btn-sm mr-1 delete-confirm"  href="supplier/destroy/{{$supplier->supplier_id}}"> <a  data-role="deletesupplier"  data-id="{{$supplier->supplier_id}}"> <i class="fa fa-trash" > </i></a>  </button>  
                                           
                                          <a class="btn btn-primary btn-sm" href="viewsupplier/{{$supplier->supplier_id}}/view"><i class="fas fa-eye"></i></a>

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

    


    
  <div class="modal fade bs-example-modal-lg" id="modal-addsupplier" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Supplier</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form role="form" method="post" action="suppliers/store" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                  <div class="form-group row">
                    <label for="supplier_name" class="col-sm-2 col-form-label">Name/Organization</label>
                    <div class="col-sm-10">
                    <input type="text" autocomplete="off" class="form-control" id="supplier_name" name="supplier_name"  required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                    <input type="text" autocomplete="off" class="form-control" id="address" name="address" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="contactperson" class="col-sm-2 col-form-label">Services Offered</label>
                    <div class="col-sm-10">
                        <input type="text" autocomplete="off" class="form-control" id="services" name="services"  required>
                    </div>
                </div>
                     <div class="form-group row">
                      <label for="email" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                          <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                  </div>
                                  <input type="text" name="email" id="email" class="form-control"
                                  autocomplete="off" required>
                          </div>
                      </div>
                  </div>
                    
              <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" autocomplete="off" name="phone" id="phone" class="form-control" required>                        </div>
                </div>
            </div>
                </div>
                <!-- /.card-body -->
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>           
        </div>
        
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

    <!-- End Right content here -->
@endsection


