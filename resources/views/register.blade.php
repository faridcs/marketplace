<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ثبت نام | استعلام</title>
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
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-tagsinput/css/app.css') }}" />
    <link href="{{ asset('assets/css/pages/tagsinput.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/register.css') }}">
    <!--end of page level css-->
</head>
<body>
<div class="container">
    <!--Content Section Start -->
    <div class="row">
        <div class="box font_size rtl">
            <div class="text-center">
                <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo_fa.png') }}" alt="logo" class="img-fluid mar"></a>
            </div>
            <h3 class="text-primary">ثبت نام</h3>
            <!-- Notifications -->
            <div id="notific">
            @include('notifications')
            </div>
            <form action="{{ route('register') }}" method="POST" id="reg_form">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                    <label class="sr-only"> نام</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="نام"
                           value="{!! old('first_name') !!}" >
                    {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                    <label class="sr-only"> نام خانوادگی</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="نام خانوادگی"
                           value="{!! old('last_name') !!}" >
                    {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->first('username', 'has-error') }}">
                    <label class="sr-only"> شماره همراه</label>
                    <input type="tel" class="form-control" id="username" name="username" placeholder="شماره همراه" value="{!! old('username') !!}" autocomplete="off">
                    {!! $errors->first('username', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->first('password', 'has-error') }}">
                    <label class="sr-only"> رمز عبور</label>
                    <input type="password" class="form-control" id="Password1" name="password" placeholder="رمز عبور">
                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->first('password_confirmation', 'has-error') }}">
                    <label class="sr-only"> تکرار رمز عبور</label>
                    <input type="password" class="form-control" id="Password2" name="password_confirmation" placeholder="تکرار رمز عبور">
                    {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="clearfix"></div>
                <div class="checkbox rtl pull-right">
                    <label>
                            <input class="form-check-input" type="radio" name="type" id="provider" value="1" checked>
                            <label class="form-check-label" for="provider">تامین کننده</label>
                    </label>
                    <label>
                            <input class="form-check-input" type="radio" name="type" id="buyer" value="2">
                            <label class="form-check-label" for="buyer">خریدار</label>
                    </label>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="form-group rtl">
                    <label for="multi">انتخاب عنوان های کاری</label>
                    <input type="text" class="form-control" id="category" name="category" data-role="tagsinput" placeholder="فیلد را تایپ کنید و کلید Enter را بزنید ..."/>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="checkbox rtl pull-right">
                    <label>
                        <input type="checkbox" name="subscribed" >  من <a href="#"> قوانین و مقررات </a> سایت را میپذیرم
                        {!! $errors->first('subscribed', '<span class="help-block">:message</span>') !!}
                    </label>
                </div>
                <button type="submit" class="btn btn-block btn-primary">ثبت نام</button>
                آیا قبلا حساب کاربری داشته اید؟  <a href="{{ route('login') }}"> ورود </a>
            </form>
        </div>
    </div>
    <!-- //Content Section End -->
</div>
<!--global js starts-->
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"  type="text/javascript"></script>
<script src="{{ asset('assets/vendors/typeahead.js/js/typeahead.bundle.min.js') }}"  type="text/javascript"></script>
<script src="{{ asset('assets/vendors/typeahead.js/js/bloodhound.min.js') }}"  type="text/javascript"></script>
<!--global js end-->

<script>
    $(document).ready(function(){
        $("input[type='checkbox'],input[type='radio']").iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        $("#reg_form").bootstrapValidator({
            fields: {
                first_name: {
                    validators: {
                        notEmpty: {
                            message: 'نام الزامی است !'
                        }
                    },
                    required: true,
                    minlength: 3
                },
                last_name: {
                    validators: {
                        notEmpty: {
                            message: 'نام خانوادگی الزامی است !'
                        }
                    },
                    required: true,
                    minlength: 3
                },
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
                            message: 'رمز عبور الزامی است !'
                        },
                        different: {
                            field: 'first_name,last_name',
                            message: 'Password should not match first/last Name'
                        }
                    }
                },
                password_confirmation: {
                    validators: {
                        notEmpty: {
                            message: 'تکرار رمز عبور الزامی است !'
                        },
                        identical: {
                            field: 'password',
                            message: 'لطفا رمز عبور یکسان وارد کنید !'
                        },
                        different: {
                            field: 'first_name,last_name',
                            message: 'Confirm Password should match with password'
                        }
                    }
                }
            }
        });
    });

    $('#reg_form input').on('keyup', function (){

        $('#reg_form input').each(function(){
            var pswd = $("#reg_form input[name='password']").val();
            var pswd_cnf = $("#reg_form input[name='password_confirm']").val();
            if(pswd != '' ){
                $('#reg_form').bootstrapValidator('revalidateField', 'password');
            }
            if(pswd_cnf != '' ){
                $('#reg_form').bootstrapValidator('revalidateField', 'password_confirm');
            }
        });
    });
</script>

<script>
    let categories = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '{!! url("/") !!}' + '/category/find?keyword=%QUERY%',
            wildcard: '%QUERY%',
        }
    });
    categories.initialize();

    let elt = $('#category');
    elt.tagsinput({
        trimValue: true,
        allowDuplicates : false,
        freeInput: true,
        focusClass: 'form-control',
        tagClass: function() {
            return 'label label-info';
        },
        onTagExists: function(item, $tag) {
            $tag.hide().fadeIn();
        },
        typeaheadjs: [{
            hint: false,
            highlight: true
        },
        {
            name: 'category',
            itemValue: 'Category_id',
            displayKey: 'title',
            source: categories.ttAdapter(),
            templates: {
                empty: [
                    '<ul class="list-group"><li class="list-group-item">موردی یافت نشد ...</li></ul>'
                ],
                header: [
                    '<ul class="list-group">'
                ],
                suggestion: function (data) {
                    return '<li class="list-group-item">' + data.title + '</li>'
                }
            }
        }]
    });
</script>

</body>
</html>
