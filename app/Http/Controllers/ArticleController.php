<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.article.index', [
            "articles" => Article::where("user_id", auth()->user()->id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("home.article.create", [
            "categories" => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            "title" => "required|max:100",
            "content" => "required",
            "category_id" => "required",
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);

        $image = $request->file('image');
        $image->storeAs('public/article', $image->hashName());

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['image'] = url("storage/article/" . $image->hashName());

        Article::create($validatedData);
        return redirect('home/articles')->with('success', 'New Articles has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        // dd($article);

        return view("home.article.show", [
            "article" => $article,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view("home.article.edit", [
            'article' => $article,
            "categories" => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $last = preg_replace('~.*/~', '', $article->image);

        $validatedData = $request->validate([
            "title" => "required|max:100",
            "content" => "required",
            "category_id" => "required",
            "image" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);
        // $validatedData['user_id'] = auth()->user()->id;

        if ($request->hasFile('image')) {
            //upload image
            $image = $request->file('image');
            $image->storeAs('public/article', $image->hashName());

            //delete old image
            Storage::delete("public/article/" . $last);

            //update ar$article with new image
            $validatedData['image'] = url("storage/article/" . $image->hashName());
            $article->update($validatedData);

        } else {
            //update post without image
            $article->update(
                $validatedData,
            );

        }
        return redirect('home/articles')->with('success', 'Article has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $last = preg_replace('~.*/~', '', $article->image);
        if ($article->image) {
            Storage::delete("public/article/" . $last);
        }
        Article::destroy($article->id);
        return redirect('home/articles')->with('success', 'Article has been deleted');
    }
}