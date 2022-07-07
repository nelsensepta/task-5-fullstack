<?php

namespace Modules\V1\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\V1\Transformers\ResponseResource;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $articles = Article::latest()->paginate(5);
        return new ResponseResource(true, "List Data Article", $articles);
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
            "title" => "required|max:100",
            "content" => "required",
            "category_id" => "required",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //upload image
        $image = $request->file('image');
        $image->storeAs('public/article', $image->hashName());
        //create post
        $category = Article::create([
            'title' => $request->title,
            "content" => $request->content,
            "category_id" => $request->category_id,
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
        $article = Article::find($id);
        if (is_null($article)) {
            $response = [
                'success' => false,
                'message' => "Article tidak di temukan",
            ];
            return response()->json($response);
        }
        // Model::whereNotNull('sent_at')->get();
        return new ResponseResource(true, 'Data Article Ditemukan!', $article);
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
        $article = Article::find($id);
        if (is_null($article)) {
            $response = [
                'success' => false,
                'message' => "Article tidak di temukan",
            ];
            return response()->json($response);
        }

        //define validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //check if image is not empty
        if ($request->hasFile('image')) {
            //upload image
            $image = $request->file('image');
            $image->storeAs('public/article', $image->hashName());

            //delete old image
            Storage::delete('public/posts/' . $article->image);

            //update ar$article with new image
            $article->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'content' => $request->content,
            ]);

        } else {
            //update post without image
            $article->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);
        }

        //return response
        return new ResponseResource(true, 'Data Post Berhasil Diubah!', $article);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if (is_null($article)) {
            $response = [
                'success' => false,
                'message' => "Article tidak di temukan",
            ];
            return response()->json($response);
        }

        //delete image
        Storage::delete('public/article/' . $article->image);

        //delete arti$article
        $article->delete();

        //return response
        return new ResponseResource(true, 'Data Post Berhasil Dihapus!', null);

    }
}