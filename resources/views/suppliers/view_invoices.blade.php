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
                                <h4 class="page-title m-0">{{$supplier->supplier_name}}</h4>
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
          
                  <div class="col-4">
                    
                    <div class="card">

                        <img src="{{asset('images/tot3.png')}}" alt="LOGO"  width="200" height="200" class="centre">
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
                                <td>Total Bills</td>
                                
                                <td><span class="badge badge-success">{{number_format($details['total'],2)}}</span></td>
                            </tr>
                            
                            <tr>
                                <td><a>Unpaid</a></td>
                                <td><span class="badge badge-warning">{{number_format($details['unpaid'],2)}}</span></td>
                              
                                
                            </tr>
                            <tr>
                                <td><a>With Us From</a></td>
                               
                                <td><span class="badge badge-primary">{{$supplier->created_at}}</span></td>
                            </tr>
                           
                           
                          
                              
                              </tbody>
                            </table>
                          </div>
                          <!-- /.table-responsive -->
                        </div>
                        
                    </div>




                   



                    <!-- /.card -->
                  </div>

                  <div class="col-8">

                   <div class="card">
                    <!-- /.card-header -->
                 <div class="card-body p-0">
                    <!-- .table-responsive -->
            
                    <div class="table-responsive">
                                                                          <table class="table m-0">
                                                                            <thead>
                                                                            <tr>

                                                                              <th>#</th>
                                                                              <th>Date</th>
                                                                              <th>Narration</th>
                                                                              <th>Amount</th>
                                                                              <th>Status</th>
                                                                            
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                              <?php $counter = 1 ; ?>
                                                                          @foreach ($invoices as $invoice)
                                                                         
                                                                            <tr id="{{$invoice ->bill_id}}">
                                                                              <td><a>ACT0{{$counter}}</a></td>
                                                                              <td>{{$invoice->expense_date}}</td>
                                                                              <td>{{$invoice ->narration}}</td>
                                                                              <td>{{number_format($invoice ->bill_total,2)}}</td>

                                                                              @if ($invoice ->cur_status == 'paid')
                                                                               <td><h6 class="badge badge-success">{{strtoupper($invoice ->cur_status)}}</h6></td>
                                                                              @else
                                                                               <td><h6 class="badge badge-warning">{{strtoupper($invoice ->cur_status)}}</h6></td>   
                                                                              @endif

                                                                           
                                                           
                                                                             
                                                                          </tr>
                                                                          <?php $counter += 1 ; ?>
                                                                          @endforeach
                                                                            
                                                                            </tbody>
                                                                          </table>
                                                                        </div>
                      <!-- /.table-responsive -->
                    </div>
                </div>
                <a class="btn btn-success btn-sm" href="../../{{$supplier->supplier_id}}/view"> <i class="fa fa-arrow-circle-left">  BACK   </i></a>

            </div>
                  <!-- /.col -->
         </div>

                

            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->

    


@endsection