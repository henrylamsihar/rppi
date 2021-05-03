@extends('layouts.master')

@section('title1')
Laporan
@endsection
@section('title2')
Laporan Transaksi
@endsection


@section('content1')
 

 

<!DOCTYPE html>
<html>
 <head>
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
 </head>
 <body>
  <br />
  
   
   <div class="panel panel-default">
    <div class="panel-heading">
     <div class="row">
      
      
      <div class="col-md-5">
       <div class="input-group input-daterange">
           <input type="text" name="from_date" id="from_date" readonly class="form-control">
           <div class="input-group-addon">to</div>
           <input type="text"  name="to_date" id="to_date" readonly class="form-control" />
       </div>
      </div>
      <div class="col-md-4">
       <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
       <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
       <button type="button" name="export5" id="export5" class="btn btn-info btn-sm">Export to PDF</button>
      </div>
      </div>
      <br>
      <div class="panel info-box panel-white">
      <div class="panel-body text-center panel-white">
        <div class="col-xs-12 col-md-3">
            <h3><b><span id="total_records"></span></b></h3>
            <h4>Transaksi</h4>
        </div>
        <div class="col-xs-12 col-md-3">
            <h3><b>Rp <span id="total_pendapatan"></span></b></h3>
            <h4>Total Pendapatan</h4>
        </div>    
        <div class="col-xs-12 col-md-3">
            <h3><b>Rp <span id="total_modal"></span></b></h3>
            <h4>Total Modal</h4>
        </div>
        <div class="col-xs-12 col-md-3">
            <h3><b>Rp <span id="total_profit"></span></b></h3>
            <h4>Total Profit</h4>
        </div> 
      
      </div>
     </div>
     
    </div>
    
    <div class="panel-body">
     <div class="table-responsive">
     <table class="table" >
      <!-- <table class="table table-striped table-bordered"> -->
       <thead>
        <tr >
         <th width="5%">OrderID</th>
         <th width="15%">Date</th>
         <!-- <th width="15%">Pembeli</th> -->
         <th width="15%">Pendapatan</th>
         <th width="15%">Modal</th>
         <th width="15%">Profit</th>
        </tr>
       </thead>
       <tbody>
       
       </tbody>
      </table>
      {{ csrf_field() }}
     </div>
    </div>
   </div>
  
 </body>
</html>

<script>
$(document).ready(function(){

 var date = new Date();

 $('.input-daterange').datepicker({
  todayBtn: 'linked',
  format: 'yyyy-mm-dd',
  autoclose: true
 });

 var _token = $('input[name="_token"]').val();

 fetch_data();

 function fetch_data(from_date = '', to_date = '')
 {
  $.ajax({
   url:"{{ route('daterange.fetch_data') }}",
   method:"POST",
   data:{from_date:from_date, to_date:to_date, _token:_token},
   dataType:"json",
   success:function(data)
   {
    var output = '';
    var totalpendapatan = 0;
    var totalmodal = 0;
    var totalprofit = 0;
    
    
    for(var count = 0; count < data.length; count++)
    {
        var prof = data[count].total-data[count].totalModal;
   
   
     output += '<tr>';
     output += '<td>' + data[count].id + '</td>';
     output += '<td>' + data[count].stringDate + '</td>';
    //  output += '<td>' + data[count].nm + '</td>';
     output += '<td>' + data[count].total + '</td>';
     output += '<td>' + data[count].totalModal + '</td>';
     output += '<td>' + prof + '</td></tr>';
     
     var totalpendapatan = totalpendapatan + data[count].total;
     var totalmodal = totalmodal + data[count].totalModal;
     var totalprofit = totalprofit+prof;

    }
    $('#total_records').text(data.length);
    $('#total_pendapatan').text(totalpendapatan);
    $('#total_modal').text(totalmodal);
    $('#total_profit').text(totalprofit);
    $('tbody').html(output);
   }
  })
 }

 function eksport_data(from_date = '', to_date = '')
 {
  $.ajax({

   success: function (data) {
           
                var url = "/api.test?from_date=" + from_date + "&" + "to_date=" + to_date;
                window.open(url, "_blank");
            }
                
            
  })
 }

 $('#export5').click(function(){
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  if(from_date != '' &&  to_date != '')
  {
   eksport_data(from_date, to_date);
  }
  else
  {
   alert('Both Date is required');
  }
 });

 $('#filter').click(function(){
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  if(from_date != '' &&  to_date != '')
  {
   fetch_data(from_date, to_date);
  }
  else
  {
   alert('Both Date is required');
  }
 });

 $('#refresh').click(function(){
  $('#from_date').val('');
  $('#to_date').val('');
  fetch_data();
 });


});
</script>




    @endsection