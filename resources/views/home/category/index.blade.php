


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">  
                  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
                    <h1 class="h2">My Category</h1>
                  </div> 
                 </div>
                 <div class="card-body">
                  <a href="/home/categories/create" class="btn btn-primary mb-3">Create New Category</a>
                  @if ($categories->count())
                  @if (session()->has('success'))
                    <div class="alert alert-success col-lg-12">{{session('success')}}</div>
                  @endif
                  <div class="table-responsive">
                    <table class="table table-striped align-middle">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          {{-- <th scope="col">Category</th> --}}
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $category )
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $category->name }}</td>
                          {{-- <td>{{ $article->category->name }}</td> --}}
                          <td>
                            <a href="/home/categories/{{$category->id}}"  class="badge bg-info mb-1" ><i class="bi bi-eye-fill" style="font-size: 20px;"></i></a>
                            <a href="/home/categories/{{$category->id}}/edit"  class="badge bg-warning mb-1" ><i class="bi bi-pencil" style="font-size: 20px;"></i></a>
                            <form action="/home/categories/{{$category->id}}" method="POST" class="d-inline">
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
                  @else
                  <p class="text-center fs-4">No Category Found
                  </p>
                  @endif
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
