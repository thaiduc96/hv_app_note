@extends('Admin::layouts.master')

@section('content')

    <section class="login-content">
        <div class="logo">
            <h1>{{ env('APP_NAME') }}</h1>
        </div>
        <div class=" login-box reset-box">
            <div class="card">

                <form class="login-form" method="POST" action="{{ route('password.email') }}">
                    <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>{{ __('Reset Password') }}</h3>
                    @csrf
                    @include("Admin::layouts.components.form-input",['errors' => $errors,'name' => 'email','label' => 'E-Mail Address *','type' => 'email'])
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
{{--                    <div class="form-group row">--}}
{{--                        <label for="email"--}}
{{--                               class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                        <div class="col-md-6">--}}
{{--                            <input id="email" type="email"--}}
{{--                                   class="form-control @error('email') is-invalid @enderror" name="email"--}}
{{--                                   value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                            @error('email')--}}
{{--                            <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
