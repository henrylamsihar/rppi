<?php

namespace App\Http\Controllers;
Use App\Order;
Use App\User;
Use App\Orderdetail;
Use App\Product;
Use App\Toko;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

use Yajra\DataTables\Datatables;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'ASC') -> get(); 
        $prod = Product::orderBy('nameProduct', 'ASC')->get();
        
       return view('admin.pesanan', compact('orders','prod','toko'));
    }

    // public function apitest(){
    //     $data = Product::all();
    //     $c = Product::all()->count();
    //      if(0)
    //     //  if($request->from_date != '' && $request->to_date != '')
    //      {
    //        $zxc = Orderdetail::with(array('order' => function($q){
    //            $q->where("statusOrder", "=", "Transaksi berhasil");
    //            $q->whereBetween('createdDate', array($request->from_date, $request->to_date));
    //        }))->with('product')->get();
    //         //    return ($data);
    //      }
    //      else
    //      {
    //        $zxc = Orderdetail::with(array('order' => function($q){
    //            $q->where("statusOrder", "=", "Transaksi berhasil");
    //         //    $q->whereBetween('createdDate', array($request->from_date, $request->to_date));
    //        }))->with('product')->get();
    //         //    return ($data);
    //      }
   
    //      $zxc = $zxc->where('order', '<>', '', 'and')->except('order')->toArray();
    //      for($i = 0; $i < $c; $i++) {
    //        $data[$i]['totalqtty'] = 0;
    //        foreach($zxc as $x){
    //            if($x['idProduct'] == $data[$i]['id'] ){
    //                $data[$i]['totalqtty'] = $data[$i]['totalqtty']+ $x['quantity'] ;
    //            }}}

    //            for($i = count($data)-1; $i > -1; $i--) {
    //             if($data[$i]['totalqtty'] == 0){
    //                 unset($data[$i]);
    //             }}
    //             $data = $data->except('order')->toArray();
    //             return ($data);
    // }

    public function apitest(Request $request){
        if($request->from_date != '' && $request->to_date != '')
        {
         $data = Order::where('statusOrder', '=', 'Transaksi berhasil')->with('user')->whereBetween('createdDate', array($request->from_date, $request->to_date))->get();
         $c = Order::where('statusOrder', '=', 'Transaksi berhasil')->with('user')->whereBetween('createdDate', array($request->from_date, $request->to_date))->count(); 
           
        }
        else
        {
          $request->from_date = Carbon::now()->startOfMonth();
          $request->to_date = Carbon::now();
          $data = Order::where('statusOrder', '=', 'Transaksi berhasil')->with('user')->whereBetween('createdDate', array($request->from_date, $request->to_date))->get();
          $c = Order::where('statusOrder', '=', 'Transaksi berhasil')->with('user')->whereBetween('createdDate', array($request->from_date, $request->to_date))->count(); 
          
        }
        if($c>0){
          $data[0]['idPaid'] = 0;
          $data[0]['statusOrder'] = 0;
          
          for($i = 0; $i < $c; $i++) {
          $data[0]['idPaid'] = $data[0]['idPaid'] + $data[$i]['total'];
          $data[0]['statusOrder'] = $data[0]['statusOrder'] + $data[$i]['totalModal'];
          $data[$i]['nm'] = $data[$i]['user']['name']; 
          $data[$i]['stringDate'] = date('d M Y', strtotime($data[$i]['createdDate']));
       
      }}
        // echo json_encode($data);
        $data3 = $data;
$awal = date('d M Y', strtotime($request->from_date));  
$akhir = date('d M Y', strtotime($request->to_date));

$pdf = PDF::loadView('admin.pdf2', compact('data3','awal','akhir','tp','tm','prf'));
$pdf->setPaper('a4','portair');
return $pdf->stream();

// $data3 = collect($data3)->get();
// return view('admin.pdf1', compact('data3'));

//    return $data3;
 }

    public function cetakrekapbarang(Request $request){

           $data2 = DB::table('orders_detail')
           ->join('orders', 'orders_detail.idOrder', '=', 'orders.id')
           ->join('product', 'orders_detail.idProduct', '=', 'product.id')
           ->select('orders_detail.*', 'orders.createdDate','orders.statusOrder', 'product.nameProduct', 'product.priceModal')
           ->get();
   
           if($request->from_date != '' && $request->to_date != '')
           {
               $data2 = $data2->whereBetween('createdDate',  array($request->from_date, $request->to_date))->where('statusOrder','=','Transaksi berhasil');
               $data2 = $data2->toArray();
                  
           }
           else
           {
               $data2 = $data2->where('statusOrder','=','Transaksi berhasil');;
               $data2 = $data2->toArray();
       
           }
   
            $data = Product::all();
            $data = $data->toArray();
            $c = DB::table('product')->count();
            for($i = 0; $i < $c; $i++) {
                           $data[$i]['totalqtty'] = 0;
                           $data[$i]['tp'] = 0;
                           $data[$i]['tm'] = 0;
                           $data[$i]['prf'] = 0;
                           foreach($data2 as $x){
                               if($x->idProduct == $data[$i]['id'] ){
                                   $data[$i]['totalqtty'] = $data[$i]['totalqtty']+ $x->quantity ;
                                   $data[$i]['tp'] = $data[$i]['tp']+ $x->subtotal;
                                   $data[$i]['tm'] = $data[$i]['tm']+ $x->priceModal*$x->quantity;
                                   $data[$i]['prf'] = $data[$i]['tp']-$data[$i]['tm'];
                                   
                               }}}
                               for($i = count($data)-1; $i > -1; $i--) {
                                if($data[$i]['totalqtty'] == 0){
                                    unset($data[$i]);
                            }}
    usort($data, function ($a, $b) {return $a['totalqtty'] < $b['totalqtty'];});
    $data3=[];
    $tp = 0;
    $tm = 0;
    $prf = 0;
    foreach($data as $user ){ 
        $tp = $tp + $user['tp'];
        $tm = $tm + $user['tm'];
        $prf = $tp + $tm;
          $data3[]=$user; 
        
        }
  
// $data3 = 1;
// $data3 = collect($data3)->sortBy('totalqtty')->reverse()->toArray();
$awal = date('d M Y', strtotime($request->from_date));  
$akhir = date('d M Y', strtotime($request->to_date));

$pdf = PDF::loadView('admin.pdf1', compact('data3','awal','akhir','tp','tm','prf'));
$pdf->setPaper('a4','portair');
   return $pdf->stream();

// $data3 = collect($data3)->get();
// return view('admin.pdf1', compact('data3'));

//    return $data3;
    }


    function fetch_data2(Request $request)
    {
        
     if($request->ajax())
     {
         
        $data2 = DB::table('orders_detail')
        ->join('orders', 'orders_detail.idOrder', '=', 'orders.id')
        ->join('product', 'orders_detail.idProduct', '=', 'product.id')
        ->select('orders_detail.*', 'orders.createdDate','orders.statusOrder', 'product.nameProduct', 'product.priceModal')
        ->get();

        if($request->from_date != '' && $request->to_date != '')
        {
            $data2 = $data2->whereBetween('createdDate',  array($request->from_date, $request->to_date))->where('statusOrder','=','Transaksi berhasil');
            $data2 = $data2->toArray();
               
        }
        else
        {
            $request->from_date = Carbon::now()->startOfMonth();
            $request->to_date = Carbon::now();
            $data2 = $data2->whereBetween('createdDate',  array($request->from_date, $request->to_date))->where('statusOrder','=','Transaksi berhasil');
            $data2 = $data2->toArray();
    
        }

        
         $data = Product::all();
         $data = $data->toArray();
         $c = DB::table('product')->count();
         
         for($i = 0; $i < $c; $i++) {
                        $data[$i]['totalqtty'] = 0;
                        $data[$i]['tp'] = 0;
                        $data[$i]['tm'] = 0;
                        $data[$i]['prf'] = 0;
                        foreach($data2 as $x){
                            if($x->idProduct == $data[$i]['id'] ){
                                $data[$i]['totalqtty'] = $data[$i]['totalqtty']+ $x->quantity ;
                                $data[$i]['tp'] = $data[$i]['tp']+ $x->subtotal;
                                $data[$i]['tm'] = $data[$i]['tm']+ $x->priceModal*$x->quantity;
                                $data[$i]['prf'] = $data[$i]['tp']-$data[$i]['tm'];
                                
                            }}}
             
                            for($i = count($data)-1; $i > -1; $i--) {
                             if($data[$i]['totalqtty'] == 0){
                                 unset($data[$i]);
                         }}
                         
    usort($data, function ($a, $b) {return $a['totalqtty'] < $b['totalqtty'];});
 $data3=[];
 foreach($data as $user ){ 
       $data3[]=$user; 
  }
//   $data3 = collect($data3)->sortBy('totalqtty','ASC');
//  dd($data3);
                 return ($data3);
     

                
     }
    }

    function fetch_data(Request $request)
    {
     if($request->ajax())
     {
      if($request->from_date != '' && $request->to_date != '')
      {
       $data = Order::where('statusOrder', '=', 'Transaksi berhasil')->with('user')->whereBetween('createdDate', array($request->from_date, $request->to_date))->get();
       $c = Order::where('statusOrder', '=', 'Transaksi berhasil')->with('user')->whereBetween('createdDate', array($request->from_date, $request->to_date))->count(); 
         
      }
      else
      {
        $request->from_date = Carbon::now()->startOfMonth();
        $request->to_date = Carbon::now();
        $data = Order::where('statusOrder', '=', 'Transaksi berhasil')->with('user')->whereBetween('createdDate', array($request->from_date, $request->to_date))->get();
        $c = Order::where('statusOrder', '=', 'Transaksi berhasil')->with('user')->whereBetween('createdDate', array($request->from_date, $request->to_date))->count(); 
        
      }
      if($c>0){
        $data[0]['idPaid'] = 0;
        $data[0]['statusOrder'] = 0;
        
        for($i = 0; $i < $c; $i++) {
        $data[0]['idPaid'] = $data[0]['idPaid'] + $data[$i]['total'];
        $data[0]['statusOrder'] = $data[0]['statusOrder'] + $data[$i]['totalModal'];
        $data[$i]['nm'] = $data[$i]['user']['name']; 
        $data[$i]['stringDate'] = date('d M Y', strtotime($data[$i]['createdDate']));
     
    }}
      echo json_encode($data);
     }
    }

    public function index2()
    {
        $countorder = Order::where('statusOrder', '=', 'Transaksi berhasil')->whereYear('createdDate', Carbon::now()->year)->whereMonth('createdDate', Carbon::now()->month) ->count();
        $amount = DB::table('orders')->where('statusOrder', '=', 'Transaksi berhasil')->whereYear('createdDate', Carbon::now()->year)->whereMonth('createdDate', Carbon::now()->month) ->sum('total');
        $amountmodal = DB::table('orders')->where('statusOrder', '=', 'Transaksi berhasil')->whereYear('createdDate', Carbon::now()->year)->whereMonth('createdDate', Carbon::now()->month) ->sum('totalModal');
        $shu = ($amount-$amountmodal)/4;
        // $orders = Order::orderBy('id', 'ASC') -> get(); 
        $orders = Order::orderBy('id', 'ASC')->where('statusOrder', '=', 'Transaksi berhasil')->whereYear('createdDate', Carbon::now()->year)->whereMonth('createdDate', Carbon::now()->month)->get();
        // print_r($orders);
        // dd($orders);

         
        $nproduct =  Product::count();
        $d=[];
        for($i = 0; $i < 6; $i++) {
            for($j = 0; $j < 31; $j++) {
                $d[$i][$j] =  Order::where('statusOrder', '=', 'Transaksi berhasil')->whereYear('createdDate', Carbon::now()->year)->whereMonth('createdDate', Carbon::now()->month-$i) ->whereDay('createdDate', $j+1) ->count();
            }
        }

        $data2 = DB::table('orders_detail')->join('orders', 'orders_detail.idOrder', '=', 'orders.id')->join('product', 'orders_detail.idProduct', '=', 'product.id')->select('orders_detail.*', 'orders.createdDate','orders.statusOrder', 'product.nameProduct', 'product.priceModal')
        ->whereMonth('orders.createdDate', Carbon::now()->month)->get();
        $data2 = $data2->where('statusOrder','=','Transaksi berhasil');
        $data2 = $data2->toArray();
        $data = Product::all();
        $data = $data->toArray();
         $c = DB::table('product')->count();
         for($i = 0; $i < $c; $i++) {
                        $data[$i]['totalqtty'] = 0;
                        $data[$i]['tp'] = 0;
                        $data[$i]['tm'] = 0;
                        $data[$i]['prf'] = 0;
                        foreach($data2 as $x){
                            if($x->idProduct == $data[$i]['id'] ){
                                $data[$i]['totalqtty'] = $data[$i]['totalqtty']+ $x->quantity ;
                                $data[$i]['tp'] = $data[$i]['tp']+ $x->subtotal;
                                $data[$i]['tm'] = $data[$i]['tm']+ $x->priceModal*$x->quantity;
                                $data[$i]['prf'] = $data[$i]['tp']-$data[$i]['tm'];
                                
                            }}}     
                            for($i = count($data)-1; $i > -1; $i--) {
                             if($data[$i]['totalqtty'] == 0){
                                 unset($data[$i]);
                            }}
                            
            $data3=[];
            foreach($data as $user ){ 
                $data3[]=$user; 
            }
            $data3 = collect($data3)->sortBy('totalqtty')->reverse()->toArray();

        return view('admin.dashboard', compact('countorder','amount','orders','shu','nproduct','d','data3'));
    }
    
    public function accpesanan($id)
    {
        $product = Order::findOrFail($id);
        $input['statusOrder']="Pesanan telah dikonfirmasi";
        $product->update($input);
        $orders = Order::orderBy('id', 'ASC') -> get(); 
        return redirect()->route('pesanan.index')->with('message', 'Pesanan telah dikonfirmasi');
    }

    public function sendpesanan($id)
    {
        $product = Order::findOrFail($id);
        $input['statusOrder']="Pesanan dikirim";
        $product->update($input);
        $orders = Order::orderBy('id', 'ASC') -> get(); 
        return redirect()->route('pesanan.index')->with('message', 'Status Pesanan telah berubah');
    }
    
    public function decpesanan($id)
    {
        $product = Order::findOrFail($id);
        $input['statusOrder']="Pesanan dibatalkan";
        $product->update($input);
        $orders = Order::orderBy('id', 'ASC') -> get(); 
        return redirect()->route('pesanan.index')->with('message', 'Pesanan telah ditolak');
    }
    
        
    public function accpayment($id)
    {
        $product = Order::findOrFail($id);
        $input['statusOrder']="Pesanan siap dikirim";
        $input['isPaid']="1";
        $product->update($input);
        $orders = Order::orderBy('id', 'ASC') -> get(); 
        return redirect()->route('pesanan.index')->with('message', 'Pembayaran telah dikonfirmasi');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $pro = Product::find($input['idProduct']);
    
        $o['statusTransaksi'] = "Transaksi berhasil";

        $detail = new Order();
        $detail->statusOrder = "Transaksi berhasil";
        $detail->idUser = 0;
        $detail->deliveryMethod = "Pembeli langsung";
        // $detail->idStore = 1;
        $detail->telephone = 0;
        $detail->address = 0;
        $detail->orderDate = Carbon::now();
        $detail->createdDate = Carbon::now();
        $detail->deliveryDate = Carbon::now();
        $detail->note = 0;
        $detail->textPayment = 0;
        $detail->isPaid = 1;
        $detail->total = $pro['price'];;
        $detail->totalModal = $pro['priceModal'];
        $detail->save();
      
        $input2 = new Orderdetail();
       $input2['idOrder'] = $detail->id;
       $input2['idProduct'] = $input['idProduct'];
       $input2['quantity'] = $input['quantity'];
       $input2['priceModal'] = $input['idProduct'];
       $input2['createdDate'] = Carbon::now();
       
    //    $input['unit'] = "box";
    $input2['unit'] = $pro['unit'];
    $input2['price'] = $pro['price'];
    $input2['subtotal'] = $input2['quantity']*$input2['price'];
    $input2['priceModal'] = $pro['priceModal'];
    $input2['subtotalModal'] = $input2['quantity']*$input2['priceModal'];

    // $harga = Product::find($input['idProduct'])->get('price');
// $user = User::where("email",$email)->get(['role']);
       $input2->save();
       return redirect()->route('pesanan.index');
        // Product::create($input);
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Contact Created'
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $orderdetails = Orderdetail::where('idOrder', '=', $id)->orderBy('id', 'ASC') -> get();

        return view('admin.showorder', compact('order','orderdetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return $order;
        // return view('admin.product.editproduct', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $sumharga = 0;
        $summodal = 0;
        $data = $request;

        //  dd($data);
        for($i = 0; $i < count($data['id']); $i++) {
    
            $input = [
                'quantity' => $data['quantity'][$i],
            ];
            $orddetail = Orderdetail::find($data['id'][$i]);
            $orddetail['quantity'] = $data['quantity'][$i];
            $orddetail->update();

            $sumharga = $sumharga + $orddetail->product['price'] * $orddetail->quantity ;
            $summodal = $sumharga + $orddetail->product['priceModal'] * $orddetail->quantity ;;
    }

    $ord = Order::findOrFail($id);   
    $inp['statusOrder']="Pesanan telah dikonfirmasi";
    $inp['total']=$sumharga;
    $inp['totalModal']=$summodal;
    $ord->update($inp);


    return redirect()->route('pesanan.index')->with('message', 'Status Pesanan telah berubah');
    
}
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    
public function editorderdetail($id)
{
    $orderdetails = Orderdetail::where('idOrder', '=', $id)->orderBy('id', 'ASC') -> get();

    // dd($orderdetails);
    return view('admin.orderdetail', compact('orderdetails'));
}

}
