@extends('layouts.login.app')

@section('content')
    <section id="woffice-login" class="revslider-disabled">

        <div id="woffice-login-left">
        </div>
        <div id="woffice-login-right">
            @include('layouts.login.header')

            <div class="login-tabs-wrapper">
                <form name="loginform" id="loginform" action="https://swot.com.my/" method="post">

                    <p class="login-username">
                        <label for="user">
                            Email Address
                        </label>
                        <input type="text" name="log" id="user" class="input" value="" size="20" />
                    </p>
                    <p class="login-password">
                        <label for="pass">
                            Password
                        </label>
                        <input type="password" name="pwd" id="pass" class="input" value="" size="20" />
                    </p>

                    <p class="login-remember">
                        <label>
                            <input name="rememberme" type="checkbox" id="rememberme" value="forever" />
                            Remember Me
                        </label>
                    </p>
                    <p class="login-submit">
                        <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="Log In" />
                    </p>
                </form>
            </div>

            @include('layouts.login.footer')
        </div>
    </section>
@endsection

