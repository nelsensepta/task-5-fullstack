


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
                    <div class="alert alert-success  col-lg-12">{{session('success')}}</div>
                  @endif
                  <div class="table-responsive">
                    <a href="/home/articles/create" class="btn btn-primary mb-3">Create New Article</a>
                    <table class="table table-striped align-middle">
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
                         @if ($article->category)
                          <td>{{ $article->category->name }}</td>
                         @else
                          <td>Belum ada kategori</td>
                         @endif
                          <td>
                            <a href="/home/articles/{{$article->id}}"  class="badge bg-info mb-1" ><i class="bi bi-eye-fill" style="font-size: 20px;"></i></a>
                            <a href="/home/articles/{{$article->id}}/edit"  class="badge bg-warning mb-1" ><i class="bi bi-pencil" style="font-size: 20px;"></i></a>
                  
                            <form action="/home/articles/{{$article->id}}" method="POST" class="d-inline">
                              @method('delete')
                              @csrf
                              <button class="badge bg-danger border-0" onclick="return confirm('Are You Sure ?')">
                                <i class="bi bi-trash" style="font-size: 20px;"></i>
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
