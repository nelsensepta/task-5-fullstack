<?php

namespace Modules\V1\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\V1\Transformers\ResponseResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index()
    {
        // $categories = Category::latest()->paginate(5);
        $categories = Category::where("user_id", auth()->user()->id)->latest()->paginate(1);
        return new ResponseResource(true, "List Data Category", $categories);
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
            "name" => "required|max:100|unique:categories",
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $category = Category::create([
            'name' => $request->name,
            "user_id" => auth()->user()->id,
        ]);
        //return response
        return new ResponseResource(true, 'Category Berhasil Ditambahkan!', $category);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $category = Category::find($id);
        if (is_null($category)) {
            $response = [
                'success' => false,
                'message' => "Category tidak di temukan",
            ];
            return response()->json($response);
        }
        return new ResponseResource(true, 'Data Category Ditemukan!', $category);

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
    public function update(Request $request, $id)
    {
        // //define validation rules
        $category = Category::find($id);
        $validator = Validator::make($request->all(), [
            "name" => "required|max:100|unique:categories",
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (is_null($category)) {
            $response = [
                'success' => false,
                'message' => "Category tidak di temukan",
            ];
            return response()->json($response);
        }

        $category->update(
            [
                "name" => $request->name,
            ]
        );

        return new ResponseResource(true, 'Data Category Berhasil Diubah!', $category);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {

        $category = Category::find($id);
        if (is_null($category)) {
            $response = [
                'success' => false,
                'message' => "Category tidak di temukan",
            ];
            return response()->json($response);
        }

        //delete post
        $category->delete();

        //return response
        return new ResponseResource(true, 'Category Berhasil Dihapus!', null);
    }
}