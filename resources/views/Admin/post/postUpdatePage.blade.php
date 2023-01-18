@extends('Admin.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Update Post</h3>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="col-md-12 container d-flex justify-content-center">
            <!-- left column -->
            <div class="col-md-7">
              <div class="card card-primary">
                  <!-- form start -->
                  <form action="{{route('post#postUpdate')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">

                        <div class="form-group">
                            <img src="{{asset('postImage/' . $data->image)}}" class="mb-2 img-thumbnail" style="width: 150px">
                            <br>
                            <input type="file" name="postImage">
                            @error('postImage')
                                <p class="text-danger mt-1">{{$message}}</p>
                            @enderror
                        </div>

                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="postTitle" value="{{$data->title}}">
                        @error('postTitle')
                            <p class="text-danger mt-1">{{$message}}</p>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label>Description</label>
                        <textarea name="postDescription" class="form-control" cols="30" rows="3">{{$data->description}}</textarea>
                        @error('postDescription')
                            <p class="text-danger mt-1">{{$message}}</p>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label>Category</label>
                        <select name="postCategory" class="form-control">
                            <option value="">Choose category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" @if ($category->id == $data->categoryId) selected @endif>
                                    {{$category->title}}
                                </option>
                            @endforeach
                        </select>
                        @error('postCategory')
                            <p class="text-danger mt-1">{{$message}}</p>
                        @enderror
                      </div>

                    </div>

                    <!-- Get Hidden Category Id -->
                    <input type="hidden" name="postId" value="{{$data->id}}">

                    <div class="bg-light d-flex justify-content-end px-4 py-2">
                        <button type="submit" class="btn btn-dark">Save</button>
                    </div>

                  </form>
              </div>
          </div>
    </section>
    <!-- /.content -->
  </div>
  @endsection
