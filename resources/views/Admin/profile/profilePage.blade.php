@extends('Admin.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>My Profile</h3>
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
                  <form action="{{route('profile#updateProfile')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-group d-flex flex-column">
                            @if (Auth::user()->image == null)
                                <img src="{{asset('Admin/dist/img/defaultProfile.png')}}" style="width: 150px">
                            @else
                                <img src="{{asset('profileImage/'. Auth::user()->image)}}" class="img-thumbnail" style="width: 150px">
                            @endif

                            <input type="file" name="userImage" class="mt-3">
                            @error('userImage')
                                <p class="text-danger mt-1">{{$message}}</p>
                            @enderror
                        </div>

                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="userName" placeholder="Name" value="{{Auth::user()->name}}">
                        @error('userName')
                            <p class="text-danger mt-1">{{$message}}</p>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" name="userEmail" placeholder="Enter email" value="{{Auth::user()->email}}">
                        @error('userEmail')
                            <p class="text-danger mt-1">{{$message}}</p>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Address</label>
                        <textarea name="userAddress" class="form-control" cols="30" rows="4" placeholder="Address">{{Auth::user()->address}}</textarea>
                        @error('userAddress')
                            <p class="text-danger mt-1">{{$message}}</p>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="M" @if (Auth::user()->gender == 'M') selected @endif>Male</option>
                            <option value="F" @if (Auth::user()->gender == 'F') selected @endif>Female</option>
                        </select>
                      </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="bg-light d-flex justify-content-end px-4 py-2">
                      <button type="submit" class="btn btn-dark">Update profile</button>
                    </div>
                  </form>
              </div>
          </div>
    </section>
    <!-- /.content -->
  </div>
  @endsection
