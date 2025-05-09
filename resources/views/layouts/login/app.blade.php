<html lang="en-US" style="margin-top: 0 !important;">
    <head>
        <meta charset="UTF-8">
        <!-- MAKE IT RESPONSIVE -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="icon" href="./site/images/cropped-logo-32x32.png">

        @include('layouts.login.headscript')
        @section('header') @show
    </head>

    <body class="bp-nouveau page-template page-template-page-templates page-template-login page-template-page-templateslogin-php page page-id-4 layout-1 woffice-2-5 woffice-chat-disabled no-js">
        <div id="page-wrapper">
            <div id="content-container">
                <!-- START CONTENT -->
                @section('content') @show
                <!-- END CONTENT -->
            </div>
        </div>

        @include('layouts.site.footscript')
    </body>
</html>
