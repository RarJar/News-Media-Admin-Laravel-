@extends('Admin.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>User Feedback</h3>
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
                    <form action="{{route('other#userFeedbackPage')}}" method="get" class="card-tools">
                        <div class="input-group input-group-sm" style="width: 160px;">
                        <input type="text" name="SearchKey" class="form-control float-right" placeholder="Search by name" value="{{request('SearchKey')}}">

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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created Date</th>
                        <th></th>
                        <th>
                            <span class="text-primary">Total Feedback - {{$feedbacks->total()}}</span>
                        </th>
                      </tr>
                    </thead>
                    @foreach($feedbacks as $feedback)
                        <tbody>
                            <tr>
                                <td class="align-middle">{{$feedback->id}}</td>
                                <td class="align-middle">{{$feedback->name}}</td>
                                <td class="align-middle">{{$feedback->email}}</td>
                                <td class="align-middle">{{$feedback->created_at->format('d - M - Y')}}</td>
                                <td class="align-middle">
                                    <a href="#" data-bs-toggle="popover" data-bs-placement="bottom" class="btn btn-sm bg-dark text-white mx-3" data-bs-content="{{$feedback->message}}">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{route('other#feedbackDelete',$feedback->id)}}" class="btn btn-sm bg-danger text-white">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                  </table>
                  @if ($feedbacks->total() == 0)
                    <div class="pt-5 pb-4 text-center">
                        <p class="text-danger">There is no one feedback!</p>
                    </div>
                  @endif
                </div>
                <div class="px-4 pt-2">
                    {{$feedbacks->links()}}
                </div>
              </div>
            </div>
          </div>
        </div>

      </section>
  </div>
  @endsection

  @section('forAjax')
      <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
      </script>
  @endsection
