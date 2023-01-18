@extends('Admin.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Change your password</h3>
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
                  <form action="{{route('profile#changePassword')}}" method="post">
                    @csrf
                    <div class="card-body">

                      <div class="form-group">
                        <label>Old password</label>
                        <input type="password" class="form-control" name="oldPassword" placeholder="Enter old password">
                        @error('oldPassword')
                            <p class="text-danger mt-1">{{$message}}</p>
                        @enderror

                        @if (Session('message'))
                            <p class="text-danger mt-1">{{ Session('message') }}</p>
                        @endif

                      </div>

                      <div class="form-group">
                        <label>New password</label>
                        <input type="password" class="form-control" name="newPassword" placeholder="Enter new password">
                        @error('newPassword')
                            <p class="text-danger mt-1">{{$message}}</p>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label>Confirm password</label>
                        <input type="password" class="form-control" name="confirmPassword" placeholder="Enter comfirm password">
                        @error('confirmPassword')
                            <p class="text-danger mt-1">{{$message}}</p>
                        @enderror
                      </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="bg-light d-flex justify-content-end px-4 py-2">
                        <button type="submit" class="btn btn-dark">Save and Change</button>
                    </div>

                  </form>
              </div>
          </div>
    </section>
    <!-- /.content -->
  </div>
  @endsection
