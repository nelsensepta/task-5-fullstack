@extends('layouts.app')

@section('content')
<div class="container">
    @if ($articles->count())
    <div class="row justify-content-center">
        @foreach ($articles as $article )
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="position-absolute px-2 py-2 bg-dark text-white"><a href="/home?category={{$article->category->id}}" class="text-white text-decoration-none">{{$article->category->name}}</a></div>
                @if($article->image)           
                    <img src={{$article->image}} class="img-fluid img-thumbnail" alt="{{$article->category->name}}"/>
                @else
                    <img src="https://source.unsplash.com/500x250/?{{$article->category->name}}" class="card-img-top" alt="{{$article->category->name}}">
                @endif 
                <div class="card-body">
                  <h5 class="card-title">{{ $article->title }}</h5>
                  <p>
                    <small class="text-muted">
                       By {{ $article->user->name }}
                        {{$article->created_at->diffForHumans()}}
                    </small>  
                 </p>
                  {{-- <p class="card-text">  {!! $article->excerpt !!}</p> --}}
                  <a href={{url("/home/articles/$article->id")}} class="btn btn-primary">Read More</a>
                </div>        
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p class="text-center fs-4 mt-5">No Article Found
    </p>  
    @endif
</div>
@endsection
