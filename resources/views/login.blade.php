<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ورود | استعلام</title>
    <!--global css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-rtl.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/advbuttons.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <!--end of global css-->
    <!--page level css starts-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/iCheck/css/all.css')}}" />
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/login.css') }}">
    <!--end of page level css-->
</head>
<body>
<div class="container">
    <!--Content Section Start -->
    <div class="row">
        <div class="box font_size rtl">
            <div class="box1">
                <div class="text-center">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo_fa.png') }}" alt="logo" class="img-fluid mar"></a>
                </div>
                <h3 class="text-primary">ورود</h3>
                <!-- Notifications -->
                <div id="notific">
                    @include('notifications')
                </div>
                <form action="{{ route('post.login') }}" class="omb_loginForm" autocomplete="off" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group {{ $errors->first('username', 'has-error') }}">
                        <label class="sr-only">شماره همراه</label>
                        <input type="tel" class="form-control" id="username" name="username" placeholder="شماره همراه" value="{!! old('username') !!}" autocomplete="off">
                    </div>
                    <span class="help-block">{{ $errors->first('username', ':message') }}</span>
                    <div class="form-group {{ $errors->first('password', 'has-error') }}">
                        <label class="sr-only">رمز عبور</label>
                        <input type="password" class="form-control" name="password" placeholder="رمز عبور">
                    </div>
                    <span class="help-block">{{ $errors->first('password', ':message') }}</span>
                    <div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox"> مرا به خاطر بسپار
                        </label>

                    </div>
                    <input type="submit" class="btn btn-block btn-primary" value="ورود">
                    اگر حساب کاربری ندارد؟  <a href="{{ route('register') }}"><strong> ثبت نام</strong></a>
                </form>
            </div>
            <div class="bg-light animation flipInX">
                <a href="{{ route('forgot-password') }}" id="forgot_pwd_title">فراموشی رمز عبور؟</a>
                <a class="pull-left" href="{{ route('home') }}" style="margin-left: 20px">بازگشت به صفحه اصلی</a>
            </div>
        </div>
    </div>
    <!-- //Content Section End -->
</div>
<!--global js starts-->
<script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/login_custom.js') }}"></script>
<!--global js end-->

<script>
    $(function () {
        $(".omb_loginForm").bootstrapValidator({
            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: 'شماره همراه الزامی است !'
                        },
                        regexp: {
                            regexp: /^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$/,
                            message: 'الگوی مناسب 0912xxxxxxx است !'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'این فیلد الزامی است!'
                        }
                    }
                }
            }
        });
    })
</script>
</body>
</html>