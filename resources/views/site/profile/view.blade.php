@extends('layouts.site.app')

@section('content')
    @include('layouts.site.featurebox')

    <!-- START THE CONTENT CONTAINER -->
    <div id="content-container">

        <!-- START CONTENT -->
        <div id="content">
            <article id="post-0" class="bp_members type-bp_members post-0 page type-page status-publish">
                <div id="buddypress" class="buddypress-wrap bp-dir-hori-nav">
                    <div class="bp-wrap row woffice-profile--vertical" data-template="woffice">

                        @include('layouts.site.profile.leftmenu')

                        <div class="col-md-8" data-template="woffice">
                            <div id="item-body" class="item-body">

                                @include('layouts.site.profile.rightmenu')

                                <div class="profile public">
                                    <h2 class="screen-heading view-profile-screen">View Profile</h2>
                                    <div class="bp-widget base">
                                        <h3 class="screen-heading profile-group-title">
                                            Base
                                        </h3>
                                        <table class="profile-fields bp-tables-user">
                                            <tbody>
                                                <tr class="field_1 field_name required-field visibility-public field_type_textbox">
                                                    <td class="label">
                                                        Name
                                                    </td>
                                                    <td class="data">
                                                        <p>{{ Auth::user()->name }}</p>
                                                    </td>
                                                </tr>

                                                <tr class="field_1 field_name required-field visibility-public field_type_textbox alt">
                                                    <td class="label">
                                                        Email
                                                    </td>
                                                    <td class="data">
                                                        <p>{{ Auth::user()->email }}</p>
                                                    </td>
                                                </tr>

                                                <tr class="field_1 field_name required-field visibility-public field_type_textbox">
                                                    <td class="label">
                                                        Last Updated
                                                    </td>
                                                    <td class="data">
                                                        <p>{{ Auth::user()->updated_at }}</p>
                                                    </td>
                                                </tr>

                                                <tr class="field_1 field_name required-field visibility-public field_type_textbox alt">
                                                    <td class="label">
                                                        Created At
                                                    </td>
                                                    <td class="data">
                                                        <p>{{ Auth::user()->created_at }}</p>
                                                    </td>
                                                </tr>

{{--                                                <tr class="field_10 field_birthday optional-field visibility-loggedin alt field_type_datebox">--}}
{{--                                                    <td class="label">--}}
{{--                                                        Birthday--}}
{{--                                                    </td>--}}
{{--                                                    <td class="data">--}}
{{--                                                        <p>1973-12-24</p>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--    --}}
{{--                                                <tr class="field_8262 field_profession optional-field visibility-public field_type_selectbox">--}}
{{--                                                    <td class="label">--}}
{{--                                                        Profession--}}
{{--                                                    </td>--}}
{{--    --}}
{{--                                                    <td class="data">--}}
{{--                                                        <p>--}}
{{--                                                            <a href="https://demos.alkalab.com/woffice/business/members/?members_search=Marketing+consultant" rel="nofollow">--}}
{{--                                                                Marketing consultant--}}
{{--                                                            </a>--}}
{{--                                                        </p>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
                                            </tbody>
                                        </table>
                                    </div>
                                    <br/>

                                    <div class="bp-widget xero-info">
                                        <h3 class="screen-heading profile-group-title">
                                            Xero Info
                                        </h3>
                                        <table class="profile-fields bp-tables-user">
                                            <tbody>
                                            @if( isset($contact->first_name) )
                                            <tr class="field_1 field_name required-field visibility-public field_type_textbox">
                                                <td class="label">
                                                    First Name
                                                </td>
                                                <td class="data">
                                                    <p>{{ $contact->first_name }}</p>
                                                </td>
                                            </tr>
                                            @endif

                                            @if( isset( $contact->last_name ) )
                                            <tr class="field_1 field_name required-field visibility-public field_type_textbox">
                                                <td class="label">
                                                    Last Name
                                                </td>
                                                <td class="data">
                                                    <p>{{ $contact->last_name }}</p>
                                                </td>
                                            </tr>
                                            @endif

                                            @foreach( $phones as $phone )
                                            <tr class="field_1 field_name required-field visibility-public field_type_textbox">
                                                <td class="label">
                                                    {{ App\Phone::getPhoneTypeName($phone->phone_type) }}
                                                </td>
                                                <td class="data">
                                                    <p>{{ $phone->phone_country_code . $phone->phone_area_code . $phone->phone_number }}</p>
                                                </td>
                                            </tr>
                                            @endforeach

                                            @foreach( $addresses as $address )
                                            <tr class="field_1 field_name required-field visibility-public field_type_textbox">
                                                <td class="label">
                                                    {{ App\Address::getAddressTypeName($address->address_type) }}
                                                </td>
                                                <td class="data">
                                                    <p>
                                                        {{ $address->address_line_1 }}<br/>
                                                        {{ $address->address_line_2 }}<br/>
                                                        {{ $address->address_line_3 }}<br/>
                                                        {{ $address->address_line_4 }}<br/>
                                                    </p>
                                                </td>
                                            </tr>
                                            @endforeach

                                            {{--                                                <tr class="field_10 field_birthday optional-field visibility-loggedin alt field_type_datebox">--}}
                                            {{--                                                    <td class="label">--}}
                                            {{--                                                        Birthday--}}
                                            {{--                                                    </td>--}}
                                            {{--                                                    <td class="data">--}}
                                            {{--                                                        <p>1973-12-24</p>--}}
                                            {{--                                                    </td>--}}
                                            {{--                                                </tr>--}}
                                            {{--    --}}
                                            {{--                                                <tr class="field_8262 field_profession optional-field visibility-public field_type_selectbox">--}}
                                            {{--                                                    <td class="label">--}}
                                            {{--                                                        Profession--}}
                                            {{--                                                    </td>--}}
                                            {{--    --}}
                                            {{--                                                    <td class="data">--}}
                                            {{--                                                        <p>--}}
                                            {{--                                                            <a href="https://demos.alkalab.com/woffice/business/members/?members_search=Marketing+consultant" rel="nofollow">--}}
                                            {{--                                                                Marketing consultant--}}
                                            {{--                                                            </a>--}}
                                            {{--                                                        </p>--}}
                                            {{--                                                    </td>--}}
                                            {{--                                                </tr>--}}
                                            </tbody>
                                        </table>
                                    </div>

{{--                                    <div class="bp-widget social">--}}
{{--                                        <h3 class="screen-heading profile-group-title">--}}
{{--                                            Social--}}
{{--                                        </h3>--}}

{{--                                        <table class="profile-fields bp-tables-user">--}}
{{--                                            <tbody>--}}
{{--                                            <tr class="field_2 field_location optional-field visibility-adminsonly field_type_textbox">--}}
{{--                                                <td class="label">--}}
{{--                                                    Location--}}
{{--                                                </td>--}}
{{--                                                <td class="data">--}}
{{--                                                    <p>Paris, France</p>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}

{{--                                            <tr class="field_3 field_facebook optional-field visibility-adminsonly alt field_type_textbox">--}}
{{--                                                <td class="label">Facebook</td>--}}
{{--                                                <td class="data">--}}
{{--                                                    <p>--}}
{{--                                                        <a href="http://www.facebook.com" rel="nofollow">--}}
{{--                                                            http://www.facebook.com--}}
{{--                                                        </a>--}}
{{--                                                    </p>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}

{{--                                            <tr class="field_4 field_twitter optional-field visibility-adminsonly field_type_textbox">--}}
{{--                                                <td class="label">Twitter</td>--}}
{{--                                                <td class="data">--}}
{{--                                                    <p>--}}
{{--                                                        <a href="https://twitter.com" rel="nofollow">--}}
{{--                                                            https://twitter.com--}}
{{--                                                        </a>--}}
{{--                                                    </p>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}

{{--                                            <tr class="field_5 field_linkedin optional-field visibility-adminsonly alt field_type_textbox">--}}
{{--                                                <td class="label">Linkedin</td>--}}
{{--                                                <td class="data">--}}
{{--                                                    <p>--}}
{{--                                                        <a href="http://www.linkedin.com" rel="nofollow">--}}
{{--                                                            http://www.linkedin.com--}}
{{--                                                        </a>--}}
{{--                                                    </p>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}

{{--                                            <tr class="field_6 field_slack optional-field visibility-adminsonly field_type_textbox">--}}
{{--                                                <td class="label">Slack</td>--}}
{{--                                                <td class="data">--}}
{{--                                                    <p>--}}
{{--                                                        <a href="http://www.slack.com" rel="nofollow">--}}
{{--                                                            http://www.slack.com--}}
{{--                                                        </a>--}}
{{--                                                    </p>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}

{{--                                            <tr class="field_7 field_google optional-field visibility-adminsonly alt field_type_textbox">--}}
{{--                                                <td class="label">Google</td>--}}
{{--                                                <td class="data">--}}
{{--                                                    <p>--}}
{{--                                                        <a href="http://www.google.com" rel="nofollow">--}}
{{--                                                            http://www.google.com--}}
{{--                                                        </a>--}}
{{--                                                    </p>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}

{{--                                            <tr class="field_8 field_github optional-field visibility-adminsonly field_type_textbox">--}}
{{--                                                <td class="label">Github</td>--}}
{{--                                                <td class="data">--}}
{{--                                                    <p>--}}
{{--                                                        <a href="http://www.github.com" rel="nofollow">--}}
{{--                                                            http://www.github.com--}}
{{--                                                        </a>--}}
{{--                                                    </p>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}

{{--                                            <tr class="field_9 field_instagram optional-field visibility-adminsonly alt field_type_textbox">--}}
{{--                                                <td class="label">Instagram</td>--}}
{{--                                                <td class="data">--}}
{{--                                                    <p>--}}
{{--                                                        <a href="http://www.instagram.com" rel="nofollow">--}}
{{--                                                            http://www.instagram.com--}}
{{--                                                        </a>--}}
{{--                                                    </p>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            </tbody>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
                                </div>
                                <!-- .profile -->
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