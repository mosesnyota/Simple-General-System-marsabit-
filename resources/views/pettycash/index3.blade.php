@extends('layouts.design')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3">
                  <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fab fa-paypal" aria-hidden="true"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Petty Cash Balance</span>
                      <span class="info-box-number">
                        <h2><b> {{number_format($current_balance,2)}} </b></h2>
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                
                <div class="col-xl-9">
                    <a href="/finance/public/pettycashreport" target="_blank" class="btn btn-warning btn-md float-right mr-1" role="button"><b class="fa fa-file-pdf-o"> Print Report </b></a>
                    <button type="button"  class="btn btn-warning btn-md float-right mr-1"  data-toggle="modal" data-target="#modal-issuefunds" data-backdrop="static" data-keyboard="false" href="#"> <b class="fa fa-minus-circle"> Issue Cash </b></button>
                    <button type="button"  class="btn btn-success btn-md float-right mr-1"  data-toggle="modal" data-target="#modal-addfunds" data-backdrop="static" data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> Add Funds </b></button>

                </div>
                
              </div>
        </div><!-- /.container-fluid -->
    </section>

    

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="stafftable" class="table table-striped table-hover projects">
                                <thead>
                                    <tr>
                                        <th width="10%">#</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>To</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    @if(count($transactions) > 0)
                                    @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{$counter}}</td>
                                        <td>{{$transaction -> description}}</td>
                                        <td>{{ date("d-m-Y", strtotime($transaction -> transaction_date)) }} </td>
                                        <td>{{$transaction -> issuedto}}</td>
                                        <td>  <?php if($transaction -> transactiontype == 'Deposit'){ ?>
                                            <span class="badge badge-success">Deposit</span>
                                            <?php }
                                               else {?>
                                                <span class="badge badge-info">Withdraw</span> 
                                                <?php } ?>
                                        </td>
                                        <td>{{ number_format($transaction -> amount,2)}}</td>
                                        <td><a href="pettycash/{{$transaction -> transactionid}}/edit" title="Click to Edit Customer Details"><i  <button type="button" class="btn btn-success hvr-icon-float-away btn-sm btn-md"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button></a></td>
                                        <td> <a href="#" onclick="return WarningDelete(1);" title="Click To Delete"><i <button type="button" class="btn btn-danger btn-sm hvr-icon-sink-away"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></i></a></td>		


                                        <?php $counter += 1; ?>
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
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection

