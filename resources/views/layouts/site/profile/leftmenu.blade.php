<div class="col-md-4" data-template="woffice">
    <div id="woffice-bp-sidebar" data-template="woffice">
        <div id="item-header" role="complementary" data-bp-item-id="3" data-bp-item-component="members" class="users-header single-headers">
            <div id="item-header-avatar">
                <a href="{{ route('profile.view') }}">
                    <img src="./storage/{{ Auth::user()->avatar }}"
                         class="avatar user-3-avatar avatar-150 photo"
                         width="150" height="150" alt="Profile picture of Oliver Queen">
                </a>
            </div>

            <!-- #item-header-avatar -->
            <div id="item-header-content">
                <h2 class="user-nicename">{{ Auth::user()->name }}</h2>
                <div class="item-meta">
                    <span class="activity">
                        active 3 minutes ago
                    </span>
                </div>
                <!-- #item-meta -->
{{--                <div class="member-header-actions action">--}}
{{--                    <ul class="woffice-member-social list-inline text-center h4">--}}
{{--                        <li class="list-inline-item">--}}
{{--                            <a href="http://www.facebook.com" title="Facebook URL" target="_blank">--}}
{{--                                <i class="fab fa-facebook"></i>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="list-inline-item">--}}
{{--                            <a href="https://twitter.com" title="Twitter URL" target="_blank">--}}
{{--                                <i class="fab fa-twitter"></i>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="list-inline-item">--}}
{{--                            <a href="http://www.linkedin.com" title="Linkedin URL" target="_blank">--}}
{{--                                <i class="fab fa-linkedin"></i>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="list-inline-item">--}}
{{--                            <a href="http://www.slack.com" title="Slack URL" target="_blank">--}}
{{--                                <i class="fab fa-slack"></i>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="list-inline-item">--}}
{{--                            <a href="http://www.google.com" title="Google URL" target="_blank">--}}
{{--                                <i class="fab fa-google-plus"></i>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="list-inline-item">--}}
{{--                            <a href="http://www.github.com" title="Github URL" target="_blank">--}}
{{--                                <i class="fab fa-github"></i>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="list-inline-item">--}}
{{--                            <a href="http://www.instagram.com" title="Instagram URL" target="_blank">--}}
{{--                                <i class="fab fa-instagram"></i>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
            </div>
            <!-- #item-header-content -->

        </div>

        <!-- #item-header -->
        <nav class="main-navs no-ajax bp-navs single-screen-navs horizontal users-nav" id="object-nav" role="navigation" aria-label="Member menu">
            <ul>
{{--                <li id="activity-personal-li" class="bp-personal-tab">--}}
{{--                    <a href="https://demos.alkalab.com/woffice/business/members/demo/activity/" id="user-activity">--}}
{{--                        Activity--}}
{{--                    </a>--}}
{{--                </li>--}}

                <li id="xprofile-personal-li" class="bp-personal-tab {{ in_array(url()->current(), array(route('profile.view'), route('profile.edit'), route('profile.change_avatar')))?'current selected':'' }}">
                    <a href="{{ route('profile.view') }}" id="user-xprofile">
                        Profile
                    </a>
                </li>

                <li id="xprofile-invoice-li" class="bp-personal-tab {{ in_array(url()->current(), array(route('invoice.view')))?'current selected':'' }}">
                    <a href="{{ route('invoice.view') }}" id="user-invoice">
                        Invoices
                    </a>
                </li>

{{--                <li id="calendar-personal-li" class="bp-personal-tab">--}}
{{--                    <a href="https://demos.alkalab.com/woffice/business/members/demo/calendar/" id="user-calendar">--}}
{{--                        Calendar--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li id="notifications-personal-li" class="bp-personal-tab">--}}
{{--                    <a href="https://demos.alkalab.com/woffice/business/members/demo/notifications/" id="user-notifications">--}}
{{--                        Notifications--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li id="messages-personal-li" class="bp-personal-tab">--}}
{{--                    <a href="https://demos.alkalab.com/woffice/business/members/demo/messages/" id="user-messages">--}}
{{--                        Messages--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li id="friends-personal-li" class="bp-personal-tab">--}}
{{--                    <a href="https://demos.alkalab.com/woffice/business/members/demo/friends/" id="user-friends">--}}
{{--                        Friends--}}
{{--                        <span class="count">2</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li id="groups-personal-li" class="bp-personal-tab">--}}
{{--                    <a href="https://demos.alkalab.com/woffice/business/members/demo/groups/" id="user-groups">--}}
{{--                        Groups--}}
{{--                        <span class="count">4</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li id="forums-personal-li" class="bp-personal-tab">--}}
{{--                    <a href="https://demos.alkalab.com/woffice/business/members/demo/forums/" id="user-forums">--}}
{{--                        Forums--}}
{{--                    </a>--}}
{{--                </li>--}}

                <li id="settings-personal-li" class="bp-personal-tab {{ url()->current()== route('profile.settings')?'current selected':'' }}">
                    <a href="{{ route('profile.settings') }}" id="user-settings">
                        Settings
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
