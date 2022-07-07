<?php

namespace Modules\V1\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\V1\Transformers\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categories = Category::latest()->paginate(5);
        // return response(["status" => 200, "message" => "Hello World"]);
        return new CategoryResource(true, "List Data Category", $categories);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('v1::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|max:100",

        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/posts', $image->hashName());

        //create post
        $category = Category::create([
            'name' => $request->name,
            "user_id" => 1,
        ]);

        //return response
        return new CategoryResource(true, 'Category Berhasil Ditambahkan!', $category);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Category $category)
    {
        return new CategoryResource(true, 'Data Category Ditemukan!', $category);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('v1::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Category $category)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            "name" => "required|max:100",
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // //check if image is not empty
        // if ($request->hasFile('image')) {

        //     //upload image
        //     $image = $request->file('image');
        //     $image->storeAs('public/categories', $image->hashName());

        //     //delete old image
        //     Storage::delete('public/categorys/' . $category->image);

        //     //update category with new image
        //     $category->update([
        //         'image' => $image->hashName(),
        //         'title' => $request->title,
        //         'content' => $request->content,
        //     ]);

        // } else {

        //     //update post without image
        //     $post->update([
        //         'title' => $request->title,
        //         'content' => $request->content,
        //     ]);
        // }

        $category->update([
            'name' => $request->name,
        ]);

        //return response
        return new CategoryResource(true, 'Data Category Berhasil Diubah!', $category);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Category $category)
    {
        //delete image
        // Storage::delete('public/posts/' . $post->image);

        //delete post
        $category->delete();

        //return response
        return new CategoryResource(true, 'Category Berhasil Dihapus!', null);
    }
}