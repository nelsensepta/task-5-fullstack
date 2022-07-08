@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                  <div class="container">
                    <div class="row my-3">
                      <div class="col-md-8">
                          <a href="/home/articles" class="btn btn-success"><span data-feather="arrow-left"></span> Back to All My Article</a>
                          <a href="/home/articles/{{$article->id}}/edit" class="btn btn-warning"><span data-feather="edit"></span> Update</a>
                          <form action="/home/articles/{{$article->id}}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf 
                            <button  class="btn btn-danger" onclick="return confirm('Are You Sure ?')">
                              <span data-feather="x-circle"></span>
                              Delete
                            </button>
                          </form>
                          {{-- <a href="/posts" class="btn btn-danger"><span data-feather="x-circle"></span> Delete</a> --}}
                            <h2 class="my-3">{{ $article->title }}</h2>
                            <p>By.  <a href="/home/article?user={{$article->user->name}}" class="text-decoration-none">{{ $article->user->name }}</a> in <a href="/home/articles?category={{$article->category->id}}">{{ $article->category->name }}</a></p>
                            @if($article->image)
                            <div style="max-height: 350px, overflow:hidden">
                              <img src={{$article->image}} class="img-fluid" alt="{{$article->category->name}}"/>
                              {{-- <img src={{$article->image}} class="img-fluid" alt="{{$article->category->name}}"/> --}}
                            </div>
                            @else
                               <img src="https://source.unsplash.com/1200x500/?{{$article->category->name}}" class="img-fluid" alt="{{$article->category->name}}"/>
                            @endif
{{--                   
                            <article class="my-3 fs-4">
                                {!! $article->content !!} 
                            </article> --}}
                            {{-- isi body bisa berisi tag html --}}
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
