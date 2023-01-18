<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Media Admin Dashboard</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('Admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/dist/css/adminlte.css')}}">

    {{-- Fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <div class="d-flex align-items-center py-2">
                <img src="{{asset('Admin/dist/img/logo0.jpg')}}" class="rounded-pill mx-2" style="width: 47px">
                <h4 class="text-light">Admin Dashboard</h4>
            </div>
            <div class="bg-light" style="height: 0.5px"></div>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header">Account</li>
                        <li class="nav-item">
                            <a href="{{route('profile#profilePage')}}" class="nav-link">
                                <i class="fas fa-user-circle"></i>
                                <p>My profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('profile#adminListPage')}}" class="nav-link">
                                <i class="fa-solid fa-users"></i>
                                <p>Admin List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('profile#userListPage')}}" class="nav-link">
                                <i class="fa-solid fa-users"></i>
                                <p>User List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('profile#changePasswordPage')}}" class="nav-link">
                                <i class="fa-solid fa-key"></i>
                                <p>Change password</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#deleteDialog">
                                <i class="fa-solid fa-trash"></i>
                                <p>Delete account</p>
                            </a>
                        </li>
                        <li class="nav-header">Category</li>
                        <li class="nav-item">
                            <a href="{{route('category#categoryPage')}}" class="nav-link">
                                <i class="fa-solid fa-list"></i>
                                <p>Category List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('post#postListPage')}}" class="nav-link">
                                <i class="fa-solid fa-radio"></i>
                                <p>Posts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('post#trendPostPage')}}" class="nav-link">
                                <i class="fa-solid fa-arrow-trend-up"></i>
                                <p>Trend Post</p>
                            </a>
                        </li>

                        <li class="nav-header">Other</li>
                        <li class="nav-item">
                            <a href="{{route('other#userFeedbackPage')}}" class="nav-link">
                                <i class="fa-solid fa-message"></i>
                                <p>User Feedback</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{route('logout')}}" method="POST" class="nav-link bg-danger d-flex flex-row align-items-center">
                                @csrf
                                <i class="fa-solid fa-power-off"></i>
                                <p><button type="submit" class="btn btn-danger">Logout</button></p>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

          <!-- Modal -->
        <div class="modal fade" id="deleteDialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title text-danger" id="exampleModalLabel">Delete your account?</h3>
                </div>
                <div class="modal-body">
                    Are you sure delete your account?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                <a type="button" href="{{route('profile#deleteAccount')}}" class="btn btn-danger">OK</a>
                </div>
            </div>
            </div>
        </div>

        @yield('content')

        <footer class="main-footer">
            <strong>Copyright &copy; 2022</strong> All rights reserved &&
            Developed by <a href="#">Rar Zar</a>
          </footer>

    </div>

    <!-- jQuery -->
    <script src="{{asset('Admin/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('Admin/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('Admin/dist/js/demo.js')}}"></script>
    <!-- Bootstrap5 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- jQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield('forAjax')

</body>

</html>
