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

                                @include('layouts.site.profile.rightmenu')

                                <div class="profile edit">
                                    <h2 class="screen-heading edit-profile-screen">Edit Profile</h2>

                                    <form action="{{ route('profile.edit.post') }}" method="post" id="profile-edit-form" class="standard-form profile-edit base">
                                        @csrf
{{--                                        <ul class="button-tabs button-nav">--}}
{{--                                            <li class="current">--}}
{{--                                                <a href="https://demos.alkalab.com/woffice/business/members/demo/profile/edit/group/1/">--}}
{{--                                                    Base--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                            <li>--}}
{{--                                                <a href="https://demos.alkalab.com/woffice/business/members/demo/profile/edit/group/2/">--}}
{{--                                                    Social--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}

{{--                                        <h3 class="screen-heading profile-group-title edit">--}}
{{--                                            Editing "Base" Profile Group--}}
{{--                                        </h3>--}}

                                        <div class="editfield field_1 field_name required-field visibility-public field_type_textbox">
                                            <fieldset>
                                                <legend id="field_1-1">
                                                    Name
                                                    <span class="bp-required-field-label">(required)</span>
                                                </legend>

                                                <input id="name" name="name" type="text" value="{{ Auth::user()->name }}"
                                                       aria-required="true"
                                                       required=""
                                                       aria-labelledby="field_1-1"
                                                       aria-describedby="field_1-3">

                                                <p class="field-visibility-settings-notoggle field-visibility-settings-header" id="field-visibility-settings-toggle-1">
                                                    This field may be seen by:
                                                    <span class="current-visibility-level">Everyone</span>
                                                </p>
                                            </fieldset>
                                        </div>

                                        <!--birthday-->
{{--                                        <div class="editfield field_10 field_birthday optional-field visibility-loggedin alt field_type_datebox">--}}
{{--                                            <fieldset>--}}
{{--                                                <legend>--}}
{{--                                                    Birthday--}}
{{--                                                </legend>--}}

{{--                                                <p class="description" tabindex="0">--}}
{{--                                                    We will only use it for the Birthday widget, so we can celebrate everyones birthday.--}}
{{--                                                </p>--}}

{{--                                                <div class="input-options datebox-selects">--}}
{{--                                                    <label for="field_10_day" class="xprofile-field-label">--}}
{{--                                                        Day--}}
{{--                                                    </label>--}}
{{--                                                    <select id="field_10_day" name="field_10_day">--}}
{{--                                                        <option value="">----</option>--}}
{{--                                                        <option value="1">1</option>--}}
{{--                                                        <option value="2">2</option>--}}
{{--                                                        <option value="3">3</option>--}}
{{--                                                        <option value="4">4</option>--}}
{{--                                                        <option value="5">5</option>--}}
{{--                                                        <option value="6">6</option>--}}
{{--                                                        <option value="7">7</option>--}}
{{--                                                        <option value="8">8</option>--}}
{{--                                                        <option value="9">9</option>--}}
{{--                                                        <option value="10">10</option>--}}
{{--                                                        <option value="11">11</option>--}}
{{--                                                        <option value="12">12</option>--}}
{{--                                                        <option value="13">13</option>--}}
{{--                                                        <option value="14">14</option>--}}
{{--                                                        <option value="15">15</option>--}}
{{--                                                        <option value="16">16</option>--}}
{{--                                                        <option value="17">17</option>--}}
{{--                                                        <option value="18">18</option>--}}
{{--                                                        <option value="19">19</option>--}}
{{--                                                        <option value="20">20</option>--}}
{{--                                                        <option value="21">21</option>--}}
{{--                                                        <option value="22">22</option>--}}
{{--                                                        <option value="23">23</option>--}}
{{--                                                        <option value="24" selected="selected">24</option>--}}
{{--                                                        <option value="25">25</option>--}}
{{--                                                        <option value="26">26</option>--}}
{{--                                                        <option value="27">27</option>--}}
{{--                                                        <option value="28">28</option>--}}
{{--                                                        <option value="29">29</option>--}}
{{--                                                        <option value="30">30</option>--}}
{{--                                                        <option value="31">31</option>--}}
{{--                                                    </select>--}}

{{--                                                    <label for="field_10_month" class="xprofile-field-label">--}}
{{--                                                        Month--}}
{{--                                                    </label>--}}
{{--                                                    <select id="field_10_month" name="field_10_month">--}}
{{--                                                        <option value="">----</option>--}}
{{--                                                        <option value="January">January</option>--}}
{{--                                                        <option value="February">February</option>--}}
{{--                                                        <option value="March">March</option>--}}
{{--                                                        <option value="April">April</option>--}}
{{--                                                        <option value="May">May</option>--}}
{{--                                                        <option value="June">June</option>--}}
{{--                                                        <option value="July">July</option>--}}
{{--                                                        <option value="August">August</option>--}}
{{--                                                        <option value="September">September</option>--}}
{{--                                                        <option value="October">October</option>--}}
{{--                                                        <option value="November">November</option>--}}
{{--                                                        <option value="December" selected="selected">December</option>--}}
{{--                                                    </select>--}}

{{--                                                    <label for="field_10_year" class="xprofile-field-label">Year</label>--}}
{{--                                                    <select id="field_10_year" name="field_10_year">--}}
{{--                                                        <option value="">----</option>--}}
{{--                                                        <option value="2019">2019</option>--}}
{{--                                                        <option value="2018">2018</option>--}}
{{--                                                        <option value="2017">2017</option>--}}
{{--                                                        <option value="2016">2016</option>--}}
{{--                                                        <option value="2015">2015</option>--}}
{{--                                                        <option value="2014">2014</option>--}}
{{--                                                        <option value="2013">2013</option>--}}
{{--                                                        <option value="2012">2012</option>--}}
{{--                                                        <option value="2011">2011</option>--}}
{{--                                                        <option value="2010">2010</option>--}}
{{--                                                        <option value="2009">2009</option>--}}
{{--                                                        <option value="2008">2008</option>--}}
{{--                                                        <option value="2007">2007</option>--}}
{{--                                                        <option value="2006">2006</option>--}}
{{--                                                        <option value="2005">2005</option>--}}
{{--                                                        <option value="2004">2004</option>--}}
{{--                                                        <option value="2003">2003</option>--}}
{{--                                                        <option value="2002">2002</option>--}}
{{--                                                        <option value="2001">2001</option>--}}
{{--                                                        <option value="2000">2000</option>--}}
{{--                                                        <option value="1999">1999</option>--}}
{{--                                                        <option value="1998">1998</option>--}}
{{--                                                        <option value="1997">1997</option>--}}
{{--                                                        <option value="1996">1996</option>--}}
{{--                                                        <option value="1995">1995</option>--}}
{{--                                                        <option value="1994">1994</option>--}}
{{--                                                        <option value="1993">1993</option>--}}
{{--                                                        <option value="1992">1992</option>--}}
{{--                                                        <option value="1991">1991</option>--}}
{{--                                                        <option value="1990">1990</option>--}}
{{--                                                        <option value="1989">1989</option>--}}
{{--                                                        <option value="1988">1988</option>--}}
{{--                                                        <option value="1987">1987</option>--}}
{{--                                                        <option value="1986">1986</option>--}}
{{--                                                        <option value="1985">1985</option>--}}
{{--                                                        <option value="1984">1984</option>--}}
{{--                                                        <option value="1983">1983</option>--}}
{{--                                                        <option value="1982">1982</option>--}}
{{--                                                        <option value="1981">1981</option>--}}
{{--                                                        <option value="1980">1980</option>--}}
{{--                                                        <option value="1979">1979</option>--}}
{{--                                                        <option value="1978">1978</option>--}}
{{--                                                        <option value="1977">1977</option>--}}
{{--                                                        <option value="1976">1976</option>--}}
{{--                                                        <option value="1975">1975</option>--}}
{{--                                                        <option value="1974">1974</option>--}}
{{--                                                        <option value="1973" selected="selected">1973</option>--}}
{{--                                                        <option value="1972">1972</option>--}}
{{--                                                        <option value="1971">1971</option>--}}
{{--                                                        <option value="1970">1970</option>--}}
{{--                                                        <option value="1969">1969</option>--}}
{{--                                                        <option value="1968">1968</option>--}}
{{--                                                        <option value="1967">1967</option>--}}
{{--                                                        <option value="1966">1966</option>--}}
{{--                                                        <option value="1965">1965</option>--}}
{{--                                                        <option value="1964">1964</option>--}}
{{--                                                        <option value="1963">1963</option>--}}
{{--                                                        <option value="1962">1962</option>--}}
{{--                                                        <option value="1961">1961</option>--}}
{{--                                                        <option value="1960">1960</option>--}}
{{--                                                        <option value="1959">1959</option>--}}
{{--                                                        <option value="1958">1958</option>--}}
{{--                                                        <option value="1957">1957</option>--}}
{{--                                                        <option value="1956">1956</option>--}}
{{--                                                        <option value="1955">1955</option>--}}
{{--                                                        <option value="1954">1954</option>--}}
{{--                                                        <option value="1953">1953</option>--}}
{{--                                                        <option value="1952">1952</option>--}}
{{--                                                        <option value="1951">1951</option>--}}
{{--                                                        <option value="1950">1950</option>--}}
{{--                                                        <option value="1949">1949</option>--}}
{{--                                                        <option value="1948">1948</option>--}}
{{--                                                        <option value="1947">1947</option>--}}
{{--                                                        <option value="1946">1946</option>--}}
{{--                                                        <option value="1945">1945</option>--}}
{{--                                                        <option value="1944">1944</option>--}}
{{--                                                        <option value="1943">1943</option>--}}
{{--                                                        <option value="1942">1942</option>--}}
{{--                                                        <option value="1941">1941</option>--}}
{{--                                                        <option value="1940">1940</option>--}}
{{--                                                        <option value="1939">1939</option>--}}
{{--                                                        <option value="1938">1938</option>--}}
{{--                                                        <option value="1937">1937</option>--}}
{{--                                                        <option value="1936">1936</option>--}}
{{--                                                        <option value="1935">1935</option>--}}
{{--                                                        <option value="1934">1934</option>--}}
{{--                                                        <option value="1933">1933</option>--}}
{{--                                                        <option value="1932">1932</option>--}}
{{--                                                        <option value="1931">1931</option>--}}
{{--                                                        <option value="1930">1930</option>--}}
{{--                                                        <option value="1929">1929</option>--}}
{{--                                                        <option value="1928">1928</option>--}}
{{--                                                        <option value="1927">1927</option>--}}
{{--                                                        <option value="1926">1926</option>--}}
{{--                                                        <option value="1925">1925</option>--}}
{{--                                                        <option value="1924">1924</option>--}}
{{--                                                        <option value="1923">1923</option>--}}
{{--                                                        <option value="1922">1922</option>--}}
{{--                                                        <option value="1921">1921</option>--}}
{{--                                                        <option value="1920">1920</option>--}}
{{--                                                        <option value="1919">1919</option>--}}
{{--                                                        <option value="1918">1918</option>--}}
{{--                                                        <option value="1917">1917</option>--}}
{{--                                                        <option value="1916">1916</option>--}}
{{--                                                        <option value="1915">1915</option>--}}
{{--                                                        <option value="1914">1914</option>--}}
{{--                                                        <option value="1913">1913</option>--}}
{{--                                                        <option value="1912">1912</option>--}}
{{--                                                        <option value="1911">1911</option>--}}
{{--                                                        <option value="1910">1910</option>--}}
{{--                                                        <option value="1909">1909</option>--}}
{{--                                                        <option value="1908">1908</option>--}}
{{--                                                        <option value="1907">1907</option>--}}
{{--                                                        <option value="1906">1906</option>--}}
{{--                                                        <option value="1905">1905</option>--}}
{{--                                                        <option value="1904">1904</option>--}}
{{--                                                        <option value="1903">1903</option>--}}
{{--                                                        <option value="1902">1902</option>--}}
{{--                                                        <option value="1901">1901</option>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}

{{--                                                <p class="field-visibility-settings-toggle field-visibility-settings-header" id="field-visibility-settings-toggle-10">--}}
{{--                                                    This field may be seen by:--}}
{{--                                                    <span class="current-visibility-level">All Members</span>--}}
{{--                                                    <button class="visibility-toggle-link text-button" type="button" aria-expanded="false">--}}
{{--                                                        Change--}}
{{--                                                    </button>--}}
{{--                                                </p>--}}

{{--                                                <div class="field-visibility-settings bp-hide" id="field-visibility-settings-10">--}}
{{--                                                    <fieldset>--}}
{{--                                                        <legend>--}}
{{--                                                            Who is allowed to see this field?--}}
{{--                                                        </legend>--}}

{{--                                                        <div class="radio">--}}
{{--                                                            <label for="see-field_10_public">--}}
{{--                                                                <input type="radio" id="see-field_10_public" name="field_10_visibility" value="public">--}}
{{--                                                                <span class="field-visibility-text">Everyone</span>--}}
{{--                                                            </label>--}}

{{--                                                            <label for="see-field_10_adminsonly">--}}
{{--                                                                <input type="radio" id="see-field_10_adminsonly" name="field_10_visibility" value="adminsonly">--}}
{{--                                                                <span class="field-visibility-text">Only Me</span>--}}
{{--                                                            </label>--}}

{{--                                                            <label for="see-field_10_loggedin">--}}
{{--                                                                <input type="radio" id="see-field_10_loggedin" name="field_10_visibility" value="loggedin" checked="checked">--}}
{{--                                                                <span class="field-visibility-text">All Members</span>--}}
{{--                                                            </label>--}}

{{--                                                            <label for="see-field_10_friends">--}}
{{--                                                                <input type="radio" id="see-field_10_friends" name="field_10_visibility" value="friends">--}}
{{--                                                                <span class="field-visibility-text">My Friends</span>--}}
{{--                                                            </label>--}}
{{--                                                        </div>--}}
{{--                                                    </fieldset>--}}
{{--                                                    <button class="field-visibility-settings-close button" type="button">Close</button>--}}
{{--                                                </div>--}}
{{--                                            </fieldset>--}}
{{--                                        </div>--}}

                                        <!--woffice note-->
{{--                                        <div class="editfield field_8261 field_woffice_notes optional-field visibility-public field_type_textarea">--}}
{{--                                            <fieldset>--}}
{{--                                                <legend id="field_8261-1">--}}
{{--                                                    Woffice_Notes--}}
{{--                                                </legend>--}}

{{--                                                <div id="wp-field_8261-wrap" class="wp-core-ui wp-editor-wrap tmce-active">--}}
{{--                                                    <link rel="stylesheet" id="editor-buttons-css" href="https://demos.alkalab.com/woffice/business/wp-includes/css/editor.min.css" type="text/css" media="all">--}}
{{--                                                    <div id="wp-field_8261-editor-tools" class="wp-editor-tools hide-if-no-js">--}}
{{--                                                        <div class="wp-editor-tabs">--}}
{{--                                                            <button type="button" id="field_8261-tmce" class="wp-switch-editor switch-tmce" data-wp-editor-id="field_8261">--}}
{{--                                                                Visual--}}
{{--                                                            </button>--}}
{{--                                                            <button type="button" id="field_8261-html" class="wp-switch-editor switch-html" data-wp-editor-id="field_8261">--}}
{{--                                                                Text--}}
{{--                                                            </button>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div id="wp-field_8261-editor-container" class="wp-editor-container"><div id="qt_field_8261_toolbar" class="quicktags-toolbar"><input type="button" id="qt_field_8261_strong" class="ed_button button button-small" aria-label="Bold" value="b"><input type="button" id="qt_field_8261_em" class="ed_button button button-small" aria-label="Italic" value="i"><input type="button" id="qt_field_8261_link" class="ed_button button button-small" aria-label="Insert link" value="link"><input type="button" id="qt_field_8261_block" class="ed_button button button-small" aria-label="Blockquote" value="b-quote"><input type="button" id="qt_field_8261_del" class="ed_button button button-small" aria-label="Deleted text (strikethrough)" value="del"><input type="button" id="qt_field_8261_ins" class="ed_button button button-small" aria-label="Inserted text" value="ins"><input type="button" id="qt_field_8261_img" class="ed_button button button-small" aria-label="Insert image" value="img"><input type="button" id="qt_field_8261_ul" class="ed_button button button-small" aria-label="Bulleted list" value="ul"><input type="button" id="qt_field_8261_ol" class="ed_button button button-small" aria-label="Numbered list" value="ol"><input type="button" id="qt_field_8261_li" class="ed_button button button-small" aria-label="List item" value="li"><input type="button" id="qt_field_8261_code" class="ed_button button button-small" value="code"><input type="button" id="qt_field_8261_more" class="ed_button button button-small" aria-label="Insert Read More tag" value="more"><input type="button" id="qt_field_8261_close" class="ed_button button button-small" title="Close all open tags" value="close tags"></div><div id="mceu_14" class="mce-tinymce mce-container mce-panel" hidefocus="1" tabindex="-1" role="application" style="visibility: hidden; border-width: 1px; width: 100%;"><div id="mceu_14-body" class="mce-container-body mce-stack-layout"><div id="mceu_15" class="mce-top-part mce-container mce-stack-layout-item mce-first"><div id="mceu_15-body" class="mce-container-body"><div id="mceu_16" class="mce-toolbar-grp mce-container mce-panel mce-first mce-last" hidefocus="1" tabindex="-1" role="group"><div id="mceu_16-body" class="mce-container-body mce-stack-layout"><div id="mceu_17" class="mce-container mce-toolbar mce-stack-layout-item mce-first mce-last" role="toolbar"><div id="mceu_17-body" class="mce-container-body mce-flow-layout"><div id="mceu_18" class="mce-container mce-flow-layout-item mce-first mce-last mce-btn-group" role="group"><div id="mceu_18-body"><div id="mceu_0" class="mce-widget mce-btn mce-first" tabindex="-1" aria-pressed="false" role="button" aria-label="Bold (Ctrl+B)"><button id="mceu_0-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-bold"></i></button></div><div id="mceu_1" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Italic (Ctrl+I)"><button id="mceu_1-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-italic"></i></button></div><div id="mceu_2" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Underline (Ctrl+U)"><button id="mceu_2-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-underline"></i></button></div><div id="mceu_3" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Blockquote (Shift+Alt+Q)"><button id="mceu_3-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-blockquote"></i></button></div><div id="mceu_4" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Strikethrough (Shift+Alt+D)"><button id="mceu_4-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-strikethrough"></i></button></div><div id="mceu_5" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Bulleted list (Shift+Alt+U)"><button id="mceu_5-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-bullist"></i></button></div><div id="mceu_6" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Numbered list (Shift+Alt+O)"><button id="mceu_6-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-numlist"></i></button></div><div id="mceu_7" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Align left (Shift+Alt+L)"><button id="mceu_7-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-alignleft"></i></button></div><div id="mceu_8" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Align center (Shift+Alt+C)"><button id="mceu_8-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-aligncenter"></i></button></div><div id="mceu_9" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Align right (Shift+Alt+R)"><button id="mceu_9-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-alignright"></i></button></div><div id="mceu_10" class="mce-widget mce-btn mce-disabled" tabindex="-1" role="button" aria-label="Undo (Ctrl+Z)" aria-disabled="true"><button id="mceu_10-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-undo"></i></button></div><div id="mceu_11" class="mce-widget mce-btn mce-disabled" tabindex="-1" role="button" aria-label="Redo (Ctrl+Y)" aria-disabled="true"><button id="mceu_11-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-redo"></i></button></div><div id="mceu_12" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Insert/edit link (Ctrl+K)"><button id="mceu_12-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-link"></i></button></div><div id="mceu_13" class="mce-widget mce-btn mce-last" tabindex="-1" aria-pressed="false" role="button" aria-label="Fullscreen"><button id="mceu_13-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-fullscreen"></i></button></div></div></div></div></div></div></div></div></div><div id="mceu_19" class="mce-edit-area mce-container mce-panel mce-stack-layout-item" hidefocus="1" tabindex="-1" role="group" style="border-width: 1px 0px 0px;"><iframe id="field_8261_ifr" frameborder="0" allowtransparency="true" title="Rich Text Area. Press Alt-Shift-H for help." style="width: 100%; height: 120px; display: block;"></iframe></div><div id="mceu_20" class="mce-statusbar mce-container mce-panel mce-stack-layout-item mce-last" hidefocus="1" tabindex="-1" role="group" style="border-width: 1px 0px 0px;"><div id="mceu_20-body" class="mce-container-body mce-flow-layout"><div id="mceu_21" class="mce-path mce-flow-layout-item mce-first"><div class="mce-path-item">&nbsp;</div></div><div id="mceu_22" class="mce-flow-layout-item mce-last mce-resizehandle"><i class="mce-ico mce-i-resize"></i></div></div></div></div></div><textarea class="wp-editor-area" rows="10" autocomplete="off" cols="40" name="field_8261" id="field_8261" aria-hidden="true" style="display: none;"></textarea></div>--}}
{{--                                                </div>--}}

{{--                                                <p class="field-visibility-settings-toggle field-visibility-settings-header" id="field-visibility-settings-toggle-8261">--}}
{{--                                                    This field may be seen by:--}}
{{--                                                    <span class="current-visibility-level">Everyone</span>--}}
{{--                                                    <button class="visibility-toggle-link text-button" type="button" aria-expanded="false">Change</button>--}}
{{--                                                </p>--}}

{{--                                                <div class="field-visibility-settings bp-hide" id="field-visibility-settings-8261">--}}
{{--                                                    <fieldset>--}}
{{--                                                        <legend>--}}
{{--                                                            Who is allowed to see this field?--}}
{{--                                                        </legend>--}}

{{--                                                        <div class="radio">--}}
{{--                                                            <label for="see-field_8261_public">--}}
{{--                                                                <input type="radio" id="see-field_8261_public" name="field_8261_visibility" value="public" checked="checked">--}}
{{--                                                                <span class="field-visibility-text">Everyone</span>--}}
{{--                                                            </label>--}}

{{--                                                            <label for="see-field_8261_adminsonly">--}}
{{--                                                                <input type="radio" id="see-field_8261_adminsonly" name="field_8261_visibility" value="adminsonly">--}}
{{--                                                                <span class="field-visibility-text">Only Me</span>--}}
{{--                                                            </label>--}}

{{--                                                            <label for="see-field_8261_loggedin">--}}
{{--                                                                <input type="radio" id="see-field_8261_loggedin" name="field_8261_visibility" value="loggedin">--}}
{{--                                                                <span class="field-visibility-text">All Members</span>--}}
{{--                                                            </label>--}}

{{--                                                            <label for="see-field_8261_friends">--}}
{{--                                                                <input type="radio" id="see-field_8261_friends" name="field_8261_visibility" value="friends">--}}
{{--                                                                <span class="field-visibility-text">My Friends</span>--}}
{{--                                                            </label>--}}

{{--                                                        </div>--}}
{{--                                                    </fieldset>--}}
{{--                                                    <button class="field-visibility-settings-close button" type="button">Close</button>--}}
{{--                                                </div>--}}
{{--                                            </fieldset>--}}
{{--                                        </div>--}}

                                        <!--location -->
{{--                                        <div class="editfield field_8270 field_location optional-field visibility-public alt field_type_textbox">--}}
{{--                                            <fieldset>--}}
{{--                                                <legend id="field_8270-1">--}}
{{--                                                    Location--}}
{{--                                                </legend>--}}

{{--                                                <input id="field_8270" name="field_8270" type="text" value="" aria-labelledby="field_8270-1" aria-describedby="field_8270-3">--}}
{{--                                                <p class="description" id="field_8270-3">--}}
{{--                                                    This address will be used on the members directory map, please make sure this address is valid for Google Map.--}}
{{--                                                </p>--}}

{{--                                                <p class="field-visibility-settings-toggle field-visibility-settings-header" id="field-visibility-settings-toggle-8270">--}}
{{--                                                    This field may be seen by:--}}
{{--                                                    <span class="current-visibility-level">Everyone</span>--}}
{{--                                                    <button class="visibility-toggle-link text-button" type="button" aria-expanded="false">--}}
{{--                                                        Change--}}
{{--                                                    </button>--}}
{{--                                                </p>--}}

{{--                                                <div class="field-visibility-settings bp-hide" id="field-visibility-settings-8270">--}}
{{--                                                    <fieldset>--}}
{{--                                                        <legend>Who is allowed to see this field?</legend>--}}

{{--                                                        <div class="radio">--}}
{{--                                                            <label for="see-field_8270_public">--}}
{{--                                                                <input type="radio" id="see-field_8270_public" name="field_8270_visibility" value="public" checked="checked">--}}
{{--                                                                <span class="field-visibility-text">Everyone</span>--}}
{{--                                                            </label>--}}

{{--                                                            <label for="see-field_8270_adminsonly">--}}
{{--                                                                <input type="radio" id="see-field_8270_adminsonly" name="field_8270_visibility" value="adminsonly">--}}
{{--                                                                <span class="field-visibility-text">Only Me</span>--}}
{{--                                                            </label>--}}

{{--                                                            <label for="see-field_8270_loggedin">--}}
{{--                                                                <input type="radio" id="see-field_8270_loggedin" name="field_8270_visibility" value="loggedin">--}}
{{--                                                                <span class="field-visibility-text">All Members</span>--}}
{{--                                                            </label>--}}

{{--                                                            <label for="see-field_8270_friends">--}}
{{--                                                                <input type="radio" id="see-field_8270_friends" name="field_8270_visibility" value="friends">--}}
{{--                                                                <span class="field-visibility-text">My Friends</span>--}}
{{--                                                            </label>--}}
{{--                                                        </div>--}}
{{--                                                    </fieldset>--}}
{{--                                                    <button class="field-visibility-settings-close button" type="button">Close</button>--}}
{{--                                                </div>--}}
{{--                                            </fieldset>--}}
{{--                                        </div>--}}

                                        <!--phone-->
{{--                                        <div class="editfield field_12 field_phone optional-field visibility-public field_type_textbox">--}}
{{--                                            <fieldset>--}}
{{--                                                <legend id="field_12-1">--}}
{{--                                                    Phone--}}
{{--                                                </legend>--}}

{{--                                                <input id="field_12" name="field_12" type="text" value="" aria-labelledby="field_12-1" aria-describedby="field_12-3">--}}

{{--                                                <p class="field-visibility-settings-toggle field-visibility-settings-header" id="field-visibility-settings-toggle-12">--}}
{{--                                                    This field may be seen by:--}}
{{--                                                    <span class="current-visibility-level">Everyone</span>--}}
{{--                                                    <button class="visibility-toggle-link text-button" type="button" aria-expanded="false">--}}
{{--                                                        Change--}}
{{--                                                    </button>--}}
{{--                                                </p>--}}

{{--                                                <div class="field-visibility-settings bp-hide" id="field-visibility-settings-12">--}}
{{--                                                    <fieldset>--}}
{{--                                                        <legend>Who is allowed to see this field?</legend>--}}

{{--                                                        <div class="radio">--}}
{{--                                                            <label for="see-field_12_public">--}}
{{--                                                                <input type="radio" id="see-field_12_public" name="field_12_visibility" value="public" checked="checked">--}}
{{--                                                                <span class="field-visibility-text">Everyone</span>--}}
{{--                                                            </label>--}}

{{--                                                            <label for="see-field_12_adminsonly">--}}
{{--                                                                <input type="radio" id="see-field_12_adminsonly" name="field_12_visibility" value="adminsonly">--}}
{{--                                                                <span class="field-visibility-text">Only Me</span>--}}
{{--                                                            </label>--}}

{{--                                                            <label for="see-field_12_loggedin">--}}
{{--                                                                <input type="radio" id="see-field_12_loggedin" name="field_12_visibility" value="loggedin">--}}
{{--                                                                <span class="field-visibility-text">All Members</span>--}}
{{--                                                            </label>--}}

{{--                                                            <label for="see-field_12_friends">--}}
{{--                                                                <input type="radio" id="see-field_12_friends" name="field_12_visibility" value="friends">--}}
{{--                                                                <span class="field-visibility-text">My Friends</span>--}}
{{--                                                            </label>--}}
{{--                                                        </div>--}}
{{--                                                    </fieldset>--}}
{{--                                                    <button class="field-visibility-settings-close button" type="button">Close</button>--}}
{{--                                                </div>--}}
{{--                                            </fieldset>--}}
{{--                                        </div>--}}

                                        <!--office number-->
{{--                                        <div class="editfield field_13 field_office-number optional-field visibility-public alt field_type_textbox">--}}
{{--                                            <fieldset>--}}
{{--                                                <legend id="field_13-1">--}}
{{--                                                    Office number--}}
{{--                                                </legend>--}}

{{--                                                <input id="field_13" name="field_13" type="text" value="" aria-labelledby="field_13-1" aria-describedby="field_13-3">--}}

{{--                                                <p class="field-visibility-settings-toggle field-visibility-settings-header" id="field-visibility-settings-toggle-13">--}}
{{--                                                    This field may be seen by: <span class="current-visibility-level">Everyone</span>--}}
{{--                                                    <button class="visibility-toggle-link text-button" type="button" aria-expanded="false">Change</button>--}}
{{--                                                </p>--}}

{{--                                                <div class="field-visibility-settings bp-hide" id="field-visibility-settings-13">--}}
{{--                                                    <fieldset>--}}
{{--                                                        <legend>Who is allowed to see this field?</legend>--}}

{{--                                                        <div class="radio">--}}
{{--                                                            <label for="see-field_13_public">--}}
{{--                                                                <input type="radio" id="see-field_13_public" name="field_13_visibility" value="public" checked="checked">--}}
{{--                                                                <span class="field-visibility-text">Everyone</span>--}}
{{--                                                            </label>--}}

{{--                                                            <label for="see-field_13_adminsonly">--}}
{{--                                                                <input type="radio" id="see-field_13_adminsonly" name="field_13_visibility" value="adminsonly">--}}
{{--                                                                <span class="field-visibility-text">Only Me</span>--}}
{{--                                                            </label>--}}

{{--                                                            <label for="see-field_13_loggedin">--}}
{{--                                                                <input type="radio" id="see-field_13_loggedin" name="field_13_visibility" value="loggedin">--}}
{{--                                                                <span class="field-visibility-text">All Members</span>--}}
{{--                                                            </label>--}}

{{--                                                            <label for="see-field_13_friends">--}}
{{--                                                                <input type="radio" id="see-field_13_friends" name="field_13_visibility" value="friends">--}}
{{--                                                                <span class="field-visibility-text">My Friends</span>--}}
{{--                                                            </label>--}}

{{--                                                        </div>--}}
{{--                                                    </fieldset>--}}
{{--                                                    <button class="field-visibility-settings-close button" type="button">Close</button>--}}
{{--                                                </div>--}}
{{--                                            </fieldset>--}}
{{--                                        </div>--}}

                                        <!--profession-->
{{--                                        <div class="editfield field_8262 field_profession optional-field visibility-public field_type_selectbox">--}}
{{--                                            <fieldset>--}}
{{--                                                <legend id="field_8262-1">--}}
{{--                                                    Profession--}}
{{--                                                </legend>--}}

{{--                                                <select id="field_8262" name="field_8262" aria-labelledby="field_8262-1" aria-describedby="field_8262-3">--}}
{{--                                                    <option value="">----</option>--}}
{{--                                                    <option value="Web Developer">Web Developer</option>--}}
{{--                                                    <option value="Web Designer">Web Designer</option>--}}
{{--                                                    <option selected="selected" value="Marketing consultant">Marketing consultant</option>--}}
{{--                                                    <option value="Sales Manager">Sales Manager</option>--}}
{{--                                                </select>--}}

{{--                                                <p class="field-visibility-settings-toggle field-visibility-settings-header" id="field-visibility-settings-toggle-8262">--}}
{{--                                                    This field may be seen by: <span class="current-visibility-level">Everyone</span>--}}
{{--                                                    <button class="visibility-toggle-link text-button" type="button" aria-expanded="false">Change</button>--}}
{{--                                                </p>--}}

{{--                                                <div class="field-visibility-settings bp-hide" id="field-visibility-settings-8262">--}}
{{--                                                    <fieldset>--}}
{{--                                                        <legend>Who is allowed to see this field?</legend>--}}

{{--                                                        <div class="radio">--}}
{{--                                                            <label for="see-field_8262_public">--}}
{{--                                                                <input type="radio" id="see-field_8262_public" name="field_8262_visibility" value="public" checked="checked">--}}
{{--                                                                <span class="field-visibility-text">Everyone</span>--}}
{{--                                                            </label>--}}

{{--                                                            <label for="see-field_8262_adminsonly">--}}
{{--                                                                <input type="radio" id="see-field_8262_adminsonly" name="field_8262_visibility" value="adminsonly">--}}
{{--                                                                <span class="field-visibility-text">Only Me</span>--}}
{{--                                                            </label>--}}

{{--                                                            <label for="see-field_8262_loggedin">--}}
{{--                                                                <input type="radio" id="see-field_8262_loggedin" name="field_8262_visibility" value="loggedin">--}}
{{--                                                                <span class="field-visibility-text">All Members</span>--}}
{{--                                                            </label>--}}

{{--                                                            <label for="see-field_8262_friends">--}}
{{--                                                                <input type="radio" id="see-field_8262_friends" name="field_8262_visibility" value="friends">--}}
{{--                                                                <span class="field-visibility-text">My Friends</span>--}}
{{--                                                            </label>--}}
{{--                                                        </div>--}}
{{--                                                    </fieldset>--}}
{{--                                                    <button class="field-visibility-settings-close button" type="button">Close</button>--}}
{{--                                                </div>--}}
{{--                                            </fieldset>--}}
{{--                                        </div>--}}


{{--                                        <input type="hidden" name="field_ids" id="field_ids" value="1,10,8261,8270,12,13,8262">--}}

                                        <div class="submit">
                                            <input type="submit" name="profile-group-edit-submit" id="profile-group-edit-submit" value="Save Changes">
                                        </div>
{{--                                        <input type="hidden" id="_wpnonce" name="_wpnonce" value="91eb7a5735">--}}
{{--                                        <input type="hidden" name="_wp_http_referer" value="/woffice/business/members/demo/profile/edit/group/1/">--}}
                                    </form>
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
