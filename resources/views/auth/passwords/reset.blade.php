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
        <div class="col-12">
            <div class="">
                <div class="card-body  d-flex justify-content-center">
                    <form method="POST" action="{{ route('password.update') }}" class="col-md-6 col-12">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="col-12 ">
                            <div class="col-12 mb-3">
                                <label for="email" class="col-md-4 col-form-label ">{{ __('Địa chỉ Email') }}</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="email" class="col-md-4 col-form-label ">{{ __('Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="email" class="col-md-4 col-form-label ">{{ __('Confirm Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                    required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class=" mb-0 text-center">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-dark btn-thefarm-default col-3 mt-3 ">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>

                        </div>

                    </form>
                <div>
            </div>
        </div>
    </div>

@endsection
@section('footer_scripts')
    <script type="text/javascript">
        localStorage.removeItem('sidebar');
        $('.app-container').addClass('bg-white');
    </script>
    <script>
        $(document).ready(function() {
            $(".alert-danger .close").on("click", function() {
                $(this).parent().fadeOut();
            });
        });
    </script>
@endsection
