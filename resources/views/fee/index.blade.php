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
                                    <h4 class="page-title m-0"><button type="button" class="btn btn-secondary btn-md  mr-1"
                                        > <b >  <h3><b> {{" Fee Invoices "}} </b></h3>
                                        </b></button> </h4>
                                </div>
                                <div class="col-md-6">
                                <a href="{{URL::to('/')}}/feereceipts" class="btn btn-info btn-md float-right mr-1"   role="button"><b class="fas fa-dollar-sign"> RECEIPTS </b></a>
                                <a href="{{URL::to('/')}}/feebalances" target = "_blank" class="btn btn-warning btn-md float-right mr-1"   role="button"><b class="fas fa-dollar-sign"> GET BALANCES </b></a>
                                <a href="{{URL::to('/')}}/createfeeinvoice" class="btn btn-success btn-md float-right mr-1"  
                                 role="button"><b class="fa fa-dollar-sign"> CREATE FEE INVOICE  </b></a> 
                                    
                                 <a href="{{URL::to('/')}}/school" class="btn btn-info btn-md float-right mr-1"   role="button"><b class="fa fa-undo"> Back </b></a>
                                </div>

                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end page-title-box -->
                    </div>
                </div>

                <div class="row">

                    <div class="col-12">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body">

                                <table id="datatable"
                                    class="table table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th width="10%">#</th>
                                            <th width="10%" data-visible="false">#</th>
                                            <th width="10%">Admn</th>
                                            <th  style="width: 30%">Student Name</th>
                                            <th >Course</th>
                                            <th>Fee Balance</th>
                                            <th></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 1; ?>
                                            @foreach ($students as $student)

                                            @php
                                            $balance = $student->balance;


                                            @endphp
                                                <tr id="{{$student ->student_id}}">
                                                    <td>{{ $counter }}</td>
                                                    <td data-target="student_id" >{{ $student->student_id   }}</td>
                                                    <td data-target="student_no" >{{ $student->student_no   }}</td>
                                                    <td data-target="student_name">{{$student->first_name." ".$student->middle_name." ".$student->surname}}</td>
                                                    <td data-target="department" >{{ $student->department   }}</td> 
                                                    <td data-target="balance" > <?php if ( $balance  > 1000) { ?>
                                                        <span class="badge badge-warning"><b> {{number_format($balance ,2)}}</b></span>
                                                        <?php } else { ?>
                                                        <span class="badge badge-info">{{number_format($balance ,2)}}</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>

                                                    
                                                    <a class="btn btn-primary btn-sm" href="schoolfees/{{$student->student_id}}/viewstatement"><i class="fas fa-eye"> Statement</i></a>
                                                    <button type="button" class="btn btn-warning btn-sm"> <a  data-role="payfee"  data-id="{{$student->student_id}}"> <i class="fa fa-euro-sign" > Pay Fee </i></a>  </button>  
                                                                
                                                            
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


                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h4 class="page-title m-0"><button type="button" class="btn btn-secondary btn-md  mr-1"
                                        > <b >  <h3><b> {{" Fees Voteheads   :   ".$voteheads->count()}} </b></h3>
                                        </b></button> </h4>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-success btn-lg float-right mr-1"
                                        data-toggle="modal" data-target="#modal-addvotehead" data-backdrop="static"
                                        data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> ADD VOTEHEAD
                                        </b></button>
                                    
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
                                    class="table table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th width="10%">#</th>
                                            <th  style="width: 30%">Votehead</th>
                                            <th>Amount</th>
                                            <th></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 1; ?>
                                            @foreach ($voteheads as $votehead)
                                                <tr>
                                                    <td>{{ $counter }}</td>
                                                    <td>{{ $votehead->votehead   }}</td>
                                                    <td>{{ $votehead->amount   }}</td>
                                             
                                                    
                                                    <td>
                                                                <a class="btn btn-primary btn-sm" href="feevotehead/{{$votehead->votehead_id}}/edit"><i class="fas fa-edit"></i></a>
                                                                <button type="button" class="btn btn-danger btn-sm mr-1 delete-confirm"  href="feevotehead/{{$votehead->votehead_id}}/destroy"> <a  data-role="deletepetty"> <i class="fa fa-trash" > </i></a>  </button>  
                                                            
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


@include('fee.modals')
    <!-- End Right content here -->
@endsection
