<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\UrlTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    use UrlTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
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
            'name' => 'required',
            'popular' => 'required'
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $category = Category::create([
            'image' => $imageName,
            'name' => $request->name,
            'slug' => self::UrlNormal($request->name),
            'description' => $request->description,
            'popular' => $request->popular
        ]);

        $request->image->move(public_path('storage/imgs/categories/'.$category->id), $imageName);

        $categories = Category::paginate(10);
        return to_route('categories.index', [
            'success' => 'Add Category successful!',
            'page' => $categories->lastPage()
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
        $category = Category::findOrFail($id);
        if (!isset($category)) {
            abort(404);
        }
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
            'name' => 'required',
            'popular' => 'required'
        ]);

        $category = Category::findOrFail($id);
        if (!isset($category)) {
            abort(404);
        }        
        $category->update([            
            'name' => $request->name,
            'slug' => self::UrlNormal($request->name),
            'description' => $request->description,
            'popular' => $request->popular
        ]);

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
            'success' => 'Update Category successful!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        if (!isset($category)) {
            abort(404);
        }
        $category->delete();
        return to_route('categories.index', [
            'page' => $request->page,
            'success' => 'Delete Successful'
        ]);
    }
}
