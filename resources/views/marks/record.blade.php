@extends('layouts.design')
@section('content')

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
                            <h4 class="page-title m-0">RECORD MARKS</h4>
                        </div>
                        <div class="col-md-4">
                        <a href="{{URL::to('/')}}/academics" class="btn btn-primary float-right btn-md"   role="button"><b class="fa fa-undo"> BACK </b></a>  
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
                        
                            <form name="demo" method="post" action="store">
                            {{ csrf_field() }}
                            <table id="datatable-buttons"
                                    class="table-sm table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                   
                                <tr>
                                    <td>#</td>
                                    <td>Admn No.</td>
                                    <td>Student Name</td>
                                    <td>Marks</td> <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                
                                <?php $counter = 1;   $previous = count($previousMarks)?>

                                @foreach($students as $student)
                                    <tr>
                                    
                                        <td><?php echo $counter ?>|</td>
                                        <td><div style='display:none'><input type="text" value="{{$student->student_id}}" name="adms" id="adms" readonly="readonly" size="5" ></div>{{$student->student_id}}</td>
                                        <td>{{$student->studentsname}}</td> 
                                        <td ><input type="number"  name="subject" value='<?php  if($previous > 0 && array_key_exists($student->student_id, $previousMarks)){ echo $previousMarks[$student->student_id];  } ?>' id="inputMarks" size="15" tabindex='<?php echo "index"?>' onkeyup="return checkInput(this.value)" /></td>
                                        
                                    </tr>
                                    <?php $counter += 1; ?>
                                @endforeach
                                
                            	
                           
                            </tbody>
                    </table>

                    <div>

                    <input type="hidden" name="course_id" value="{{$inputs['course_id']}}" >
                    <input type="hidden" name="subject_id" value="{{$inputs['subject_id']}}" >
                    <input type="hidden" name="examyear" value="{{$inputs['examyear']}}" >
                    <input type="hidden" name="term" value="{{$inputs['term']}}" >
                    <input type="hidden" name="examtype" value="{{$inputs['examtype']}}" >
                    
                    <input type=hidden name=ads id=sa value= />
                    <input type=hidden name=subs id=subs value= />
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                        
                     


                   
                   <td colspan=25>
                         <button style = "display: table; margin: 0 auto" type="submit" class="btn btn-primary " onClick="return getValues()" >SAVE MARKS</button>
                   </div>
                    </form>

                    


                        </div>

                    



                    </div>
                </div>
            </div>


        </div>
    </div>




</div>





@endsection