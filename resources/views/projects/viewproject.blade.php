@extends('layouts.design')
@section('content')
  <!-- Start content -->
  <div class="content">
      <!-- Top Bar End -->
      <div class="page-content-wrapper ">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-sm-12">
                      <div class="page-title-box">
                          <div class="row align-items-center">
                              <div class="col-md-5">
                                  <h4 class="page-title m-0">PROJECT: {{ $project->project_name }}</h4>
                              </div>
                              <div class="col-md-7">
                                  <button type="button"  class="btn btn-success btn-md float-right mr-1"  data-toggle="modal" data-target="#modal-addfunds" data-backdrop="static" data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> Add Budget </b></button>
                                  <a href="comment/{{$project ->project_id}}/edit" class="btn btn-info btn-md float-right mr-1" target="_blank"  role="button"><b class="ti-settings mr-1"> Write Comment </b></a>
                                  <a href="editproject/{{$project ->project_id}}/edit" class="btn btn-success btn-md float-right mr-1"   role="button"><b class="fa fa-edit"> Edit Project </b></a>
                                 
 
                                  <div class="float-right d-md-block">
                                    <div class="dropdown">
                                        <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ti-import mr-1"></i> Report
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                                            <a class="dropdown-item" target="_blank" href="downloadPDF/{{$project ->project_id}}/download"><b class="fa fa-file-pdf">Get PDF Report</b></a>
                                            <a class="dropdown-item" target="_blank" href="downloadPDF/{{$project ->project_id}}/download"><b class="fa fa-file-csv">Get Excel Report</b></a>
                                            <a class="dropdown-item" target="_blank" href="setcurrency/{{$project ->project_id}}/currency"><b class="ti-settings">Set  Curreny</b></a>
                                            <a class="dropdown-item" target="_blank" href="setexchagerate/{{$project ->project_id}}/currency"><b class="ti-settings">Exchange Rate</b></a>
                                        </div>
                                    </div>


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
                                <h6 class="text-uppercase mt-0 float-left text-white-50">BUDGET</h6>
                                <h4 class="mb-3 mt-0 float-right">{{number_format(($project ->budget),2)}}</h4>
                            </div>
                        </div>
                        <div class="p-3">
                            <div class="float-right">
                                <a href="#" class="text-white-50"><i class="mdi mdi-cube-outline h5"></i></a>
                            </div>
                            <p class="font-14 m-0">Percentage of budget: 100 % </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-info mini-stat text-white">
                        <div class="p-3 mini-stat-desc">
                            <div class="clearfix">
                                <h6 class="text-uppercase mt-0 float-left text-white-50">Amount Used</h6>
                                <h4 class="mb-3 mt-0 float-right">{{number_format($totalAmountUsed,0)}}</h4>
                            </div>
                        </div>
                        <div class="p-3">
                            <div class="float-right">
                                <a href="#" class="text-white-50"><i class="mdi mdi-buffer h5"></i></a>
                            </div>
                            <p class="font-14 m-0">Percentage Used: {{number_format(($totalAmountUsed/$project ->budget) * 100,2)}} %</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-pink mini-stat text-white">
                        <div class="p-3 mini-stat-desc">
                            <div class="clearfix">
                                <h6 class="text-uppercase mt-0 float-left text-white-50">Balance</h6>
                                <h4 class="mb-3 mt-0 float-right">{{number_format(($project ->budget - $totalAmountUsed),2)}}</h4>
                            </div>
                        </div>
                        <div class="p-3">
                            <div class="float-right">
                                <a href="#" class="text-white-50"><i class="mdi mdi-tag-text-outline h5"></i></a>
                            </div>
                            <p class="font-14 m-0">Percentage Balance: {{number_format(((($project ->budget - $totalAmountUsed) /$project ->budget)*100),1)}}% </p>
                        </div>
                    </div>
                </div>

                @php  
                $days = $project->days;
                if($days == 0 ){
                    $days = 1;
                }
                $activityday = $completionStatus[$project->project_id];
                $completeddays = ($activityday/$days) * 100;      
               @endphp

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success mini-stat text-white">
                        <div class="p-3 mini-stat-desc">
                            <div class="clearfix">
                                <h6 class="text-uppercase mt-0 float-left text-white-50">Goal Completed</h6>
                                <h4 class="mb-3 mt-0 float-right"> {{number_format($completeddays,0)}}% </h4>
                            </div>
                            
                        </div>
                        <div class="p-3">
                            <div class="float-right">
                                <a href="#" class="text-white-50"><i class="mdi mdi-briefcase-check h5"></i></a>
                            </div>
                            <p class="font-14 m-0">Completed : {{number_format($completeddays,1)}} % </p>
                        </div>
                    </div>
                </div>
            </div>

              <div class="row">

                <div class="col-xl-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                       
                                                           <!-- Nav tabs -->
                                                           <ul class="nav nav-pills nav-justified" role="tablist">
                                                               <li class="nav-item waves-effect waves-light">
                                                                   <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab">
                                                                       <span class="d-none d-md-block">TRANSACTIONS</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span> 
                                                                   </a>
                                                               </li>
                                                               <li class="nav-item waves-effect waves-light">
                                                                   <a class="nav-link" data-toggle="tab" href="#profile-1" role="tab">
                                                                       <span class="d-none d-md-block">BUDGET DISTRIBUTION</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                                                   </a>
                                                               </li>
                                                               <li class="nav-item waves-effect waves-light">
                                                                   <a class="nav-link" data-toggle="tab" href="#messages-1" role="tab">
                                                                       <span class="d-none d-md-block">CRITICAL MILESTONES</span><span class="d-block d-md-none"><i class="mdi mdi-email h5"></i></span>
                                                                   </a>
                                                               </li>
                                                           </ul>
                                                           <!-- Tab panes -->
                                                           <div class="tab-content">
                                                            <div class="tab-pane active p-3" id="home-1" role="tabpanel">
                                                                <div class="row"> <div class="col-12 col-sm-12">
                                                                    <button type="button"  class="btn btn-warning btn-md float-right mr-1"  data-toggle="modal" data-target="#modal-uploadexcel" data-backdrop="static" data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> Upload Excel </b></button>
                                                                    <button type="button"  class="btn btn-success btn-md float-right mr-1"  data-toggle="modal" data-target="#modal-dispersfunds" data-backdrop="static" data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> Record Transaction </b></button>
                                                                </div></div>
                                                                <div class="row">  <div class="col-12 col-sm-12"> </div></div>
                                                                <div></div>
                                                                <div class="row"><div class="col-12 col-sm-12">
                                                                    <div class="card">
                                                                <table id="nobuttonstable" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                                    <thead>
                                                                    <tr>
                                                                      <th style="width: 10%;">Code</th>
                                                                      <th style="width: 20%;">Budget Line</th>
                                                                      <th style="width: 30%;">Narration</th>
                                                                      <th>Date</th>
                                                                      <th>Amount</th>
                                                                      <th>Action</th>
                                                                     
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                      <?php $counter = 1 ; ?>
                                            
                                                                      @foreach ($disbursments as $disbursment)
                                                                              <tr id="{{$disbursment ->disbursment_id}}">
                                                                                 
                                                                                  <td data-target="voucherno" style="width:10%;">{{$disbursment ->voucherno}}</td>
                                                                                  <td data-target="votehead_name"  style="width: 20%;">{{$disbursment ->votehead_name}}</td>
                                                                                  <td data-target="narrationname" style="width: 30%;">{{$disbursment ->narration}}</td>
                                                                                  
                                                                                  <td data-target="voucherdate"> {{ date("d-m-Y", strtotime($disbursment ->voucherdate )) }} </td>
                                                                                  <td data-target="debit">{{number_format($disbursment ->debit,2)}}</td>
                                                                                  <td>
                                                                                    <a class="btn btn-primary btn-sm" href="editdisbursment/{{$disbursment ->disbursment_id}}"><i class="fas fa-edit"></i></a>
                                                                                    <button type="button" class="btn btn-danger btn-sm mr-1 delete-confirm"  href="disbursment/destroy/{{$disbursment ->disbursment_id}}"> <a  data-role="deletedisburse"  data-id="{{$disbursment ->disbursment_id}}"> <i class="fa fa-trash" > </i></a>  </button>  
                                                                                    <button type="button" class="btn btn-success btn-sm mr-1"> <a  data-role="updatedispersementvotehead"  data-id="{{$disbursment ->disbursment_id}}"> <i class="fa fa-eye" > Assign </i></a>  </button>  
                                                                               

                                                                                  </td>  
                                                                                
                                                                                  <?php $counter += 1 ; ?>
                                                                              </tr>
                                                                       @endforeach
                                            
                                                                    </tbody>
                                                                  </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                                
                                                            
                                                            </div>




                                                               <div class="tab-pane p-3" id="profile-1" role="tabpanel">
                                                                  
                
                                                                    <div class="row"> <div class="col-12 col-sm-12">
                                                                        
                                                                        <button type="button"  class="btn btn-success btn-md float-right mr-1"  data-toggle="modal" 
                                                                        data-target="#modal-addvotehead" data-backdrop="static" data-keyboard="false" href="#"> 
                                                                        <b class="fa fa-plus-circle"> Add Vote Head </b></button>
                                                    
                                                                    </div></div>
                                                                    
                                                                    <div class="row"><div class="col-12 col-sm-12">
                                                                    <div class="card">
                                                                        <!-- /.card-header -->
                                                                     <div class="card-body p-0">
                                                                        <!-- .table-responsive -->
                                                                
                                                                        <div class="table-responsive">
                                                                            <table class="table m-0">
                                                                              <thead>
                                                                              <tr>
                                                                                <th>ID</th>
                                                                                <th>Budget Line</th>
                                                                                <th>Amount</th>
                                                                                <th>Used</th>
                                                                                <th>Balance</th>
                                                                                <th></th>
                                                                                
                                                                              </tr>
                                                                              </thead>
                                                                              <tbody>
                                                                                <?php $counter = 1 ; ?>
                                                                            @foreach ($voteheads as $votehead)
                                                                            @php $voteheadid =  $votehead->votehead_id   @endphp
                                                                            <tr>
                                                                                <td><a>VTH0{{$counter}}</a></td>
                                                                                <td>{{$votehead ->votehead_name}}</td>
                                                                                <td>{{number_format($votehead ->amount_allocated,2)}}</td>
                                                    
                                                                             @if (array_key_exists($voteheadid,$mytotals))
                                                                             <td><span class="badge badge-success">{{number_format($mytotals[$voteheadid],2)}}</span></td>
                                                                             <td><span class="badge badge-warning">{{number_format(($votehead ->amount_allocated - $mytotals[$voteheadid]),2)}}</span></td>
                                                                                                       
                                                                            @else
                                                                            <td><span class="badge badge-success">{{number_format(0,2)}}</span></td>
                                                                            <td><span class="badge badge-warning">{{number_format(($votehead ->amount_allocated - 0),2)}}</span></td>
                                                                             @endif   
                                                                             
                                                                             <td>
                                                                                <a class="btn btn-primary btn-sm" href="editvotehead/{{$votehead ->votehead_id}}"><i class="fas fa-edit"></i></a>
                                                                                <a class="btn btn-danger btn-sm delete-confirm" href="deletevotehead/{{$votehead ->votehead_id}}"><i class="fas fa-trash"></i></a>
                                                                                <a class="btn btn-warning btn-sm" href="budgetstatement/{{$votehead ->votehead_id}}/statement" target="_blank"><i class="fas fa-file-pdf">PDF</i></a>
                                                                                <a class="btn btn-success btn-sm" href="export/{{$votehead ->votehead_id}}" target="_blank"><i class="fas fa-file-csv">Excel</i></a>
                                                                     
                                                                            </tr>
                                                                            <?php $counter += 1 ; ?>
                                                                            @endforeach
                                                                              
                                                                              </tbody>
                                                                            </table>
                                                                          </div>
                                                                          <!-- /.table-responsive -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                </div>
                                                           



                                                            <div class="tab-pane p-3" id="messages-1" role="tabpanel">
                                                            <div class="row"> <div class="col-12 col-sm-12">
                                                                  <button type="button"  class="btn btn-success btn-md float-right mr-1"  
                                                                  data-toggle="modal" data-target="#modal-addactivity" data-backdrop="static" 
                                                                  data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> Add Milestone</b></button>
                                                  
                                                              </div></div>
                                                  
                                                                  <div class="row"><div class="col-12 col-sm-12">
                                                                  <div class="card">
                                                                      <!-- /.card-header -->
                                                                   <div class="card-body p-0">
                                                                      <!-- .table-responsive -->
                                                              
                                                                      <div class="table-responsive">
                                                                          <table class="table m-0">
                                                                            <thead>
                                                                            <tr>
                                                                              <th>ID</th>
                                                                              <th>Activity</th>
                                                                              <th>Start Date</th>
                                                                              <th>Deadline</th>
                                                                              <th>Status</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                              <?php $counter = 1 ; ?>
                                                                          @foreach ($activities as $activity)
                                                                         
                                                                          <tr id="{{$activity ->activity_id}}">
                                                                              <td data-target="counter"><a>ACT0{{$counter}}</a></td>
                                                                              <td data-target="activityname">{{$activity->activityname}}</td>
                                                                              <td data-target="startdate">{{$activity ->start_date}}</td>
                                                                              <td data-target="deadline">{{$activity ->deadline_date}}</td>
                                                                              
                                                                              @if($activity ->cur_status == "Completed") 
                                                                                <td data-target="curstatus"><span class="badge badge-success">{{$activity ->cur_status}}</span></td>
                                                                              @elseif($activity ->cur_status == "ongoing")
                                                                                <td data-target="curstatus"><span class="badge badge-warning">{{"In Progress"}}</span></td>
                                                                              @elseif($activity ->cur_status == "onhold")
                                                                                <td data-target="curstatus"><span class="badge badge-danger">{{"On Hold"}}</span></td>
                                                                              @endif 
                                                         
                                                                            <td><button type="button" class="btn btn-success btn-sm mr-1"> <a  data-role="update"  data-id="{{$activity ->activity_id}}"> <i class="fa fa-eye" > Update </i></a>  </button>
                                                                            <a class="btn btn-primary btn-sm" href="editmilestone/{{$activity ->activity_id}}"><i class="fas fa-edit"></i></a>
                                                                       
                                                                            <a class="btn btn-danger btn-sm delete-confirm" href="deletemilestone/{{$activity ->activity_id}}"><i class="fas fa-trash"></i></a>
                                                                              
                                                                             
                                                  
                                                  
                                                                          </tr>
                                                                          <?php $counter += 1 ; ?>
                                                                          @endforeach
                                                                            
                                                                            </tbody>
                                                                          </table>
                                                                        </div>
                                                                        <!-- /.table-responsive -->
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              </div>
                                                              
                                                
                                                               </div> <!-- end tab  -->



       
                                                            <div class="tab-pane p-3" id="settings-1" role="tabpanel">

                                                                <div class="row">
                                                                <div class="col-xl-6">

                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="card m-b-30">
                                                                                <div class="card-body">
                                                    
                                                                                    <h4 class="mt-0 header-title">Upload Files for this project</h4>
                                                                                    
                                                    
                                                                                    <div class="m-b-30">
                                                                                        <form action="#" class="dropzone">
                                                                                            <div class="fallback">
                                                                                                <input name="file" type="file" multiple="multiple">
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                    
                                                                                    <div class="text-center m-t-15">
                                                                                        <button type="button" class="btn btn-primary waves-effect waves-light">Send Files</button>
                                                                                    </div>
                                                    
                                                                                </div>
                                                                            </div>
                                                                        </div> <!-- end col -->
                                                                    </div> <!-- end row --> 
                                                                </div>

                                                                
                                                            </div>
                                                            </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
              <!-- end page title -->

             

                        

          </div><!-- container fluid -->

      </div> <!-- Page content Wrapper -->

           <!-- end row -->

           
        </div>

      
@include('projects.modals')

     
      
        <!-- end row -->

 

<!-- End Right content here -->
@endsection

