<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- MAKE IT RESPONSIVE -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="generator" content="WordPress 5.2.3" />
        <meta name="generator" content="Powered by Slider Revolution 5.4.8.3 - responsive, Mobile-Friendly Slider Plugin for WordPress with comfortable drag and drop interface." />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>SWOT &#8211; Your Digital Marketing Partner</title>

        <link rel="icon" href="{{ asset('site/images/cropped-logo-32x32.png') }}">

        @include('layouts.site.headscript')
        @section('header') @show
    </head>


    <!-- START BODY -->
    <body class="home-page bp-nouveau home page-template page-template-page-templates page-template-dashboard page-template-page-templatesdashboard-php page page-id-22 logged-in menu-is-vertical has_fixed_navbar woffice-2-5  woffice-chat-disabled no-js">

        <div id="page-wrapper" >

            <!-- STARTING THE MAIN NAVIGATION (left side) -->
            @include('layouts.site.mainnavigation')
            <!-- END MAIN NAVIGATION -->

            <!-- START HEADER -->
            @include('layouts.site.header')
            <!-- END NAVBAR -->

            <!-- STARTING THE SIDEBAR (right side) + content behind -->

            <!-- START CONTENT -->
            <section id="main-content" class="with-sidebar  hentry">

                <!-- RIGHT SIDE -> SIDEBAR-->
                @include('layouts.site.rightsidebar')
                <!-- END SIDEBAR -->

                <div id="left-content">

                    <!-- START THE CONTENT CONTAINER -->
                    @section('content') @show
                    <!-- END #content-container -->

                    <!--SCROLL TOP-->
                    <div id="scroll-top-container">
                        <a href="#main-header" id="scroll-top">
                            <i class="fa fa-arrow-circle-up"></i>
                        </a>
                    </div>

                </div>
                <!-- END #left-content -->

                <a href="javascript:void(0)" id="can-scroll">
                    <i class="fa fa-angle-double-down">
                    </i>
                </a>

                <div class="woffice-modal modal fade" id="woffice-time-tracking-meta">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-group">
                                    <h3>
                                        What are you working on?
                                    </h3>
                                    <input type="text" class="form-control" name="woffice-time-tracking-meta">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-secondary mr-2" data-dismiss="modal">
                                    Close
                                </button>
                                <a href="#"
                                   data-action="start"
                                   class="btn btn-default woffice-time-tracking-state-toggle">
                                    <i class="fa fa-play"></i> Go!
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!-- END CONTENT -->
            <!-- START FOOTER -->
            @include('layouts.site.footer')
            <!-- END FOOTER -->
        </div>

        @include('layouts.site.footscript')
    </body>
    <!-- END BODY -->
</html>