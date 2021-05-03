<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Barang {{$awal}} - {{$akhir}}</title>
</head>
<body>

<b>Laporan Transaksi</b> 
({{$awal}} - {{$akhir}})
<p>
<br>

    <table class="table" border="1">

    <thead>
    <tr>

    <th width="15%">OrderID</th>
         <th width="15%">Date</th>
         <th width="15%">Pendapatan Kotor</th>
         <th width="15%">Modal</th>
         <th width="15%">Profit</th>


    </tr>
 </thead>
 <?php
for($i = 0; $i < count($data3); $i++) { ?>
   
 <tr>
        <td>{{$data3[$i]['id']}} </td>
        <td>{{$data3[$i]['stringDate']}} </td>
        <td>{{$data3[$i]['total']}} </td>
        <td>{{$data3[$i]['totalModal']}} </td>
        <td>{{$data3[$i]['total']-$data3[$i]['totalModal']}} </td>

 </tr>                     
 
 <?php } ?>
 
    </table>
 

        </body>
</html>