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
                            <h4 class="page-title m-0">EDIT INVOICE:{{$termyear."  For ".$studentname}} </h4>
                        </div>
                        <div class="col-md-4">
                            
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
                <div class="card m-b-30">
                    <div class="card-body">

                     <!-- form start -->
              
                <div class="modal-body">
               

                <form role="form" method="post" action="update" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="box-body"> 
                    <div class="form-group row">
                        <label for="student_name" class="col-sm-2 col-form-label">Student Name:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" value="{{$studentname}}" name="student_name" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="student_name" class="col-sm-2 col-form-label">Term:</label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" value="{{$termyear}}" name="student_no" disabled>
                        </div>
                    </div>
                     

                    <div class="form-group row">
                        <label for="sponsor_id" class="col-sm-2 col-form-label">Votehead</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="votehead_id" style="width: 100%;"  required>
                                @foreach ($voteheads as $votehead)
                                      @if ($votehead->votehead_id == $invoice->votehead_id)
                                         <option value="{{$votehead->votehead_id}}" selected>{{$votehead ->votehead}}</option>
                                      @else
                                         <option value="{{$votehead ->votehead_id}}" >{{$votehead ->votehead}}</option>
                                      @endif
                                    @endforeach
                                
                            </select>
                        </div>
                    </div>

                <div class="form-group row">
                        <label for="amount" class="col-sm-2 col-form-label"> Amount:</label>
                        <div class="col-sm-10">
                            <input type="number" autocomplete="off" class="form-control" value="{{$invoice->amount}}" name="amount" required>
                        </div>
                    </div>

                


                    


                </div>
                <!-- /.card-body -->
                <div class="modal-footer">
                    <input type="hidden" autocomplete="off" class="form-control" value="{{$invoice->fee_invoice_id}}" name="fee_invoice_id" required>
                    <button type="submit" class="btn btn-primary">UPDATE RECORD</button>
                </div>
            </form>           
                            
    
                        
                       
                        </div>
                        
                       
                       
                    </form>           
                </div>
                <!-- /.card-body -->
                
                
                <!-- /.card-footer -->
              
                       

                        

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->            

    </div><!-- container fluid -->

</div> <!-- Page content Wrapper -->

</div> <!-- content -->



<!-- End Right content here -->
@endsection