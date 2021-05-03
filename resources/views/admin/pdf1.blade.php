<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Barang {{$awal}} - {{$akhir}}</title>
</head>
<body>
<b>Laporan Penjualan Barang</b> 
({{$awal}} - {{$akhir}})
<p>
<br>
Total Pemasukan : Rp{{$tp}}, Total Modal : Rp{{$tm}}, Total Profit Rp{{$prf}}

    <table class="table" border="1">

    <thead>
    <tr>

    <th width="15%">Nama Produk</th>
         <th width="15%">Jumlah Terjual</th>
         <th width="15%">Penjualan Kotor</th>
         <th width="15%">Modal</th>
         <th width="15%">Profit</th>


    </tr>
 </thead>
 <?php
for($i = 0; $i < count($data3); $i++) { ?>
   
 <tr>
        <td>{{$data3[$i]['nameProduct']}} </td>
        <td>{{$data3[$i]['totalqtty']}} </td>
        <td>{{$data3[$i]['tp']}} </td>
        <td>{{$data3[$i]['tm']}} </td>
        <td>{{$data3[$i]['prf']}} </td>

 </tr>                     
 
 <?php } ?>
 
    </table>
 

        </body>
</html>