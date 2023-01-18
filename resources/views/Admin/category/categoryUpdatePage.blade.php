@extends('Admin.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Update Category</h3>
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
                  <form action="{{route('category#updateCategory')}}" method="post">
                    @csrf

                    <div class="card-body">
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="categoryTitle" value="{{$categoryTitle->title}}">
                        @error('categoryTitle')
                            <p class="text-danger mt-1">{{$message}}</p>
                        @enderror
                      </div>

                    </div>

                    <!-- Get Hidden Category Id -->
                    <input type="hidden" name="categoryId" value="{{$categoryTitle->id}}">

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
