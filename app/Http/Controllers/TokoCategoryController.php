<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Toko;
use App\Category;

class TokoCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $tokos = Toko::orderBy('id', 'ASC')->get(); 
       $cat = Category::orderBy('id', 'ASC')->get(); 
    //    $tokos = DB::table('toko')->get();

       return view('admin.tokocategory.tokocategory', compact('tokos','cat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tokocategory.createtoko');
    }

    public function create2()
    {
        return view('admin.tokocategory.z');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->nameStore) {
        $toko = Toko::create($request->all());
        return redirect()->route('tokokategori.index');
        
    }
    
        elseif($request->nameCategory) {
        $toko = Category::create($request->all());
        return redirect()->route('tokokategori.index');
        // return redirect()->route('tokokategori.index')->with('message', 'Toko Berhasil Ditambahkan');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toko = Toko::findOrFail($id);
        return view('admin.tokocategory.edittoko', compact('toko'));
    }
    public function editcategory($id)
    {
        $cat = Category::findOrFail($id);
        return view('admin.tokocategory.editcategory', compact('cat'));
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
        if ($request->nameStore) {
            $toko = Toko::findOrFail($id)->update($request->all());
            return redirect()->route('tokokategori.index');
        }
        
            elseif($request->nameCategory) {
            $cat = Category::findOrFail($id)->update($request->all());

            return redirect()->route('tokokategori.index');
        }
        
        
        return redirect()->route('tokokategori.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroytoko($id)
    {
        $toko = Toko::find($id);
        $toko->delete();
        return redirect()->route('tokokategori.index');
    }

    public function destroycategory($id)
    {
        $cat = Category::findOrFail($id)->delete();
        return redirect()->route('tokokategori.index');
    }
}
