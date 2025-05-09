@extends('layouts.site.app')

@section('content')
    <header id="featuredbox" class="centered ">
        <div class="pagetitle animate-me fadeIn">
            <h1 class="entry-title">Contact us</h1>
        </div>
        <!-- .pagetitle -->
        <div class="featured-background"
             style="background-image: url(./site/theme/wp-content/uploads/2016/12/MAIN.jpg)" ;="">
            <div class="featured-layer d-block"></div>
        </div>
    </header>

    <!-- START THE CONTENT CONTAINER -->
    <div id="content-container">

        <!-- START CONTENT -->
        <div id="content">
            <article id="post-827" class="box content entry-content post-827 page type-page status-publish">
                <div class="intern-padding clearfix">
                    <div class="fw-page-builder-content">
                        <section class="fw-main-row ">
                            <div class="fw-container">
{{--                                <div class="fw-row">--}}
{{--                                    <div class="fw-col-xs-12 ">--}}
{{--                                        <div class="heading">--}}
{{--                                            <h3>--}}
{{--                                                Just a simple form as an example--}}
{{--                                            </h3>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="fw-row">--}}
{{--                                    <div class="fw-col-xs-12 ">--}}
{{--                                        <p>--}}
{{--                                            You can create as many form as you want. With custom fields, captcha, messages, custom emails and much more!--}}
{{--                                            <br>--}}
{{--                                            <strong>All included with Woffice!</strong>--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="fw-row">
                                    <div class="fw-col-xs-12 ">

{{--                                        <div role="form" class="wpcf7" id="wpcf7-f2030-p827-o1" lang="en-US" dir="ltr">--}}
{{--                                            <div class="screen-reader-response">--}}

{{--                                            </div>--}}
                                            <form action="" method="post" class="wpcf7-form" novalidate="novalidate">
                                                @csrf
                                                @if(session('success'))
                                                    <div class="alert alert-success">
                                                        {{ session('success') }}
                                                    </div>
                                                @endif

                                                @if(session('error'))
                                                    <div class="alert alert-danger">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif
                                                <p>
                                                    <label>
                                                        Your Name (required)
                                                        <br>
                                                        <span class="wpcf7-form-control-wrap your-name">
                                                            <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
                                                        </span>
                                                    </label>
                                                </p>
                                                <p>
                                                    <label> Your Email (required)
                                                        <br>
                                                        <span class="wpcf7-form-control-wrap your-email">
                                                            <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false">
                                                        </span>
                                                    </label>
                                                </p>
                                                <p>
                                                    <label> Subject
                                                        <br>
                                                        <span class="wpcf7-form-control-wrap your-subject">
                                                            <input type="text" id="subject" name="subject" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false">
                                                        </span>
                                                    </label>
                                                </p>
                                                <p>
                                                    <label> Your Message
                                                        <br>
                                                        <span class="wpcf7-form-control-wrap your-message">
                                                            <textarea id="message" name="message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"></textarea>
                                                        </span>
                                                    </label>
                                                </p>
                                                <p>
                                                    <input type="submit" value="Send" class="wpcf7-submit">
{{--                                                    <span class="ajax-loader">--}}
{{--                                                    </span>--}}
                                                </p>
{{--                                                <div class="wpcf7-response-output wpcf7-display-none">--}}
{{--                                                </div>--}}
                                            </form>

{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </article>
        </div>
    </div>
    <!-- END #content-container -->
@endsection