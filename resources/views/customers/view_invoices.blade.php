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
                                <h4 class="page-title m-0">{{$customer->customer_names}}</h4>
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
          
                  <div class="col-3">
                    
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
                                <td>Total Billed</td>
                                
                                <td><span class="badge badge-success">{{number_format($details['total'],2)}}</span></td>
                            </tr>
                            
                            <tr>
                                <td><a>Unpaid</a></td>
                                <td><span class="badge badge-warning">{{number_format($details['unpaid'],2)}}</span></td>
                              
                                
                            </tr>
                            <tr>
                                <td><a>With Us </a></td>
                               
                                <td><span class="badge badge-primary">{{$customer->created_at}}</span></td>
                            </tr>
                           
                           
                          
                              
                              </tbody>
                            </table>
                          </div>
                          <!-- /.table-responsive -->
                        </div>
                        
                    </div>




                   



                    <!-- /.card -->
                  </div>

                  <div class="col-9">

                   <div class="card">
                    <!-- /.card-header -->
                 <div class="card-body p-0">
                    <!-- .table-responsive -->
            
                    <div class="table-responsive">
                                                                          <table class="table m-0">
                                                                            <thead>
                                                                            <tr>

                                                                              <th width="7%">#</th>
                                                                              <th width="15%">Date</th>
                                                                              <th width="40%">Narration</th>
                                                                              <th>Amount</th>
                                                                              <th >Status</th>
                                                                              <th width="18%"></th>
                                                                            
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                              <?php $counter = 1 ; ?>
                                                                          @foreach ($invoices as $invoice)
                                                                         
                                                                          <tr id="{{$invoice ->invoice_id}}">
                                                                                <td><a>{{$counter}}</a></td>
                                                                                <td><a>{{date_format(date_create($invoice->invoice_date),'d-m-Y')}}</a></td>
                                                                                <td data-target="narration2" ><a>{{$invoice->narration}}</a></td>
                                                                                
                                                                                <td data-target="amount2"><a>{{number_format($invoice->amount,2)}}</a></td>

                                                                                <td>  <?php if($invoice->cur_status == 'Paid'){ ?>
                                                                                  <span class="badge badge-success">Paid</span>
                                                                                  <?php }
                                                                                    else if($invoice->cur_status == 'Patially Paid'){?>
                                                                                      <span class="badge badge-warning">Partially Paid</span> 
                                                                                      <?php } else if($invoice->cur_status == 'Unpaid'){?>
                                                                                        <span class="badge badge-danger">Unpaid</span> 
                                                                                      <?php } ?>
                                                                              </td>
                                                                              <td>
                                                                            
                                                                            <a class="btn btn-info btn-sm" href="../../invoice/{{$invoice ->invoice_id}}/open"><i class="fas fa-eye"></i></a>
                                                                         
                                                                            <button type="button" class="btn btn-secondary btn-sm"> <a  data-role="payinvoice"  data-id="{{$invoice ->invoice_id}}"> <i class="fa fa-euro-sign" > PAY </i></a>  </button>  
                                                                                                                                                                    
                                                                            </td>  
                                                                              </tr>
                                                                              <?php $counter += 1 ; ?>



                                                                          @endforeach
                                                                            
                                                                            </tbody>
                                                                          </table>
                                                                        </div>
                      <!-- /.table-responsive -->
                    </div>
                </div>
                <a class="btn btn-success btn-sm" href="../{{$customer->customer_id}}/view"> <i class="fa fa-arrow-circle-left">  BACK   </i></a>
                <a class="btn btn-primary btn-sm" target = "_blank" href="getstatement"> <i class="fas fa-file-pdf">  Get Statement    </i></a>

            </div>
                  <!-- /.col -->
         </div>

                

            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->

    


@endsection