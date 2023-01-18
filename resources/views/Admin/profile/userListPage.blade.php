@extends('Admin.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>User List</h3>
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
                        Total Users - {{$users->total()}}
                    </h3>
                    <form action="{{route('profile#userListPage')}}" method="get" class="card-tools">
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
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Id</th>
                        {{-- <th>Image</th> --}}
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th></th>
                      </tr>
                    </thead>
                    @foreach($users as $user)
                        <tbody>
                            <tr>
                                <td class="align-middle">{{$user->id}}</td>
                                <td class="align-middle">{{$user->name}}</td>
                                <td class="align-middle">{{$user->email}}</td>
                                <td class="align-middle">{{$user->address}}</td>
                                <td class="align-middle">
                                    @if ($user->gender == 'M')
                                        <span>Male</span>
                                    @else
                                        <span>Female</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <a href="{{route('profile#deleteAdmin',$user->id)}}" method="get" class="btn bg-danger text-white">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                  </table>
                  @if ($users->total() == 0)
                    <div class="pt-5 pb-4 text-center">
                        <p class="text-danger">There is no one user!</p>
                    </div>
                  @endif
                </div>
                <div class="px-4 pt-2">
                    {{$users->links()}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  </div>
  @endsection
