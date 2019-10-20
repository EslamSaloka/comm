<!DOCTYPE html>
<html lang="en" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
        <title>
            @if(View::hasSection('head.title'))
            @yield('head.title')
            @else
            @yield('title')
            @endif
            | @lang(env('APP_NAME'))
        </title>
        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        {!! AssetsAdmin('icons/icomoon/styles.css') !!}
        {!! AssetsAdmin('bootstrap.css') !!}
        {!! AssetsAdmin('core.css') !!}
        {!! AssetsAdmin('components.css') !!}
        {!! AssetsAdmin('colors.css') !!}
        @stack('styles')
        <style>
            *{
                font-family: 'Cairo', sans-serif;
            }
            .pagination {
                display: inline-block;
            }

            .pagination li {
                color: black;
                float: left;
                padding: 8px 16px;
                text-decoration: none;
            }
        </style>
        <!-- /global stylesheets -->
        <!-- Core JS files -->
        {!! AssetsAdmin('plugins/loaders/pace.min.js','js') !!}
        {!! AssetsAdmin('core/libraries/jquery.min.js','js') !!}
        {!! AssetsAdmin('core/libraries/bootstrap.min.js','js') !!}
        {!! AssetsAdmin('plugins/loaders/blockui.min.js','js') !!}
        {!! AssetsAdmin('core/app.js','js') !!}
        <!-- /core JS files -->
        <script>
            var _token = '<?php echo csrf_token() ?>';
        </script>
        @routes
    </head>
    <body>
        <!-- Main navbar -->
        <div class="navbar navbar-default header-highlight">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('dashboard.Dindex') }}" style="color: #fff;font-size: 30px;">
                    @lang(env('APP_NAME'))
                </a>
                <ul class="nav navbar-nav visible-xs-block">
                    <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                    <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
                </ul>
            </div>
            <div class="navbar-collapse collapse" id="navbar-mobile">
                <ul class="nav navbar-nav">
                    <li><a class="sidebar-control sidebar-main-toggle hidden-xs legitRipple"><i class="icon-paragraph-justify3"></i></a></li>
                </ul>
                <div class="navbar-right">
                    <p class="navbar-text">{{ auth()->user()->name }}</p>
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="{{ url('/') }}">
                                <i class=" icon-home2"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page container -->
        <div class="page-container">
            <!-- Page content -->
            <div class="page-content">
                <!-- Main sidebar -->
                <div class="sidebar sidebar-main">
                    <div class="sidebar-content">
                        <!-- User menu -->
                        <div class="sidebar-user-material">
                            <div class="category-content">
                                <div class="sidebar-user-material-content">
                                    <a href="#"><img src="{{ url('assets/admin/assets/images/placeholder.jpg') }}" class="img-circle img-responsive" alt=""></a>
                                    <h6>{{ auth()->user()->name }}</h6>
                                </div>
                                <div class="sidebar-user-material-menu">
                                    <a href="#user-nav" data-toggle="collapse"><span>@lang('My account')</span> <i class="caret"></i></a>
                                </div>
                            </div>
                            <div class="navigation-wrapper collapse" id="user-nav">
                                <ul class="navigation">
                                    <li><a href="{{ route('dashboard.DProfile.index') }}"><i class="icon-user-plus"></i> <span>@lang('My profile')</span></a></li>
                                    <li><a href="{{ route('Dlogout') }}"><i class="icon-switch2"></i> <span>@lang('Logout')</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /user menu -->
                        <!-- Main navigation -->
                        @include('DCommon::layouts.menu')
                        @include('DCommon::layouts.styles')
                        <!-- /main navigation -->
                    </div>
                </div>
                <!-- /main sidebar -->
                <!-- Main content -->
                <div class="content-wrapper">
                    @include('DCommon::layouts.page_header')
                    <!-- Content area -->
                    <div class="content">
                        @yield('content')
                        <!-- Footer -->
                        <div class="footer text-muted">
                            &copy; {{ date('Y') }}.
                            <a href="#">
                                @lang('Project')
                            </a> by
                            <a href="https://tasawk.com.sa" target="_blank">
                                @lang('Tasawk')
                            </a>
                        </div>
                        <!-- /footer -->
                    </div>
                    <!-- /content area -->
                </div>
                <!-- /main content -->
            </div>
            <!-- /page content -->
        </div>
        <!-- /page container -->.
        <script>
            $('.delete-record').click(function (e) {
                if (!confirm("@lang('Are You sure?')")) {
                    e.preventDefault();
                }
            });
        </script>
        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip(); 
            });
        </script>
        @stack('scripts')
        @stack('footer_scripts')
    </body>
</html>
