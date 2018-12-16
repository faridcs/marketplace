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
    <link href="{{ asset('assets/css/jquery.ui.autocomplete.css') }}" rel="stylesheet"/>
    @yield('header_styles')
    <style>
        .ui-autocomplete {
            position: absolute !important;
            top: 64px !important;
            right: 23% !important;
        }
    </style>
</head>

<body>

<header class="header">
    <div class="container" style="max-width: 100% !important;">
        <nav class="navbar navbar-expand-lg navbar-default bg-default rtl">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo_fa.png') }}" alt="logo" width="200">
            </a>

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
        </nav>
        @if(Auth::user()->type == 2)
            <div class="row justify-content-md-center">
                <div class="col col-lg-1">

                </div>
                <div class="col-md-auto rtl" style="margin-top: -75px">
                    <form action="{{ route('request') }}" method="post" enctype="multipart/form-data" novalidate>
                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div class="row justify-content-center align-self-center" style="margin-top: 3%">
                            <div class="col-md-10">
                                <div class="input-group input-group-lg">
                                    <input type="text" name="title" id="title" class="form-control" placeholder="جستجو ..." autocomplete="off">
                                    <input type="number" min="1" name="count" id="count" class="form-control col-md-2" placeholder="تعداد">
                                    <div class="input-group-append">
                                        <select id="unit" name="unit" class="no-radius">
                                            @foreach($units as $unit)
                                                <option value="{{ $unit->text }}">{{ $unit->translate }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-group-prepend">
                                        <button type="submit" class="btn btn-success col-md-12"><i class="fa fa-search"></i> استعلام </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center align-self-center" style="margin-top: 2%">
                            <a id="advanceBtn" href="#" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" > جستجوی پیشترفته
                                <i class="livicon icon3" data-name="angle-double-down" data-size="18" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                            </a>
                        </div>

                        <div class="row justify-content-center align-self-center" style="margin-top: 2%">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col">
                                        <div class="collapse multi-collapse">
                                            <div class="form-group">
                                                <div class="card card-body">
                                                    <h6 style="color: #75c9cf"><b>توضیحات</b></h6>
                                                    <div class="form-group">
                                                        <textarea name="description" class="form-control input-lg no-resize resize_vertical" rows="6" placeholder="متن شما" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-md-4 control-label" for="datepicker">فایل ضمیمه</label>
                                                    <div class="col-md-8">
                                                        <div class="custom-file">
                                                            <input type="file" name="file" id="file" class="custom-file-input" >
                                                            <label class="custom-file-label" for="file">انتخاب فایل ...</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="collapse multi-collapse">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-md-4 control-label" for="sendType">ارسال به</label>
                                                    <div class="col-md-8">
                                                        <select name="sendType" id="sendType" class="form-control">
                                                            <option value="1">کل سایت</option>
                                                            <option value="2">گروه ها</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="groupDiv" class="form-group" style="display: none;">
                                                <div class="row">
                                                    <label class="col-md-4 control-label" for="group">گروه های من</label>
                                                    <div class="col-md-8">
                                                        <select name="group" id="group" class="form-control">
                                                            <option value="">انتخاب کنید ...</option>
                                                            @foreach($groups as $group)
                                                                <option value="{{ $group->Group_id }}">{{ $group->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div data-mddatetimepicker="true" data-inline="true" data-isgregorian="false" data-targetselector="#fromDate0" data-enabletimepicker="false"
                                                                 style="border: solid 1px #ccc;">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="date" id="fromDate0" placeholder="مهلت ارسال قیمت" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center align-self-center" style="margin-top: 2%;">
                            <a id="advanceBtnClose" href="#" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" style="display: none">بستن
                                <i class="livicon icon3" data-name="angle-double-up" data-size="18" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col col-lg-5">

            </div>
        @endif
    </div>
</header>

<!-- Content -->
@yield('content')

<!-- Footer Section Start -->
<footer style="background-color: white; position: relative">
    <div class="col-12">
        <div class="container rtl">
            <p>کلیه حقوق متعلق به استعلام می باشد.</p>
        </div>
    </div>
</footer>

<script type="text/javascript" src="{{ asset('assets/js/frontend/lib.js') }}"></script>
@yield('footer_scripts')

<script type="text/javascript" src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>

<script>
    $(function () {

        let src = "{{ route('category') }}";
        $("#title").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: src,
                    dataType: "json",
                    data: {
                        term : request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
        });

        $('#unit').select2({
            allowClear: true,
            theme:"bootstrap",
            placeholder: "انتخاب واحد",
            width: null,
        });

        $("#advanceBtn").click(function () {
            if ($(this).attr('aria-expanded') == 'false') {
                $(this).fadeOut();
                $('#advanceBtnClose').css('display', 'block')
            }
        });

        $("#advanceBtnClose").click(function () {
            $(this).css("display", "none");
            $('#advanceBtn').fadeIn();
        });

        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        $('#sendType').change(function(){
            if($(this).val() == "2"){
                $('#groupDiv').show();
            } else {
                $('#groupDiv').hide();
            }
        });
    })
</script>
</body>

</html>