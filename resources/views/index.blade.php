@extends('layouts/default')

@section('title')
    صفحه اصلی
    @parent
@stop

@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/animate.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery.circliful.css') }}">
    <link type="text/css" href="{{ asset('assets/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/selectize/css/selectize.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/iCheck/css/line/line.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/bootstrap-switch/css/bootstrap-switch.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/switchery/css/switchery.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/pages/formelements.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/jquery.Bootstrap-PersianDateTimePicker.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/jquery.ui.autocomplete.css') }}" rel="stylesheet"/>
    <style>
        .input-group-lg .select2-container--bootstrap .select2-selection--single {
            border-radius: 0px !important;
            height: 48px;
        }
        .select2-results {
            direction: rtl !important;
            text-align: right !important;
        }
        .select2-search__field {
            direction: rtl !important;
            text-align: right !important;
        }

    </style>
@stop

{{-- content --}}
@section('content')
    <div class="container rtl">
        <!-- Notifications -->
        <div id="notific" style="margin-top: 5%">
            @include('notifications')
        </div>
        <div class="row justify-content-center align-self-center" style="margin-top: 5%">
            <h1>دنبال قیمت چه محصولی هستید؟</h1>
        </div>
        <form action="{{ route('request') }}" method="post" enctype="multipart/form-data" novalidate>
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <div class="row justify-content-center align-self-center" style="margin-top: 3%">
                <div class="col-md-10">
                    <div class="input-group input-group-lg">
                        <input type="text" name="title" id="title" class="form-control" placeholder="جستجو ..." autocomplete="off">
                        <input type="number" name="count" id="count" class="form-control col-md-2" min="1" placeholder="تعداد">
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
                                <div class="card card-body">
                                    <h6 style="color: #75c9cf"><b>توضیحات</b></h6>
                                    <div class="form-group">
                                        <textarea name="description" class="form-control input-lg no-resize resize_vertical" rows="6" placeholder="متن شما" required></textarea>
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
                                        <label class="col-md-4 control-label" for="group">گروه های من : </label>
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
                                        <label class="col-md-4 control-label" for="datepicker">مهلت ارسال قیمت</label>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <div data-mddatetimepicker="true" data-inline="true" data-isgregorian="false" data-targetselector="#fromDate0" data-enabletimepicker="false"
                                                     style="border: solid 1px #ccc;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="date" id="fromDate0" placeholder="تاریخ" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-md-4 control-label" for="datepicker">فایل ضمیمه</label>
                                        <div class="col-md-8">
                                            <div class="custom-file">
                                                <input type="file" name="file" id="file" class="custom-file-input">
                                                <label class="custom-file-label" for="file">انتخاب فایل ...</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-self-center" style="margin-top: 2%;margin-bottom: 5%">
                <a id="advanceBtnClose" href="#" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" style="display: none">بستن
                    <i class="livicon icon3" data-name="angle-double-up" data-size="18" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                </a>
            </div>
        </form>

    </div>
@stop

{{-- footer scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.circliful.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/wow/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jalaali.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.Bootstrap-PersianDateTimePicker.js') }}"></script>
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
@stop