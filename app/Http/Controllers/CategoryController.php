<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Toko;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tokos = Toko::orderBy('id', 'ASC') ->paginate(5); 
        $cat = Category::orderBy('id', 'ASC') ->paginate(5); 
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
        return view('admin.tokocategory.tokocategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat = Category::create($request->all());

        return redirect()->route('admin.tokocategory.tokocategory')->with('message', 'Kategori Berhasil Ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = Category::findOrFail($id);
        return view('admin.tokocategory.showcategory', compact('cat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::findOrFail($id);
        return view('admin.tokocategory.editcategoryditcategory', compact('cat'));
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
        $cat = Cat::findOrFail($id)->update($request->all());

        return redirect()->route('category.index')->with('message', 'Informasi Kategori Berhasil Diubah!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::findOrFail($id)->delete();
        return redirect()->route('admin.tokocategory.tokorekanan')->with('message', 'Kategori berhasil dihapus!');

    }
}
