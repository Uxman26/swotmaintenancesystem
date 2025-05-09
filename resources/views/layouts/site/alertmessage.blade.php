@if (Session::has('flash_success'))
    <div id="woffice-alerts-wrapper">
        <div id="woffice-alert" class="woffice-main-alert clearfix woffice-alert-success no-timeout">
            <div class="container">
                <p>
                    <i class="fa fa-check-circle"></i>
                    @foreach (Session::get('flash_success') as $msg)
                        {{ $msg }}<br/>
                    @endforeach
                </p>
                <a href="javascript:void(0)" class="woffice-alert-close float-right">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </div>
    </div>
@endif

@if (Session::has('flash_info'))
    <div id="woffice-alerts-wrapper">
        <div id="woffice-alert" class="woffice-main-alert clearfix woffice-alert-success no-timeout">
            <div class="container">
                <p>
                    <i class="fa fa-check-circle"></i>
                    @foreach (Session::get('flash_info') as $msg)
                        {{ $msg }}<br/>
                    @endforeach
                </p>
                <a href="javascript:void(0)" class="woffice-alert-close float-right">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </div>
    </div>
@endif

@if (Session::has('flash_warning'))
    <div id="woffice-alerts-wrapper">
        <div id="woffice-alert" class="woffice-main-alert clearfix woffice-alert-error no-timeout">
            <div class="container">
                <p>
                    <i class="fa fa-exclamation-circle"></i>
                    @foreach (Session::get('flash_warning') as $msg)
                        {{ $msg }}<br/>
                    @endforeach
                </p>
                <a href="javascript:void(0)" class="woffice-alert-close float-right">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </div>
    </div>
@endif

@if (Session::has('flash_error'))
    <div id="woffice-alerts-wrapper">
        <div id="woffice-alert" class="woffice-main-alert clearfix woffice-alert-error no-timeout">
            <div class="container">
                <p>
                    <i class="fa fa-exclamation-circle"></i>
                    @foreach (Session::get('flash_error') as $msg)
                        {{ $msg }}<br/>
                    @endforeach
                </p>
                <a href="javascript:void(0)" class="woffice-alert-close float-right">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </div>
    </div>
@endif

@if( $errors->any())
    <div id="woffice-alerts-wrapper">
        <div id="woffice-alert" class="woffice-main-alert clearfix woffice-alert-error no-timeout">
            <div class="container">
                <p>
                    <i class="fa fa-exclamation-circle"></i>
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br/>
                    @endforeach
                </p>
                <a href="javascript:void(0)" class="woffice-alert-close float-right">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </div>
    </div>
@endif

