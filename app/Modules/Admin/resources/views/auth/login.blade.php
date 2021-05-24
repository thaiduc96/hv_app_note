@extends('Admin::layouts.master')

@section('content')

    <section class="login-content">
        <div class="logo">
            <h1>{{ env('APP_NAME') }}</h1>
        </div>
        <div class="login-box">
            <form class="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>{{ __('Login') }}</h3>
                @include("Admin::layouts.components.form-input",['errors' => $errors,'name' => 'email','label' => 'EMAIL *','type' => 'email'])
{{--                <div class="form-group">--}}
{{--                    <label class="control-label">EMAIL</label>--}}
{{--                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"--}}
{{--                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}
{{--                    @error('email')--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $message }}</strong>--}}
{{--                    </span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
                @include("Admin::layouts.components.form-input",['errors' => $errors,'name' => 'password','label' => 'PASSWORD *','type' => 'password'])
{{--                <div class="form-group">--}}
{{--                    <label class="control-label">PASSWORD</label>--}}
{{--                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"--}}
{{--                           name="password" required autocomplete="current-password">--}}
{{--                    @error('password')--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $message }}</strong>--}}
{{--                    </span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
                <div class="form-group">
                    <div class="utility">
                        @include("Admin::layouts.components.form-checkbox",['errors' => $errors,'name' => 'remember','label' => 'Stay Signed in','valueChecked' => true])
                        @if (Route::has('password.request'))
                            <p class="semibold-text mb-2"><a href="{{ route('password.request') }}" data-toggle="flip">Forgot
                                    Password ?</a></p>
                        @endif
                    </div>
                </div>
                <div class="form-group btn-container">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN
                        IN
                    </button>
                </div>
            </form>
            <form class="forget-form" method="POST" action="{{ route('password.email') }}">
                @csrf
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
                @include("Admin::layouts.components.form-input",['errors' => $errors,'name' => 'email','label' => 'EMAIL *','type' => 'email'])
                {{--                <div class="form-group">--}}
{{--                    <label class="control-label">{{ __('E-Mail Address') }}</label>--}}
{{--                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"--}}
{{--                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}
{{--                    @error('email')--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
                <div class="form-group btn-container">
                    <button type="submit" class="btn btn-primary btn-block"><i
                            class="fa fa-unlock fa-lg fa-fw"></i> {{ __('Send Password Reset Link') }}</button>
                </div>
                <div class="form-group mt-3">
                    <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i>Back
                            to Login</a></p>
                </div>
            </form>
        </div>
    </section>



    {{--    <div class="container">--}}
    {{--        <div class="row justify-content-center">--}}
    {{--            <div class="col-md-8">--}}
    {{--                <div class="card">--}}
    {{--                    <div class="card-header">{{ __('Login') }}</div>--}}

    {{--                    <div class="card-body">--}}
    {{--                        <form method="POST" action="{{ route('login') }}">--}}
    {{--                            @csrf--}}

    {{--                            <div class="form-group row">--}}
    {{--                                <label for="email"--}}
    {{--                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

    {{--                                <div class="col-md-6">--}}
    {{--                                    <input id="email" type="email"--}}
    {{--                                           class="form-control @error('email') is-invalid @enderror" name="email"--}}
    {{--                                           value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

    {{--                                    @error('email')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                    @enderror--}}
    {{--                                </div>--}}
    {{--                            </div>--}}

    {{--                            <div class="form-group row">--}}
    {{--                                <label for="password"--}}
    {{--                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

    {{--                                <div class="col-md-6">--}}
    {{--                                    <input id="password" type="password"--}}
    {{--                                           class="form-control @error('password') is-invalid @enderror" name="password"--}}
    {{--                                           required autocomplete="current-password">--}}

    {{--                                    @error('password')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                    @enderror--}}
    {{--                                </div>--}}
    {{--                            </div>--}}

    {{--                            <div class="form-group row">--}}
    {{--                                <div class="col-md-6 offset-md-4">--}}
    {{--                                    <div class="form-check">--}}
    {{--                                        <input class="form-check-input" type="checkbox" name="remember"--}}
    {{--                                               id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

    {{--                                        <label class="form-check-label" for="remember">--}}
    {{--                                            {{ __('Remember Me') }}--}}
    {{--                                        </label>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}

    {{--                            <div class="form-group row mb-0">--}}
    {{--                                <div class="col-md-8 offset-md-4">--}}
    {{--                                    <button type="submit" class="btn btn-primary">--}}
    {{--                                        {{ __('Login') }}--}}
    {{--                                    </button>--}}

    {{--                                    @if (Route::has('password.request'))--}}
    {{--                                        <a class="btn btn-link" href="{{ route('password.request') }}">--}}
    {{--                                            {{ __('Forgot Your Password?') }}--}}
    {{--                                        </a>--}}
    {{--                                    @endif--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </form>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
