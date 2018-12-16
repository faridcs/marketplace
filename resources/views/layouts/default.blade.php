<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="locale" content="{{ app()->getLocale() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <title>
        @section('title')
        | استعلام
        @show
    </title>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
    @yield('header_styles')
</head>

<body>

<header class="header">
    <div class="container indexpage">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rtl">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo_fa.png') }}" alt="logo" width="200"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto" style="margin-right: 0 !important;">
                    <li  class="nav-item {!! (Request::is('/') ? 'active' : '') !!}"><a href="{{ route('home') }}" class="nav-link"> صفحه اصلی</a></li>
                    <li class="nav-item {!! (Request::is('about-us') ? 'active' : '') !!}"><a href="{{ URL::to('about-us') }}" class="nav-link">درباره ما</a></li>
                    <li class="nav-item {!! (Request::is('contact') ? 'active' : '') !!}"><a href="{{ URL::to('contact') }}" class="nav-link">تماس با ما</a></li>
                </ul>

                <ul class="nav navbar-nav ml-auto">
                    @if(Auth::guest())
                        <li class="nav-item"><a href="{{ URL::to('login') }}" class="nav-link">ورود</a></li>
                        <li class="nav-item"><a href="{{ URL::to('register') }}" class="nav-link">ثبت نام</a></li>
                    @else
                        @include('layouts._notifications')
                        <li class="nav-item dropdown user user-menu" style="direction: ltr;float: left">
                            <a href="#" class="nav-link" data-toggle="dropdown">
                                @if(Auth::user()->image)
                                    <img src="{!! url('/').'/uploads/users/'.Auth::user()->image !!}" alt="img" height="35px" width="35px"
                                         class="rounded-circle img-fluid float-left"/>

                                @elseif(Auth::user()->gender === "male")
                                    <img src="{{ asset('assets/images/authors/avatar3.png') }}" alt="img" height="35px" width="35px"
                                         class="rounded-circle img-fluid float-left"/>

                                @elseif(Auth::user()->gender === "female")
                                    <img src="{{ asset('assets/images/authors/avatar5.png') }}" alt="img" height="35px" width="35px"
                                         class="rounded-circle img-fluid float-left"/>

                                @else
                                    <img src="{{ asset('assets/images/authors/no_avatar.jpg') }}" alt="img" height="35px" width="35px"
                                         class="rounded-circle img-fluid float-left"/>
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ URL::to('my-account') }}">
                                        <i class="livicon" data-name="user" data-s="18"></i>
                                        حساب کاربری من
                                    </a>
                                </li>
                                <li role="presentation"></li>
                                <li>
                                    <a href="{{ route('request') }}">
                                        <i class="livicon" data-name="inbox" data-s="18"></i>
                                        استعلام ها
                                    </a>
                                </li>
                                <li role="presentation"></li>
                                <li>
                                    <a href="{{ route('my-groups') }}">
                                        <i class="livicon" data-name="users" data-s="18"></i>
                                        گروه ها
                                    </a>
                                </li>
                                <li role="presentation"></li>
                                <li>
                                    <a href="{{ route('plans') }}">
                                        <i class="livicon" data-name="shopping-cart-in" data-s="18"></i>
                                        طرح های عضویت
                                    </a>
                                </li>
                                <li role="presentation"></li>
                                <li>
                                    <a href="{{ route('change-position') }}">
                                        <i class="livicon" data-name="resize-horizontal-alt" data-s="18"></i>
                                        تبدیل به <span class="text-danger">@if(Auth::user()->type == 1) {{ 'خریدار' }} @else {{ 'تامین کننده' }} @endif</span>
                                    </a>
                                </li>
                                <li role="presentation"></li>
                                <li>
                                    <a href="{{ URL::to('logout') }}">
                                        <i class="livicon" data-name="sign-out" data-s="18"></i>
                                        خروج
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>

@yield('top')

<!-- Content -->
@yield('content')

<!-- Footer Section Start -->
<footer>
    <div class="col-12 rtl">
        <div class="container">
            <p>کلیه حقوق متعلق به استعلام می باشد.</p>
        </div>
    </div>
</footer>

<script type="text/javascript" src="{{ asset('assets/js/frontend/lib.js') }}"></script>
@yield('footer_scripts')
</body>

</html>