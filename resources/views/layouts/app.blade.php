<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="msapplication-tap-highlight" content="no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title-page')</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/common.css'])
    <!-- Custom css -->
    @yield('template_linked_css_up')
    <link rel="stylesheet" href="{{ asset('assets/css/aims.css') }}" />
    @yield('template_linked_css')

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @yield('head')
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="d-none" id="sk-spinner">
            <div class="sk-bg-spinner">
                <div class="spinner-border m-5 text-success" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>

        @include('layouts.header')

        <div class="app-main">
            @if (Auth::check())
                @include('layouts.sidebar.sidebar')
            @endif
            <div class="app-main__outer">

                @if (Auth::check())
                    @include('layouts.main.page-title')
                @endif
                <div class="app-main__inner">
                    @include('layouts.main.page-title-actions')
                    <div class="form-status">
                        <div class="row">
                            <div class="col-12">
                                @include('partials.form-status')
                            </div>
                        </div>
                    </div>
                    <div class="main-content mb-4">
                        <div class="main-content mb-4 col-12 p-3 pt-0">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-wrapper-footer">
            @include('layouts.footer')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/common.js?v=6') }}"></script>
    <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache: false,
        });
        $(document).on({
            ajaxStart: function() {
                $("#sk-spinner").removeClass("d-none");
            },
            ajaxStop: function() {
                $("#sk-spinner").addClass("d-none");
            }
        });

        $(document).on("ajaxError", function(XMLHttpRequest, textStatus, errorThrown) {
            if (textStatus.status === 401 || textStatus.status === 419) {
                window.location.href = '/login';
                return;
            }
            $("#sk-spinner").addClass("d-none");
            if (navigator.onLine == false) {
                alert('ネットワークを確認してください');
            }
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>
    @yield('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.input-mask').inputmask({
                alias: 'numeric',
                groupSeparator: ',',
                autoGroup: true,
                digits: 0,
                rightAlign: false
            });

        })
    </script>
</body>

</html>
