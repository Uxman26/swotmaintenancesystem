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

{{--                                @include('layouts.site.profile.rightmenu')--}}

                                <div class="profile public">
                                    <h2 class="screen-heading view-profile-screen">View Invoice</h2>
                                    <div class="bp-widget base">
{{--                                        <h3 class="screen-heading profile-group-title">--}}
{{--                                            Base--}}
{{--                                        </h3>--}}
                                        <table class="profile-fields bp-tables-user">
                                            <thead>
                                                <tr>
                                                    <td width="80%">
                                                        Invoice Number
                                                    </td>
                                                    <td>
                                                        Total
                                                    </td>
                                                    <td>
                                                        Status
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach( $invoices as $invoice )
                                                <tr class="field_1 field_name required-field visibility-public field_type_textbox">
                                                    <td class="label">
                                                        @if( $invoice->online_invoice_url != null )
                                                        <a href="{{ $invoice->online_invoice_url }}" target="_blank">
                                                            {{ $invoice->invoice_number }}
                                                        </a>
                                                        @else
                                                            {{ $invoice->invoice_number }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <p>{{ $invoice->total }}</p>
                                                    </td>
                                                    <td class="data">
                                                        <p>{{ \App\Invoice::getStatusName($invoice->status) }}</p>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <br/>


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