@extends('layouts.master')

@section('title2')
Detail Pesanan 
@endsection

@section('content1')



<div class="col-md-5">
<p>
<b>Nama Pembeli</b> 
<br/>
@if ($order->user == NULL) No Name 
@else {{ $order->user->fullname }} 

@endif

<br /><p>
<b>Tanggal Pemesanan</b>
<br />
{{$order->orderDate}}

<br /><p>
<b>Alamat</b>
<br />
{{$order->address}}

<br /><p>
<b>No Phone</b>
<br />
{{$order->telephone}}

<br /><p>
<b>Note</b>
<br />
{{$order->note}}
<br /><br />

@if ($order->statusOrder != "Pesanan dibatalkan" && $order->statusOrder != "Transaksi berhasil" )  

<a href="{{ route('pesanan.dec', $order->id) }}"> <button type="button" class="btn btn-sm btn-danger dropdown-toggle">Tolak/Batalkan Pesanan</button></a>
@endif







</div>

<div class="col-md-6">
<br /><p>
<b>Bukti Pembayaran</b>
<br />

<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
{{$order->textPayment}}
</p>
@if ($order->statusOrder == "Pesanan menunggu konfirmasi pembayaran")  
<a href="{{ route('pesanan.accpayment', $order->id) }}"> <button type="button" class="btn btn-sm btn-info dropdown-toggle">Konfirmasi Pembayaran</button></a>
@endif
<br /><br />

<table class="table table-responsive martop-sm">       
                    <thead>
                        <th width=50%>Nama Barang</th>
                        
                        <th  width=25%>Harga @unit</th>
                        <th width=10%>Quantity</th>
                        <th width=30%>Unit</th>
                        
                        <th width=10%>Harga</th>
                        
                        
                    </thead>
                    <tbody>
                    <?php  $total = 0; ?>
                        @foreach ($orderdetails as $o)
                        
                        <?php  $harga = $o->price*$o->quantity; 
                            $total = $total + $harga; ?>
                            <tr >  
                    
                           
                            <td><label for="quantity{{$o->id}}" class="control-label">{{$o->product['nameProduct']}}</label></a></td>    
                            <td>{{$o->price}}</td>
                            <td align="center" valign="middle">{{$o->quantity}}</td>
                            <td>{{$o->unit}}</td>
                            
                            
                            <td align="center" valign="middle">{{$harga}}</td>
                         
                            </tr>
                        @endforeach
                           <tr style="border-top:2pt solid black;">
                            <td><b>Total Harga</b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{$total}}</td>
                         
                            </tr>
                    </tbody>
                </table>




</form>

</div>







@endsection