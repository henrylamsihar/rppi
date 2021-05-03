<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }
    public function dashboard(){
        return view('admin.dashboard');
    }

    // public function product(){
    //     return view('admin.product');
    // }

    public function pesanan(){
        return view('admin.pesanan');
    }

    public function tokorekanan(){
        return view('admin.tokocategory.tokorekanan');
    }

    public function laporan(){
        return view('admin.laporan');
    }
    public function laporan2(){
        return view('admin.laporan2');
    }

    public function mastertest(){
        return view('layouts.mastertest');
    }

    public function product()
    {
    	$product = DB::table('product')->get();
    	return view('admin.product',['product' => $product]);
    }
}
