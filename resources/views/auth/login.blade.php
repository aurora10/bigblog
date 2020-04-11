@extends('layouts.app')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>My</b>BLOG</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group  @error('email') is-invalid @enderror " name="email" value="{{ old('email') }}"
                     required autocomplete="email" autofocus has-feedback>
                    <input type="email" class="form-control" placeholder="Email" name="email"
                           value="{{ old('email') }}">
                    <span class="fa fa-envelope form-control-feedback"></span>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>

                <div class="form-group">
                    {{--                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                    {{--                    <div class="col-md-6">--}}
                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    {{--                    </div>--}}
                </div>


                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <br>
            <a href="{{ route('password.request') }}">I forgot my password</a><br>

        </div>
        <!-- /.login-box-body -->
    </div>
@endsection
