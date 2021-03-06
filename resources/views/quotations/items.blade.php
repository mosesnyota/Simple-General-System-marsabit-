@extends('layouts.design')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
   <style>
        table { width: 100%; }
        table, th, td { border: solid 1px #DDD;
            border-collapse: collapse; padding: 2px 3px; text-align: center;
        }
    </style>

<div class="page-content-wrapper ">

<div class="container-fluid">


<div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title m-0">Invoice Details : {{$invoice ->narration}} </h4>
                        <h4 class="page-title m-0">Customer : {{ $invoice ->customer_id}} </h4>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                       
                       
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
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <body>
                   
                    <div class="col-md-12">
                        <div class="float-right d-none d-md-block">
                            <input type="button" id="addRow" class="btn btn-md btn-primary float-right d-none d-md-block" value="Add New Row" onclick="addRow()" />
                            
                            </div> 
                    </div>
                        <div id="cont">
                <form role="form" enctype="multipart/form-data" >
                    
                        <table id = "empTable">
                       
                        <thead>
                      <tr>
                     
                        <th>Item Name</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th></th>
                      
                      </tr>
                      </thead>
                      <tbody>

                    
                      
                     
                        </table>
                        </div>
                        
                        </div>   <!--the container to add the table.-->
                        <div ></div>
                        
                        
                    </body>

                </div>
                <div class="card-footer">
                    <div class="col text-center">
                   
                    <button type="button"  id="bt" value="Verify Data" onclick="submitData()" class="btn btn-secondary">Verify Details</button>
                    </div>
                 </div>
            </div>
        </div>
</div>

<script>
    var arrHead = new Array();
    arrHead = ['Item Name', 'Unit Price', 'Quantity','']; // table headers.

    // first create a TABLE structure by adding few headers.
    function createTable() {
        var empTable = document.createElement('table');
       
        empTable.setAttribute('id', 'empTable');  // table id.
        empTable.setAttribute('_token', '{{ csrf_field() }}');

        var tr = empTable.insertRow(-1);

        for (var h = 0; h < arrHead.length; h++) {
            var th = document.createElement('th'); // the header object.
            th.innerHTML = arrHead[h];
            tr.appendChild(th);
        }

        var div = document.getElementById('cont');
        div.appendChild(empTable);    // add table to a container.
    }

    // function to add new row.
    function addRow() {
        var empTab = document.getElementById('empTable');

        var rowCnt = empTab.rows.length;    // get the number of rows.
        var tr = empTab.insertRow(rowCnt); // table row.
        tr = empTab.insertRow(rowCnt);

        for (var c = 0; c < arrHead.length; c++) {
            var td = document.createElement('td');          // TABLE DEFINITION.
            td = tr.insertCell(c);

            if (c == 3) {   // if its the first column of the table.
                // add a button control.
                var button = document.createElement('input');

                // set the attributes.
                button.setAttribute('type', 'button');
                button.setAttribute('value', 'Remove');

                // add button's "onclick" event.
                button.setAttribute('onclick', 'removeRow(this)');

                td.appendChild(button);
            }
            else {
                // the 2nd, 3rd and 4th column, will have textbox.
                var ele = document.createElement('input');
                ele.setAttribute('type', 'text');
                ele.setAttribute('value', '');
                ele.setAttribute('class','search-box');
                td.appendChild(ele);
            }
        }
    }

    // function to delete a row.
    function removeRow(oButton) {
        var empTab = document.getElementById('empTable');
        empTab.deleteRow(oButton.parentNode.parentNode.rowIndex); // buttton -> td -> tr
    }

    // function to extract and submit table data.
    function submitData() {
        var myTab = document.getElementById('empTable');
        var arrValues = new Array();

        // loop through each row of the table.
        for (row = 1; row < myTab.rows.length - 1; row++) {
            // loop through each cell in a row.
            for (c = 0; c < myTab.rows[row].cells.length; c++) {
                var element = myTab.rows.item(row).cells[c];
                if (element.childNodes[0].getAttribute('type') == 'text') {
                    arrValues.push("'" + element.childNodes[0].value + "'");
                }
            }
        }
        //console.log( JSON.stringify(arrValues));
        
      
 
 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

  /* Submit form data using ajax*/
  $.ajax({
      url: "{{ url('savejobestimate')}}",
      method: 'post',
      data: JSON.stringify(arrValues),
      success: function(response){
        var invoiceID = response;
        window.location.href = "../defineitems/"+invoiceID+"/view";
      }});



       
    }




</script>


</div><!-- container fluid -->

</div> <!-- Page content Wrapper -->


@endsection