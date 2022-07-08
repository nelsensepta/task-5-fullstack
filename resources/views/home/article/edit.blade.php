@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">  
                  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <h1 class="h2">Edit Article</h1>
                  </div>
                </div>
                <div class="card-body">
                  <div class="col-lg-12">
                    <form method="POST" action="/home/article/{{$article->id}}" class="mb-5" enctype="multipart/form-data">
                      @method('put')
                      @csrf
                      <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{old('title', $article->title)}}">
                        @error('title')
                          <div class="invalid-feedback">
                            {{$message}}
                          </div>
                        @enderror
                       
                      </div>
                     
                      <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" name="category_id">
                          @foreach ($categories as $category )
                            @if (old('category_id', $article->category_id) == $category->id)    
                              <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                  
                      <div class="mb-3">
                        <label for="image" class="form-label">Article Image</label>
                        <input type="hidden" name="oldImage" value="{{ $article->image }}">
                        @if ($article->image)
                          <img src={{ $article->image }} class="img-fluid img-preview mb-3 col-sm-8 d-block" alt="">
                        @else
                          <img class="img-fluid img-preview mb-3 col-sm-8" alt="">
                        @endif
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                      </div>   
                      <div class="mb-3">
                         <label for="body" class="form-label">Body</label>
                          @error('body')   
                            <p class="text-danger">{{$message}}</p>
                          @enderror
                          <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            {{-- <x-forms.tinymce-editor/> --}}
                            <textarea id="content" type="text" name="content" class="form-control">{{old('content', $article->content)}}</textarea>
                            {{-- <trix-editor input="body"></trix-editor> --}}
                            @error('contents')   
                              <p class="text-danger">{{$message}}</p>
                            @enderror
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Edit Article</button>
                    </form>
                  </div>    
                  
              
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  tinymce.init({
            height: 600,
            selector: 'textarea', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: "advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount emoticons",
            toolbar:"undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help",
            
          });


  // img Preview
  function previewImage (){
  const image = document.getElementById("image");
  const imgPreview = document.querySelector(".img-preview");

  imgPreview.style.display = "block";
  const oFReader = new FileReader();
  oFReader.readAsDataURL(image.files[0]);

  oFReader.onload = function(OFREvent){
    imgPreview.src = OFREvent.target.result;
  }
  }
</script>  
@endsection
