


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">  
                  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
                    <h1 class="h2">My Posts </h1>
                  </div> 
                 </div>
                <div class="card-body">

                   
                  
                  @if (session()->has('success'))
                    <div class="alert alert-success  col-lg-8">{{session('success')}}</div>
                  @endif
                  <div class="table-responsive">
                    <a href="/home/articles/create" class="btn btn-primary mb-3">Create New Post</a>
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Title</th>
                          <th scope="col">Category</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($articles as $article )
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $article->title }}</td>
                          <td>{{ $article->category->name }}</td>
                          <td>
                            <a href="/home/articles/{{$article->id}}"  class="badge bg-info mb-1" ><i class="bi bi-eye-fill"></i></a>
                            <a href="/home/articles/{{$article->id}}/edit"  class="badge bg-warning mb-1" ><i class="bi bi-pencil"></i></a>
                  
                            <form action="/dashboard/articles/{{$article->id}}" method="POST" class="d-inline">
                              @method('delete')
                              @csrf
                              <button class="badge bg-danger border-0" onclick="return confirm('Are You Sure ?')">
                                <i class="bi bi-trash"></i>
                              </button>
                            </form>
                            {{-- <a href="/dashboard/posts/{{$post->slug}}"  class="badge bg-danger" ><span data-feather="x-circle"></span></a> --}}
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
