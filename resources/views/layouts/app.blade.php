<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'E-Complaint') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('dist/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('dist/jquery/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('dist/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rubik:wght@300&display=swap" rel="stylesheet">

    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/13427233db.js" crossorigin="anonymous"></script>
</head>
<body class="login_page_bng ">
    @if (Auth::check())
        <div class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
            <div class="container d-flex justify-content-between">
                <span style="font-size:30px;cursor:pointer; color: white" onclick="openNav()">&#9776; </span>
                <div>
                    <div class="d-flex justify-content-between">
                        <img src="{{ asset(Auth::user()->GetAvatar()) }}" alt="" width="40px" height="40px" class="rounded-circle">
                        &nbsp;&nbsp;&nbsp;
                        <h4 class="m-auto text-white">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</h4>
                        &nbsp;&nbsp;&nbsp;
                        <form action="{{ route('logout') }}" method="POST" class="">
                            @csrf
                            <button type="submit" width="45px" height="45px" class="btn btn-danger text-white">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

            <a href="{{ route('home') }}" class="text-decoration-none px-2"><h2 class="text-white text-center">NEUC Complaint System</h2></a>

            <div class="d-flex justify-content-center my-3">
                <div style="width:200px;
                    height:200px;
                    background-image:url('{{ asset(Auth::user()->GetAvatar()) }}');
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-position: center;"
                    class="rounded-circle border border-primary"></div>
            </div>

            <div class="text-center">
                <h4 class="text-white">Name: {{ Auth::user()->first_name.' '.Auth::user()->last_name }}</h4>

                @if (Auth::user()->HasRole())
                    <div class="list-group">
                        @if (Auth::user()->IsHelpDesk())
                            <a data-bs-toggle="collapse" href="#collapseHelpdesk" role="button" aria-expanded="false" aria-controls="collapseHelpdesk" class="list-group-item list-group-item-action h5 @if(Request::is('help-desk/*')) active @endif;">Help Desk</a>
                            <div id="collapseHelpdesk" class="collapse">
                                <a href="{{ route('helpdesk.dashboard') }}">Dashboard</a>
                                <a href="{{ route('helpdesk.complaints.index') }}">All Complaints</a>
                                <a href="{{ route('helpdesk.verified_complaints.index') }}">Ongoing Complaints</a>
                            </div>
                        @endif
                        @if (Auth::user()->IsExecutive())
                            <a href="{{ route('executive.dashboard') }}" class="list-group-item list-group-item-action h5 @if(Request::is('executive/*')) active @endif">Executive</a>
                        @endif
                        @if (Auth::user()->IsAdmin())
                            <a data-bs-toggle="collapse" href="#collapseAdmin" role="button" aria-expanded="false" aria-controls="collapseAdmin" class="list-group-item list-group-item-action h5 @if(Request::is('administrator/*')) active @endif">Administrator</a>
                        @endif
                    </div>
                @endif
            </div>

            @if (Auth::user()->HasRole())
                @if (Auth::user()->IsAdmin())
                    <div id="collapseAdmin" class="collapse">
                        <a href="{{ route('users.index') }}">User Profile List</a>
                        <a href="{{ route('departments.index') }}">Department List</a>
                    </div>
                @endif
            @endif
        </div>
    @endif

    <div id="main" class="py-4">
        @yield('content')
    </div>

    @if (Auth::check())
        <div>
            @include('layouts.footer')
        </div>
    @endif
</body>

</html>
