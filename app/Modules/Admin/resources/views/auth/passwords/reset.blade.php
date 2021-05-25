@extends('Admin::layouts.master')

@section('content')

    <section class="login-content">
        <div class="logo">
            <h1>{{ env('APP_NAME') }}</h1>
        </div>
        <div class="login-box reset-box">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        @include("Admin::layouts.components.form-input",['errors' => $errors,'name' => 'email','label' => 'E-Mail Address *','type' => 'email'])
{{--                        <div class="form-group row">--}}
{{--                            <label for="email"--}}
{{--                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Adxdress') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email"--}}
{{--                                       class="form-control @error('email') is-invalid @enderror"--}}
{{--                                       name="email" value="{{ $email ?? old('email') }}" required--}}
{{--                                       autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        @include("Admin::layouts.components.form-input",['errors' => $errors,'name' => 'password','label' => 'Password *','type' => 'password'])

{{--                        <div class="form-group row">--}}
{{--                            <label for="password"--}}
{{--                                   class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password"--}}
{{--                                       class="form-control @error('password') is-invalid @enderror"--}}
{{--                                       name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        @include("Admin::layouts.components.form-input",['errors' => $errors,'name' => 'password_confirmation','label' => 'Confirm Password *','type' => 'password'])
{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm"--}}
{{--                                   class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control"--}}
{{--                                       name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
