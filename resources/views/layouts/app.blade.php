<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SMS') }}</title>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('css/toastr.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/admin-dashboard/adminlte.css') }}" rel="stylesheet">
    <!-- CSS only -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css" rel="stylesheet">
    <style>
            @font-face {
                font-family: "myFont";
                src: url("/fonts/OpenSans-Regular.ttf");
            }
            body{
                font-family: myFont;	
                /* background: #e9e8e8; */
            }
            .table thead tr th{
                font-size: 12px;
            }

            .table tbody tr td{
                font-size: 11px;
            }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div id="app">
        @guest
        @else
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-sign-out"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                <img src="{{ asset('icon/user.png')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        {{ Auth::user()->fname }} {{ Auth::user()->lname }}
                                    </h3>
                                    <p class="text-sm text-secondary">ID # : {{ Auth::user()->empno }}</p>
                                </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-divider"></div>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="font-size: 10px; font-weight: bold;">
                            {{ __('LOGOUT') }}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        </div>
                    </li>
                </ul>

            </nav>

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-light-primary elevation-1">
                <!-- Brand Logo -->
                <a href="#" class="brand-link text-sm">
                <img src="{{ asset('/icon/sms.png') }}" alt="IDSI Logo" class="brand-image img-circle elevation-1" style="opacity: .8">
                <span class="brand-text font-weight-light">SMS Management System</span>
                </a>

                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{ asset('/icon/user.png') }}" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <small>{{ Auth::user()->lname }}, {{ Auth::user()->fname }}</small>
                        </div>
                    </div>

                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                            @if(Auth::user()->level == 0)
                                <li class="nav-item">
                                    <a href="{{ route('sms-dashboard') }}" class="nav-link {{ Request::segment(1) === 'sms' ? 'active' : null }}">
                                        <i class="nav-icon fa fa-comment"></i>    
                                        <p>{{ __('SMS Dashboard') }}</p>
                                    </a>
                                </li>
                            @elseif(Auth::user()->level == 5 || Auth::user()->level == 6)
                                <li class="nav-item">
                                    <a href="{{ route('sms-dashboard') }}" class="nav-link {{ Request::segment(1) === 'sms' ? 'active' : null }}">
                                        <i class="nav-icon fa fa-comment"></i>    
                                        <p>{{ __('SMS Dashboard') }}</p>
                                    </a>
                                </li>
                                <li class="na-item">
                                    <a href="{{ route('task_completed') }}" class="nav-link {{ Request::segment(1) === 'completed' ? 'active' : null }}">
                                        <i class="nav-icon fa fa-comment"></i>    
                                        <p>{{ __('Completed Task') }}</p>
                                    </a>
                                </li>
                            @elseif(Auth::user()->level == 9)
                                <li class="nav-item">
                                    <a href="{{ route('sms-dashboard') }}" class="nav-link {{ Request::segment(1) === 'sms' ? 'active' : null }}">
                                        <i class="nav-icon fa fa-comment"></i>    
                                        <p>{{ __('SMS Dashboard') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('task_completed') }}" class="nav-link {{ Request::segment(1) === 'completed' ? 'active' : null }}">
                                        <i class="nav-icon fa fa-check-circle"></i>    
                                        <p>{{ __('Completed Task') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('other-sms') }}" class="nav-link {{ Request::segment(1) === 'other' ? 'active' : null }}">
                                        <i class="nav-icon fa fa-ellipsis-v"></i>    
                                        <p>{{ __('Other Messages') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('failed-sms') }}" class="nav-link {{ Request::segment(1) === 'failed' ? 'active' : null }}">
                                        <i class="nav-icon fa fa-times-circle"></i>    
                                        <p>{{ __('Failed Messages') }}</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>

                </div>

            </aside>

            <div class="content-wrapper">
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <main class="py-4">
                                @yield('content')
                            </main>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        @endguest
    </div>
</body>

<!-- JS, Popper.js, and jQuery -->
<script src="{{ asset('js/admin-dashboard/admin-lte/adminlte.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mouse0270-bootstrap-notify/3.1.7/bootstrap-notify.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> -->
<script type="text/javascript">

    @include('toastr.error')

</script>
</html>
