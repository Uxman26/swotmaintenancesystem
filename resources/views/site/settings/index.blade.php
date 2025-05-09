@extends('layouts.site.app')

@section('content')
    @include('layouts.site.featurebox')

    <div id="content-container">

        <!-- START CONTENT -->
        <div id="content">
            <article id="post-0" class="bp_members type-bp_members post-0 page type-page status-publish">
                <div id="buddypress" class="buddypress-wrap bp-dir-hori-nav">
                    <div class="bp-wrap row woffice-profile--vertical" data-template="woffice">

                        @include('layouts.site.profile.leftmenu')

                        <div class="col-md-8" data-template="woffice">
                            <div id="item-body" class="item-body">
{{--                                <nav class="bp-navs bp-subnavs no-ajax user-subnav" id="subnav" role="navigation" aria-label="Settings menu">--}}
{{--                                    <ul class="subnav">--}}
{{--                                        <li id="general-personal-li" class="bp-personal-sub-tab current selected" data-bp-user-scope="general">--}}
{{--                                            <a href="https://demos.alkalab.com/woffice/business/members/demo/settings/" id="general">--}}
{{--                                                General--}}
{{--                                            </a>--}}
{{--                                        </li>--}}

{{--                                        <li id="notifications-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="notifications">--}}
{{--                                            <a href="https://demos.alkalab.com/woffice/business/members/demo/settings/notifications/" id="notifications">--}}
{{--                                                Email--}}
{{--                                            </a>--}}
{{--                                        </li>--}}

{{--                                        <li id="profile-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="profile">--}}
{{--                                            <a href="https://demos.alkalab.com/woffice/business/members/demo/settings/profile/" id="profile">--}}
{{--                                                Profile Visibility--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        --}}
{{--                                        <li id="invites-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="invites">--}}
{{--                                            <a href="https://demos.alkalab.com/woffice/business/members/demo/settings/invites/" id="invites">--}}
{{--                                                Group Invites--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        --}}
{{--                                        <li id="data-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="data">--}}
{{--                                            <a href="https://demos.alkalab.com/woffice/business/members/demo/settings/data/" id="data">--}}
{{--                                                Export Data--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </nav>--}}

                                <div id="message" class="bp-template-notice error">
                                    <p>
                                        There is a pending change of your email address to <code>joel.ti@fce.edu.br</code>.		<br>
                                        Check your email (<code>demo@demo.com</code>) for the verification link, or
                                        <a href="https://demos.alkalab.com/woffice/business/members/demo/settings/?dismiss_email_change=1&amp;_wpnonce=86f1f02f91">
                                            cancel the pending change
                                        </a>.
                                    </p>
                                </div>


                                <h2 class="screen-heading general-settings-screen">
                                    Email &amp; Password
                                </h2>

                                <p class="info email-pwd-info">
                                    Update your email and or password.
                                </p>

                                <form action="{{ route('profile.settings.post') }}" method="post" class="standard-form" id="settings-form">
                                    @csrf
                                    <label for="pwd">
                                        Current Password
                                        <span>
                                            (required to update email or change current password)
                                        </span>
                                    </label>
                                    <input type="password" name="password" id="password" size="16" value="" class="settings-input small" spellcheck="false" autocomplete="off"> &nbsp;
                                    <a href="{{ route('profile.settings.request_password') }}">
                                        Lost your password?
                                    </a>

                                    <label for="email">
                                        Account Email
                                    </label>
                                    <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" class="settings-input">

                                    <div class="info bp-feedback">
                                        <span class="bp-icon" aria-hidden="true"></span>
                                        <p class="text">
                                            Leave password fields blank for no change
                                        </p>
                                    </div>

                                    <label for="pass1">
                                        Add Your New Password
                                    </label>
                                    <input type="password" name="pass1" id="pass1" size="16" value="" class="settings-input small password-entry" spellcheck="false" autocomplete="off">

                                    <label for="pass2" class="repeated-pwd">
                                        Repeat Your New Password
                                    </label>
                                    <input type="password" name="pass2" id="pass2" size="16" value="" class="settings-input small password-entry-confirm" spellcheck="false" autocomplete="off">

                                    <div id="pass-strength-result"></div>

                                    <div class="submit">
                                        <input type="submit" name="submit" id="submit" value="Save Changes" class="auto">
                                    </div>
{{--                                    <input type="hidden" id="_wpnonce" name="_wpnonce" value="f1b06717f7">--}}
{{--                                    <input type="hidden" name="_wp_http_referer" value="/woffice/business/members/demo/settings/">--}}
                                </form>
                            </div>
                            <!-- #item-body -->
                        </div>
                    </div>
                    <!-- // .bp-wrap -->
                </div>
                <!-- #buddypress -->
            </article>
        </div>

    </div>
@endsection
