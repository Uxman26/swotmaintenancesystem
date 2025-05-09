<!-- START HEADER -->
<header id="main-header" class=" has-user ">
    <nav id="navbar" class="has_fixed_navbar">
        <div id="nav-left">
            <!-- NAVIGATION TOGGLE -->
            <a href="javascript:void(0)" id="nav-trigger">
                <i class="fa fa-arrow-left"></i>
            </a>

            <!-- START LOGO -->
            <div id="nav-logo">
                <a href="https://demos.alkalab.com/woffice/business/">
                    <img src="{{ asset('site/images/logo.png') }}"
                         alt="Logo Image">
                </a>
            </div>

            <!-- USER INFORMATIONS -->
            <div id="nav-user" class="clearfix bp_is_active">
                <a href="javascript:void(0);" id="user-thumb">
                    Hi
                    <strong class="font-weight-bold">
                        {{ Auth::user()->name }}
                    </strong>!
                    <img alt='' src='{{ asset('storage/' . Auth::user()->avatar  ) }}'
                         srcset='{{ asset('storage/' . Auth::user()->avatar  ) }}'
                         class='avatar avatar-96 photo' height='96' width='96' />
                </a>
                <a href="javascript:void(0)" id="user-close">
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- EXTRA BUTTONS ABOVE THE SIDBAR -->
        <div id="nav-buttons">
            <!-- SIDEBAR TOGGLE -->
            <a href="javascript:void(0)" id="nav-sidebar-trigger">
                <i class="fa fa-arrow-right"></i>
            </a>

{{--            <!-- SEACRH FORM -->--}}
{{--            <a href="javascript:void(0)" id="search-trigger">--}}
{{--                <i class="fa fa-search"></i>--}}
{{--            </a>--}}

            <a href="javascript:void(0)" id="nav-notification-trigger-swot" title="View your notifications" class="">
                <i class="fa fa-bell"></i>
            </a>
        </div>
    </nav>
    <!-- HIDDEN PARTS TRIGGERED BY JAVASCRIPT -->

    <!-- START USER LINKS - WAITING FOR FIRING -->
    <div id="user-sidebar">
        <header id="user-cover">
            <a href="#" class="clearfix">
                <img alt='' src='{{ asset('storage/' . Auth::user()->avatar  ) }}'
                     srcset='{{ asset('storage/' . Auth::user()->avatar  ) }}'
                     class='avatar avatar-96 photo' height='96' width='96' />
                <span>
                    Welcome
                    <span class="woffice-welcome">
                        
                    </span>
                </span>
            </a>
            <div class="user-cover-layer">

            </div>
        </header>

        <nav>
            <ul id="menu-bp" class="menu">

                <li id="xprofile-personal-li" class="menu-parent">
                    <a href="">
                        Profile
                    </a>
                    <ul class="sub-menu">
                        <li id="public-personal-li" class="menu-child">
                            <a href="">
                                View
                            </a>
                        </li>
                        <li id="edit-personal-li" class="menu-child">
                            <a href="">
                                Edit
                            </a>
                        </li>
                        <li id="change-avatar-personal-li" class="menu-child">
                            <a href="">
                                Change Profile Photo
                            </a>
                        </li></ul>
                </li>



                <li id="xprofile-invoice-li" >
                    <a href="" >
                        Invoices
                    </a>
                </li>

                <li id="settings-personal-li" class="menu-parent">
                    <a href="">
                        Settings
                    </a>
                    <ul class="sub-menu">
                        <li id="general-personal-li" class="menu-child">
                            <a href="">
                                General
                            </a>
                        </li>

                    </ul>
                </li>
                <li id="logout-li">
                    <a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Log Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>

    <div id="woffice-notifications-menu" style="width: 40%;">
        <div id="woffice-notifications-content">
            {{-- @if( count($notifications) == 0 )
                <p class="woffice-notification-empty">
                    You have <b>0</b> unread notifications.
                </p>
            @else
                <div style="font-size: 10px">
                @foreach( $notifications as $notification)
                    {!! $notification->getNotificationDetails() !!}<br/>
                @endforeach
                <br/>
                You have <b>{{ count($notifications) }}</b> unread notifications.
                </div>
            @endif --}}
        </div>
    </div>
    <!-- START SEARCH CONTAINER - WAITING FOR FIRING -->
    <div id="main-search">
        <div class="container">
            <form role="search" method="get" action="https://demos.alkalab.com/woffice/business/" >
                <input type="text" value="" name="s" id="s" placeholder="Search..."/>
                <input type="hidden" name="searchsubmit" id="searchsubmit" value="true" />
                <button type="submit" name="searchsubmit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    @if( isset($message) && $message == "changes saved")
    <div id="woffice-alerts-wrapper">
        <div id="woffice-alert-5d9307387c4a9" class="woffice-main-alert clearfix woffice-alert-success no-timeout">
            <div class="container">
                <p>
                    <i class="fa fa-check-circle"></i>
                    Changes saved.
                </p>
                <a href="javascript:void(0)" class="woffice-alert-close float-right">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </div>
    </div>
    @endif

    @include('layouts.site.alertmessage')

</header>
<!-- END NAVBAR -->
