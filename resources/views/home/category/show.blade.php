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
                          <a href="/home/categories" class="btn btn-success"><span data-feather="arrow-left"></span> Back to All My Category</a>
                          <a href="/home/categories/{{$category->id}}/edit" class="btn btn-warning"><span data-feather="edit"></span> Update</a>
                          <form action="/home/categories/{{$category->id}}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf 
                            <button  class="btn btn-danger" onclick="return confirm('Are You Sure ?')">
                              <span data-feather="x-circle"></span>
                              Delete
                            </button>
                          </form>
                          <h1 class="mt-4">{{$category->name}}</h1>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
