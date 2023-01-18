@extends('Admin.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Post List</h3>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
        <div class="container-fluid">
          <!-- /.row -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#createPostDialog">Add New Post</button>
                    </h3>
                    <form action="{{route('post#postListPage')}}" method="get" class="card-tools">
                        <div class="input-group input-group-sm" style="width: 160px;">
                        <input type="text" name="SearchKey" class="form-control float-right" placeholder="Search" value="{{request('SearchKey')}}">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                            </button>
                        </div>
                        </div>
                    </form>
                </div>

                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Created Date</th>
                        <th>
                            <span class="text-primary">Total Post - {{$posts->total()}}</span>
                        </th>
                      </tr>
                    </thead>
                    @foreach($posts as $post)
                        <tbody>
                            <tr>
                                <td class="align-middle">{{$post->id}}</td>
                                <td class="align-middle">
                                    <img src="{{asset('postImage/' . $post->image)}}" style="width: 80px" height="80px" class="img-thumbnail">
                                </td>
                                <td class="align-middle">{{$post->title}}</td>
                                <td class="align-middle">{{$post->categoryTitle}}</td>
                                <td class="align-middle">
                                    <div id="tableDescription">
                                        {{$post->description}}
                                    </div>
                                </td>
                                <td class="align-middle">{{$post->created_at->format('d - M - Y')}}</td>
                                <td class="align-middle">
                                    <a href="{{route('post#postUpdatePage',$post->id)}}" class="btn btn-sm bg-dark text-white mx-3">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="{{route('post#postDelete',$post->id)}}" class="btn btn-sm bg-danger text-white">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                  </table>
                  @if ($posts->total() == 0)
                    <div class="pt-5 pb-4 text-center">
                        <p class="text-danger">There is no one post!</p>
                    </div>
                  @endif
                </div>
                <div class="px-4 pt-2">
                    {{$posts->links()}}
                </div>
              </div>
            </div>
          </div>
        </div>

        <!--Start Create Dialog -->
        <div class="modal fade" id="createPostDialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="{{route('post#postCreate')}}" method="post" class="modal-dialog" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Create New Post</h3>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="col-form-label mb-1">Image</label>
                        <br>
                        <input type="file" name="postImage">
                        @error('postImage')
                            <p class="text-danger mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Title</label>
                        <input type="text" class="form-control" name="postTitle">
                        @error('postTitle')
                            <p class="text-danger mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Description</label>
                        <textarea name="postDescription" class="form-control" cols="30" rows="3"></textarea>
                        @error('postDescription')
                            <p class="text-danger mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Category</label>
                        <select name="postCategory" class="form-control">
                            <option value="">Choose category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">
                                    {{$category->title}}
                                </option>
                            @endforeach
                        </select>
                        @error('postCategory')
                            <p class="text-danger mt-1">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark" id="CreateBtn">Create</button>
                </div>
                </div>
            </form>
            </div>
            <!--End Create Dialog -->

      </section>
  </div>
  @endsection
