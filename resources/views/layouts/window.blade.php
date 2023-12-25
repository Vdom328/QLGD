<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="msapplication-tap-highlight" content="no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite([ 'resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Custom css -->
    @yield('template_linked_css_up')
    <link rel="stylesheet" href="{{asset('assets/css/aims.css')}}" />
    @yield('template_linked_css')
    
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    

    @yield('head')

</head>
<body>
    
    <div class="app-container app-theme-white">
        <div class="d-none" id="sk-spinner">
            <div class="sk-bg-spinner">
                <div class="spinner-border m-5 text-success" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <div class="app-main p-0">
            <div class="app-main__outer p-0">
                <div class="app-main__inner">
                    @if (Auth::User())
                        @include('layouts.main.page-title')
                    @endif
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                @include('partials.form-status')
                            </div>
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('assets/js/common.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache: false,
        });
        $(document).on({
            ajaxStart: function(){
                $("#sk-spinner").removeClass("d-none"); 
            },
            ajaxStop: function(){ 
                $("#sk-spinner").addClass("d-none"); 
            }    
        });
    </script>
    @yield('footer_scripts')

</body>
</html>
