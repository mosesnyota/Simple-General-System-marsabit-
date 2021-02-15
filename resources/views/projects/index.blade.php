@extends('layouts.design')
@section('content')

  <!-- Start content -->
  <div class="content">

      

      <div class="page-content-wrapper ">

          <div class="container-fluid">

              <div class="row">
                  <div class="col-sm-12">
                      <div class="page-title-box">
                          <div class="row align-items-center">
                              <div class="col-md-8">
                                  <h4 class="page-title m-0">PROJECTS</h4>
                              </div>
                              <div class="col-md-4">
                                  <div class="float-right d-none d-md-block">
                                      <div class="dropdown">
                                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <i class="ti-settings mr-1"></i> Options
                                          </button>
                                          <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                                              <a class="dropdown-item" href="#">TO DO</a>
                                              
                                             
                                          </div>
                                      </div>


                                  </div>
                                  <a href="/finance/public/newproject" class="btn btn-success btn-md float-right mr-1"  role="button"><b class="ti-plus"> New Project </b></a>
                                  
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
                              <table id="datatable" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                  <thead>
                                  <tr>
                                      <th style="width: 10px;">#</th>
                                      <th>Project</th>
                                      <th>Location</th>
                                      <th>Start</th>
                                      <th>Deadline</th>
                                      <th>Budget</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                    <?php $counter = 1 ; ?>
                    @foreach($projects2 as $project)
                <?php 
                    $now = time(); 
                    $deadlinedate = strtotime($project ->deadline);
                    $datediff = $deadlinedate - $now ;
                    $time2 = strtotime($project ->deadline);  
                    $pdeadline= date('d-m-Y',$time2);
                    $days = round($datediff / (60 * 60 * 24));
                    $startdate = date('d-m-Y',strtotime($project ->start_date) );
                    $percentused =  0 ;
                    if (array_key_exists($project->project_id,$mytotals)){
                        $percentused =  ($mytotals[$project->project_id]/($project->budget) * 100) ;
                    }
                   

                    $percentusedlabel = "bg-warning";
                    if($percentused < 25){
                      $percentusedlabel = "bg-danger";
                    }else if($percentused > 25 && $percentused < 75){
                      $percentusedlabel = "bg-warning";
                    }else if($percentused > 75){
                      $percentusedlabel = "bg-success";
                    }
              ?>
                                  <tr>
                                      <td>{{$counter}}</td>
                                      <td>{{$project->project_name}}</td>
                                      <td>{{$project->location}}</td>
                                      <td>{{$project->start_date}}</td>
                                      <td>{{$project->deadline}}</td>
                                     
                        <td class="project_progress">
                            <div class="progress progress-sm">
                            <div class="progress-bar progress-bar-striped {{$percentusedlabel}}" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: {{$percentused}}%">
                                </div>
                            </div>
                            <small>
                              <?php if($percentused < 25){ ?>
                                <span class="badge badge-danger">{{number_format($percentused,1).' % Used '}}</span>
                                <?php }
                                   else if($percentused > 25 && $percentused < 75){?>
                                    <span class="badge badge-warning">{{number_format($percentused,1).' % Used '}}</span> 
                                    <?php }  else if($percentused > 75){?>
                                      <span class="badge badge-success">{{number_format($percentused,1).' % Used '}}</span> 
                                      <?php } ?>
                            </small>
                        </td>

                        @php
                          $days = $project->days;
                          if($days == 0){
                            $days = 1;
                          }
                          $activityday = $completionStatus[$project->project_id];
                          $completeddays = ($activityday/$days) * 100;      
                        @endphp
                        
                        <td class="project_progress">
                          <div class="progress progress-sm">
                          <div class="progress-bar progress-bar-striped {{$percentusedlabel}}" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: {{$completeddays}}%">
                              </div>
                          </div>
                          <small>
                            <?php if($completeddays < 25){ ?>
                              <span class="badge badge-danger">{{number_format($completeddays,1).' % Done '}}</span>
                              <?php }
                                 else if($completeddays > 25 && $completeddays < 75){?>
                                  <span class="badge badge-warning">{{number_format($completeddays,1).' % Done '}}</span> 
                                  <?php }  else if($completeddays > 75){?>
                                    <span class="badge badge-success">{{number_format($completeddays,1).' % Done '}}</span> 
                                    <?php } ?>
                          </small>
                      </td>

                        <td class="project-actions text-right">
                          <a class="btn btn-primary btn-md" href="viewproject/{{$project ->project_id}}">
                              <i class="fas fa-eye"></i> Open</a>

                              <a href="deleteproject/{{$project ->project_id}}/delete" class="btn btn-danger btn-md float-right mr-1 delete-confirm"    role="button" data-role="deleteproject"  data-id="{{$project ->project_id}}"><b class="fa fa-trash"></b></a> 
                      </td>
                      <?php $counter += 1 ; ?>


                                  </tr>
                                @endforeach
                                 
                                  </tbody>
                              </table>

                          </div>
                      </div>
                  </div> <!-- end col -->
              </div> <!-- end row -->            

          </div><!-- container fluid -->

      </div> <!-- Page content Wrapper -->

  </div> <!-- content -->

 

<!-- End Right content here -->
@endsection


