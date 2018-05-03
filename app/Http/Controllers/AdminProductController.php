<?php

namespace App\Http\Controllers;

use App\Category;
use App\Photo;
use App\Product;
use App\Product_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('name', 'id')->all();
        return view('admin.products.create', compact('category'));
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
        $product = Product::create(['name' => $input['name'], 'price' => $input['price'], 'sale' => $input['sale'], 'description' => $input['description'], 'quantity' => $input['quantity']]);
        Product_detail::create(['product_id' => $product->id, 'issuer' => $input['issuer'], 'publisher' => $input['publisher'], 'author' => $input['author'], 'size' => $input['size'], 'cover' => $input['cover'], 'num_page' => $input['num_page'], 'date_publish' => $input['date_publish'], 'status' => $input['status']]);
        if($file = $request->file('cover_url')){
            $name = $file->getClientOriginalName();
            $file->move('images', $name);
            Photo::create(['photo_url' => $name, 'product_id' => $product->id, 'is_cover' => 1]);
        }
        if($file = $request->file('photo_url')){
            foreach($request->photo_url as $photo){
                $name = $photo->getClientOriginalName();
                $photo->move('images', $name);
                Photo::create(['photo_url' => $name, 'product_id' => $product->id]);
            }
        }
        $product->categories()->attach($input['category_id']);
        return redirect('/admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $product_detail = Product_detail::where('product_id', '=', $id);
        $category = Category::pluck('name', 'id')->all();
        return view('admin.products.edit', compact('product', 'category', 'product_detail'));
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
        $product = Product::findOrFail($id);
        $update_product = $request->only(['name', 'price', 'sale', 'description', 'quantity']);
        $update_product_detail = $request->only(['issuer', 'publisher', 'author', 'size', 'cover', 'num_page', 'date_publish']);
        if($photo = $request->file('cover_url')){
            $name = $photo->getClientOriginalName();
            $photo->move('images', $name);
            foreach($product->photo as $photo){
                if($photo->is_cover == 1){
                    $photo->update(['photo_url' => $name]);
                }
            }
        }
        if($photo = $request->file('photo_url')){
            foreach($product->photo as $photo){
                if($photo->is_cover == 0){
                    $photo->delete();
                }
            }
            foreach($request->photo_url as $photo){
                $name = $photo->getClientOriginalName();
                $photo->move('images', $name);
                Photo::create(['photo_url' => $name, 'product_id' => $product->id]);
            }
        }
        $product->update($update_product);
        $product->product_detail->update($update_product_detail);
        $product->categories()->sync($request->get('category_id'));
        return redirect('/admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        foreach($product->photo as $item){
            $item->delete();
        }
        //$product->photo->delete();
        $product->delete();
        return redirect('/admin/product');
    }
}
