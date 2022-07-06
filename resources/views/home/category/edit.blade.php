@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">  
                  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <h1 class="h2">Edit Category</h1>
                  </div>
                </div>
                <div class="card-body">
                  <div class="col-lg-12">
                    <form method="POST" action="/home/categories/{{$category->id}}" class="mb-5" enctype="multipart/form-data">
                      @method('put')
                      @csrf
                      <div class="mb-3">
                        <label for="name" class="form-label">name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{old('name', $category->name)}}">
                        @error('name')
                          <div class="invalid-feedback">
                            {{$message}}
                          </div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="article" class="form-label">Articles</label>
                        <select class="form-select" name="id">
                          @foreach ($articles as $article )
                            @if (old('id') == $article->id)    
                              <option value="{{ $article->id }}" selected>{{ $article->title }}</option>
                            @else
                              <option value="{{ $article->id }}">{{ $article->title }}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                      <button type="submit" class="btn btn-primary">Edit Category</button>
                    </form>
                  </div>     
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
