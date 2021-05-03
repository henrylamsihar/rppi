<?php

namespace App\Http\Controllers;
Use App\Product;
Use App\Toko;
Use App\Category;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Datatables;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $products = Product::orderBy('id', 'ASC') ->paginate(20); 
    //    $products = DB::table('product')->get();
       $toko = Toko::all();
       $category = Category::all();
       return view('admin.product.product', compact('products','toko','category'));
       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('admin.product.createproduct');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $input = $request->all();
        $input['imgProduct'] = null;
        if ($request->hasFile('imgProduct')){
            $input['imgProduct'] = '/upload/photo/'.str_slug($input['nameProduct'], '-').'.'.$request->imgProduct->getClientOriginalExtension();
            $request->imgProduct->move(public_path('/upload/photo/'), $input['imgProduct']);
        }
        Product::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Product Created'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.showproduct', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return $product;
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
       
            // $input = $request->all();
            // $product = Product::find($id);
            
            // $product->update($input);

            // return response()->json([
            //     'success' => true,
            //     'message' => 'Updated'
            // ]);

            $input = $request->all();
            $product = Product::findOrFail($id);
            $input['imgProduct'] = $product->imgProduct;
            if ($request->hasFile('imgProduct')){
                // if (!$product->imgProduct == NULL){
                //     unlink(public_path($product->imgProduct));
                // }
                $input['imgProduct'] = '/upload/photo/'.str_slug($input['nameProduct'], '-').'.'.$request->imgProduct->getClientOriginalExtension();
                $request->imgProduct->move(public_path('/upload/photo/'), $input['imgProduct']);
            }
            $product->update($input);
            return response()->json([
                'success' => true,
                'message' => 'product Updated'
            ]);       
    }
    
    public function updt(Request $request, $id)
    {
        // $this->validate($request, [
        //     'name_product' => 'required',
        //     'price' => 'required'
        // ]);

        // $product = Product::findOrFail($id)->update($request->all());

        // return redirect()->route('product.index')->with('message', 'Produk berhasil diubah!');
            $input = $request->all();
            $product = Product::find($id);
            
            $product->update($input);

            return response()->json([
                'success' => true,
                'message' => 'Updated'
            ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product::findOrFail($id);
        // if (!$product->imgProduct == NULL){
        //     unlink(public_path($product->imgProduct));
        // }
        Product::destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'product Deleted'
        ]);
    }



    public function apiProduct(){
        $product = Product::all();
        return Datatables::of($product)
            ->addColumn('show_photo', function($product){
                if ($product->imgProduct == NULL){
                    return 'No Image';
                }
                return '<img class="rounded-square" width="50" height="50" src="'. url($product->imgProduct) .'" alt="">';
            })
            ->addColumn('action', function($product){
                return 
                    '<a onclick="editForm('. $product->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $product->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->addColumn('nameStore', function($product){
                if ($product->idStore == NULL){
                    return 'No Toko';
                }
                return $product->toko->nameStore;
            })
            ->addColumn('nameCategory', function($product){
                if ($product->idCategory == NULL){
                    return 'No Category';
                }
                return $product->category->nameCategory;
            })->rawColumns(['show_photo', 'action'])->make(true);
    }
    
    // public function toko(){
    //     $toko = Toko::all();
    //     return view('admin.product.product', compact('products'));
    //   }

}