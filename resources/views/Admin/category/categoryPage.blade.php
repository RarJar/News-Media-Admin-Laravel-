@extends('Admin.master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h3>Category List</h3>
            </div>
          </div>
        </div>
      </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#createCategory">Add New Category</button>
                            </h3>
                            <div class="card-tools">
                                <form action="{{route('category#categoryPage')}}" method="get" class="input-group input-group-sm" style="width: 150px;">
                                    @csrf
                                    <input type="text" name="SearchKey" class="form-control float-right" placeholder="Search" value="{{request('SearchKey')}}">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Created Date</th>
                                        <th>
                                            <span class="text-primary">Total Category - {{$categories->total()}}</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{$category->id}}</td>
                                            <td>{{$category->title}}</td>
                                            <td>{{$category->created_at->format('d - M - Y')}}</td>
                                            <td>
                                                <a href="{{route('category#updateCategoryPage',$category->id)}}" class="btn btn-sm bg-dark text-white mx-3">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <a href="{{route('category#deleteCategory',$category->id)}}" class="btn btn-sm bg-danger text-white">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($categories->total() == 0)
                                <div class="pt-5 pb-4 text-center">
                                    <p class="text-danger">There is no one category!</p>
                                </div>
                            @endif
                        </div>
                        <div class="px-4 pt-2">
                            {{$categories->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Start Create Dialog -->
        <div class="modal fade" id="createCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{route('category#createCategory')}}" method="post" class="modal-dialog">
            @csrf
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Create New Category</h3>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="col-form-label">Title</label>
                    <input type="text" class="form-control" name="categoryTitle">
                    @error('categoryTitle')
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
    <!-- /.content -->
</div>
@endsection
