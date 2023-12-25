@extends('layouts.app')

@section('content')
    <div class="row login-form d-flex  align-items-center">
        <div class="col-md-12">
            <div class="">
                @if (session('status'))
                    <div class="d-flex justify-content-around">
                        <div class="col-5 alert alert-success d-flex justify-content-between">
                            <div role="alert">{{ session('status') }}</div>
                        </div>
                    </div>
                @endif
                <div class="card-body d-flex justify-content-center">
                    <form method="POST" action="{{ route('password.email') }}" class="col-md-6 col-12">
                        @csrf

                        <div class="row col-12 mb-3">
                            <label for="email" class="col-md-12 col-form-label ">{{ __('電子メールアドレス') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class=" mb-0 text-center">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-dark btn-thefarm-default col-4 mt-3 ">
                                    {{ __('パスワードリセットリンクを送信する') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_scripts')
    <script type="text/javascript">
        localStorage.removeItem('sidebar');
        $('.app-container').addClass('bg-white');
    </script>
@endsection
