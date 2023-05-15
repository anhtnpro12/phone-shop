<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Traits\UrlTrait;
use File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use UrlTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required',
            'original_price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],   
            'qty' => 'required|numeric|min:1', 
            'trending' => 'required|numeric|min:1'       
        ], [
            'original_price.regex' => 'The price field format is invalid. Must be decimal.'
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName,
            'category_id' => $request->category_id,
            'original_price' => $request->original_price,
            'qty' => $request->qty,
            'status' => $request->status,
            'trending' => $request->trending
        ]);

        $request->image->move(public_path('storage/imgs/products/'.$product->id), $imageName);

        $products = Product::paginate(10);
        return to_route('products.index', [
            'success' => 'Add Product successful!',
            'page' => $products->lastPage()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        if (!isset($product)) {
            abort(404);
        }
        return view('products.edit', [
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {                
        if (gettype($request->image) === 'object' || !isset($request->image)) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
        }
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required',
            'original_price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],   
            'qty' => 'required|numeric|min:1', 
            'trending' => 'required|numeric|min:1'
        ], [
            'original_price.regex' => 'The price field format is invalid. Must be decimal.'
        ]);

        $product = Product::findOrFail($id);
        if (!isset($product)) {
            abort(404);
        }        
        $product->update([            
            'name' => $request->name,
            'description' => $request->description,            
            'category_id' => $request->category_id,
            'original_price' => $request->original_price,
            'qty' => $request->qty,
            'status' => $request->status,
            'trending' => $request->trending
        ]);

        if (gettype($request->image) === 'object') {
            $imageName = time() . '.' . $request->image->extension();            
            $imageOldPath = public_path('storage/imgs/categories/'.$product->id.'/'.$product->image);
            if (File::exists($imageOldPath)) {
                File::delete($imageOldPath);
            }
            $product->update([
                'image' => $imageName
            ]);

            $request->image->move(public_path('storage/imgs/products/'.$product->id), $imageName);
        }


        return to_route('products.edit', [
            'product' => $id,
            'success' => 'Update Category successful!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
