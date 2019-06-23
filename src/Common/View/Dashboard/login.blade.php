<!DOCTYPE html>
<html lang="{{App::getLocale()}}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        {!! AssetsAdmin('icons/icomoon/styles.css') !!}
        {!! AssetsAdmin('bootstrap.css') !!}
        {!! AssetsAdmin('core.css') !!}
        {!! AssetsAdmin('components.css') !!}
        {!! AssetsAdmin('colors.css') !!}
        <!-- /global stylesheets -->

        <!-- Core JS files -->
        {!! AssetsAdmin('plugins/loaders/pace.min.js','js') !!}
        {!! AssetsAdmin('core/libraries/jquery.min.js','js') !!}
        {!! AssetsAdmin('core/libraries/bootstrap.min.js','js') !!}
        {!! AssetsAdmin('plugins/loaders/blockui.min.js','js') !!}

    </head>

    <body class="login-container bg-slate-800">

        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">

                    <!-- Content area -->
                    <div class="content">

                        <!-- Advanced login -->
                        <form action="{{ Route('loginCheck') }}" method="post">
                            @csrf
                            <div class="panel panel-body login-form">
                                <div class="text-center">
                                    <div class="icon-object border-warning-400 text-warning-400"><i class="icon-people"></i></div>
                                    <h5 class="content-group-lg">لوحه تحكم الإداره <small class="display-block">برجاء تسجيل الدخول</small></h5>
                                </div>

                                <div class="form-group has-feedback has-feedback-left">
                                    <input type="text" class="form-control" name="username" placeholder="إسم المستخدم">
                                    <div class="form-control-feedback">
                                        <i class="icon-user text-muted"></i>
                                    </div>
                                    @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group has-feedback has-feedback-left">
                                    <input type="password" class="form-control" name="password" placeholder="كلمه المرور">
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group has-feedback has-feedback-left">
                                    @if (session('falde'))
                                    <span class="invalid-feedback" role="alert-danger">
                                        <strong>{{ session('falde') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn bg-blue btn-block">تسجيل الدخول <i class="icon-circle-left2 position-right"></i></button>
                                </div>
                            </div>
                        </form>
                        <!-- /advanced login -->

                    </div>
                    <!-- /content area -->

                </div>
                <!-- /main content -->

            </div>
            <!-- /page content -->

        </div>
        <!-- /page container -->

    </body>
</html>
