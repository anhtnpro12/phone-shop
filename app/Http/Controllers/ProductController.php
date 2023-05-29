<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStorePostRequest;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Traits\UrlTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    use UrlTrait;

    private $productRepository;
    private $categoryRepository;

    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepository->paginate();
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create', [
            'categories' => $this->categoryRepository->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStorePostRequest $request)
    {
        $request->validated();

        $imageName = time() . '.' . $request->image->extension();

        $product = $this->productRepository->create([
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

        $products = $this->productRepository->paginate();
        return to_route('products.index', [
            'page' => $products->lastPage()
        ])->with('success', 'Add Product successful!');
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
        $product = $this->productRepository->find($id);
        return view('products.edit', [
            'product' => $product,
            'categories' => $this->categoryRepository->all()
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
            'name' => 'required',
            'original_price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,10})?$/', 'min:0', 'max:999999999'],
            'qty' => 'required|numeric|min:0|max:999999999',
            'trending' => 'required|numeric|min:1'
        ], [
            'original_price.regex' => 'The price field format is invalid. Must be decimal.'
        ]);

        $product = $this->productRepository->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'original_price' => $request->original_price,
            'qty' => $request->qty,
            'status' => $request->status,
            'trending' => $request->trending
        ], $id);

        if (gettype($request->image) === 'object') {
            $imageName = time() . '.' . $request->image->extension();
            $imageOldPath = public_path('storage/imgs/products/'.$product->id.'/'.$product->image);
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

        ])->with('success', 'Update Product successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $product = $this->productRepository->find($id);

        // dd($product->orderItems->count());

        if($product->orderItems->count() > 0) {
            return to_route('products.index', [
                'page' => $request->page,
            ])->with('error', 'Delete Failed. ' . $product->name .' has been ordered');
        }

        $this->productRepository->delete($id);
        return to_route('products.index', [
            'page' => $request->page,
        ])->with('success', 'Delete Successful');
    }
}
