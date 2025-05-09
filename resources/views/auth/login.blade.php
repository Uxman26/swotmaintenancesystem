@extends('layouts.login.app')

@section('content')
    <section id="woffice-login" class="revslider-disabled">

        <div id="woffice-login-left">
        </div>
        <div id="woffice-login-right">
            @include('layouts.login.header')

            <div class="login-tabs-wrapper">
                @error('email')
                <div class="infobox fa-exclamation-triangle" style="background-color: #ffa500;">
                    <span class="infobox-head">
                        <i class="fa fa-exclamation-triangle"></i> We have an error:
                    </span>
                    <p>Invalid username and/or password.</p>
                </div>
                @enderror

                @if( isset($message) && $message == "success")
                <div class="infobox fa-check-circle" style="background-color: #15d000;">
                    <span class="infobox-head">
                        <i class="fa fa-check-circle"></i> Success:
                    </span>
                    <p>You are logged out.</p>
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <p class="login-username">
                        <label for="user">
                            Email Address
                        </label>
                        <input id="email" type="email" name="email" class="input @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus size="20" />
{{--                        @error('email')--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                            <strong>{{ $message }}</strong>--}}
{{--                        </span>--}}
{{--                        @enderror--}}
                    </p>
                    <p class="login-password">
                        <label for="pass">
                            Password
                        </label>
                        <input id="password" type="password" name="password" class="input @error('password') is-invalid @enderror" value="" size="20" required autocomplete="current-password"/>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </p>

                    <p class="login-remember">
                        <label>
                            <input name="remember" id="remember" type="checkbox" id="rememberme" value="forever" {{ old('remember') ? 'checked' : '' }} />
                            Remember Me
                            &emsp;
                            <a href="{{ route('password.request') }}">Forget password?</a>
                        </label>
                    </p>
                    <p class="login-submit">
                        <input name="btn-submit" id="btn-submit" style="margin:0;" type="submit" class="button button-primary" value="Log In" />
                    </p>
                    <a href="{{ route('register') }}">
                        Create an account
                    </a>
                </form>
            </div>

            @include('layouts.login.footer')
        </div>
    </section>
@endsection
