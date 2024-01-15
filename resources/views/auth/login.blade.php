@extends('layouts.app')
@section('template_linked_css')
    <style>
        .app-page-title .page-title-wrapper {
            background-color: white;
        }
    </style>
@endsection
@section('content')
    <div class="row login-form d-flex  align-items-center">
        <div class="col-12 ">
            <div class="">
                {{-- <div class="card-header">{{ __('login.screen_name') }}</div> --}}
                @if ($errors->any())
                    <div class="d-flex justify-content-around">
                        <div class="col-6 alert alert-danger d-flex justify-content-between">
                            @foreach ($errors->all() as $error)
                                <span>{{ $error }}</span>
                            @endforeach
                            <div class="d-flex justify-content-end">
                                <a class="close cursor-pointer" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card-body  d-flex justify-content-center">
                    <form method="POST" action="{{ route('login') }}" class="col-md-6 col-12">
                        {{ csrf_field() }}
                        <div class="col-12 ">
                            <div class="col-12 mb-3">
                                <label for="email" class="col-md-4 col-form-label ">{{ __('login.label_id') }}</label>

                                <div class="col-md-12">
                                    <input id="email" type="text"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label ">{{ __('login.label_password') }}</label>
                                <div class="col-md-12">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('login.label_remember_me') }}
                                </label>
                            </div>
                        </div>
                    </div> --}}

                        <div class=" mb-0 text-center">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-dark btn-thefarm-default col-3 mt-3 ">
                                    {{ __('login.btn_submit') }}
                                </button>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link   mt-3" href="{{ route('password.request') }}">
                                    {{ __('login.label_forgot_your_pwd') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_scripts')
    <script type="text/javascript">
        // localStorage.removeItem('sidebar');
        $('.app-container').addClass('bg-white');
    </script>
    <script>
        $(document).ready(function () {
            $(".alert-danger .close").on("click", function () {
                $(this).parent().fadeOut();
            });
        });
    </script>
@endsection
