<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Traits\UrlTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    use UrlTrait;

    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryRepository->paginate();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|unique:categories,name',
            'popular' => 'required'
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $category = $this->categoryRepository->create([
            'image' => $imageName,
            'name' => $request->name,
            'slug' => self::UrlNormal($request->name),
            'description' => $request->description,
            'popular' => $request->popular
        ]);

        $request->image->move(public_path('storage/imgs/categories/'.$category->id), $imageName);

        $categories = $this->categoryRepository->paginate();
        return to_route('categories.index', [
            'page' => $categories->lastPage()
        ])->with('success', 'Add Category successful!');
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
        $category = $this->categoryRepository->find($id);
        return view('categories.edit', ['category' => $category]);
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
            'name' => 'required|unique:categories,name',
            'popular' => 'required'
        ]);

        $category = $this->categoryRepository->update([
            'name' => $request->name,
            'slug' => self::UrlNormal($request->name),
            'description' => $request->description,
            'popular' => $request->popular
        ], $id);

        if (gettype($request->image) === 'object') {
            $imageName = time() . '.' . $request->image->extension();
            $imageOldPath = public_path('storage/imgs/categories/'.$category->id.'/'.$category->image);
            if (File::exists($imageOldPath)) {
                File::delete($imageOldPath);
            }
            $category->update([
                'image' => $imageName
            ]);

            $request->image->move(public_path('storage/imgs/categories/'.$category->id), $imageName);
        }


        return to_route('categories.edit', [
            'category' => $id,
        ])->with('success', 'Update Category successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $category = $this->categoryRepository->find($id);

        if($category->products->count() > 0) {
            return to_route('categories.index', [
                'page' => $request->page,
            ])->with('error', 'Delete Failed. ' . $category->name .' has products');
        }

        $this->categoryRepository->delete($id);
        return to_route('categories.index', [
            'page' => $request->page,
        ])->with('success', 'Delete Successful');
    }
}
