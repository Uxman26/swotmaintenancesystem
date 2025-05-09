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

                                <div class="profile change-avatar">
                                    <h2 class="screen-heading change-avatar-screen">Change Profile Photo</h2>

                                    <form class="form-edit-add" role="form" action="{{ route('profile.change_avatar.post') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        <center>
                                            <img src="./storage/{{ Auth::user()->avatar }}" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">

                                            <input id="avatar" name="avatar" type="file" data-name="avatar" style=" padding-left: 110px;">
                                        </center>
                                        <br/>
                                        <br/>
                                        <div class="submit">
                                            <input type="submit" name="profile-group-edit-submit" id="profile-group-edit-submit" value="Save Changes">
                                        </div>
                                    </form>
{{--                                    <p class="bp-feedback info">--}}
{{--                                        <span class="bp-icon" aria-hidden="true"></span>--}}
{{--                                        <span class="bp-help-text">--}}
{{--			                                Your profile photo will be used on your profile and throughout the site. If there is a--}}
{{--                                            <a href="https://gravatar.com">Gravatar</a> associated with your account email we will use that, or you can upload an image from your computer.--}}
{{--                                        </span>--}}
{{--                                    </p>--}}

{{--                                    <form action="" method="post" id="avatar-upload-form" class="standard-form" enctype="multipart/form-data">--}}
{{--                                        <input type="hidden" id="_wpnonce" name="_wpnonce" value="35a72f2f20">--}}
{{--                                        <input type="hidden" name="_wp_http_referer" value="/woffice/business/members/demo/profile/change-avatar/">--}}
{{--                                    </form>--}}

{{--                                    <div class="bp-avatar-nav">--}}
{{--                                        <ul class="avatar-nav-items">--}}
{{--                                            <li class="avatar-nav-item current" id="bp-avatar-upload">--}}
{{--                                                <a href="#" class="bp-avatar-nav-item" data-nav="upload">Upload</a>--}}
{{--                                            </li>--}}
{{--                                            <li class="avatar-nav-item" id="bp-avatar-camera">--}}
{{--                                                <a href="#" class="bp-avatar-nav-item" data-nav="camera">Take Photo</a>--}}
{{--                                            </li>--}}
{{--                                            <li class="avatar-nav-item" id="bp-avatar-delete">--}}
{{--                                                <a href="#" class="bp-avatar-nav-item" data-nav="delete">Delete</a>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                    <div class="bp-avatar">--}}
{{--                                        <div class="bp-uploader-window">--}}
{{--                                            <div id="bp-upload-ui" class="drag-drop" style="position: relative;">--}}
{{--                                                <div id="drag-drop-area" style="position: relative;">--}}
{{--                                                    <div class="drag-drop-inside">--}}
{{--                                                        <p class="drag-drop-info">Drop your file here</p>--}}

{{--                                                        <p class="drag-drop-buttons">--}}
{{--                                                            <label for="bp-browse-button" class="bp-screen-reader-text">--}}
{{--                                                                Select your file--}}
{{--                                                            </label>--}}
{{--                                                            <input id="bp-browse-button" type="button" value="Select your file" class="button" style="z-index: 1;">--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div id="html5_1dm0nqluoulu19os18dd1b9s114f_container" class="moxie-shim moxie-shim-html5" style="position: absolute; top: 83px; left: 124px; width: 178px; height: 41px; overflow: hidden; z-index: 0;"><input id="html5_1dm0nqluoulu19os18dd1b9s114f" type="file" style="font-size: 999px; opacity: 0; position: absolute; top: 0px; left: 0px; width: 100%; height: 100%;" accept=""></div></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="bp-avatar-status">--}}

{{--                                    </div>--}}

{{--                                    <script type="text/html" id="tmpl-bp-avatar-nav">--}}
{{--                                        <a href="{{data.href}}" class="bp-avatar-nav-item" data-nav="{{data.id}}">{{data.name}}</a>--}}
{{--                                    </script>--}}

{{--                                    <script type="text/html" id="tmpl-upload-window">--}}
{{--                                        <div id="{{data.container}}">--}}
{{--                                            <div id="{{data.drop_element}}">--}}
{{--                                                <div class="drag-drop-inside">--}}
{{--                                                    <p class="drag-drop-info">Drop your file here</p>--}}

{{--                                                    <p class="drag-drop-buttons">--}}
{{--                                                        <label for="{{data.browse_button}}" class="bp-screen-reader-text">--}}
{{--                                                            Select your file						</label>--}}
{{--                                                        <input id="{{data.browse_button}}" type="button" value="Select your file" class="button" />--}}
{{--                                                    </p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </script>--}}

{{--                                    <script type="text/html" id="tmpl-progress-window">--}}
{{--                                        <div id="{{data.id}}">--}}
{{--                                            <div class="bp-progress">--}}
{{--                                                <div class="bp-bar"></div>--}}
{{--                                            </div>--}}
{{--                                            <div class="filename">{{data.filename}}</div>--}}
{{--                                        </div>--}}
{{--                                    </script>--}}

{{--                                    <script id="tmpl-bp-avatar-item" type="text/html">--}}
{{--                                        <div id="avatar-to-crop">--}}
{{--                                            <img src="{{{data.url}}}"/>--}}
{{--                                        </div>--}}
{{--                                        <div class="avatar-crop-management">--}}
{{--                                            <div id="avatar-crop-pane" class="avatar" style="width:{{data.full_w}}px; height:{{data.full_h}}px">--}}
{{--                                                <img src="{{{data.url}}}" id="avatar-crop-preview"/>--}}
{{--                                            </div>--}}
{{--                                            <div id="avatar-crop-actions">--}}
{{--                                                <button type="button" class="button avatar-crop-submit">Crop Image</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </script>--}}

{{--                                    <script id="tmpl-bp-avatar-webcam" type="text/html">--}}
{{--                                        <# if ( ! data.user_media ) { #>--}}
{{--                                        <div id="bp-webcam-message">--}}
{{--                                            <p class="warning">Your browser does not support this feature.</p>--}}
{{--                                        </div>--}}
{{--                                        <# } else { #>--}}
{{--                                        <div id="avatar-to-crop"></div>--}}
{{--                                        <div class="avatar-crop-management">--}}
{{--                                            <div id="avatar-crop-pane" class="avatar" style="width:{{data.w}}px; height:{{data.h}}px"></div>--}}
{{--                                            <div id="avatar-crop-actions">--}}
{{--                                                <button type="button" class="button avatar-webcam-capture">Capture</button>--}}
{{--                                                <button type="button" class="button avatar-webcam-save">Save</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <# } #>--}}
{{--                                    </script>--}}

{{--                                    <script id="tmpl-bp-avatar-delete" type="text/html">--}}
{{--                                        <# if ( 'user' === data.object ) { #>--}}
{{--                                        <p>If you&#039;d like to delete your current profile photo, use the delete profile photo button.</p>--}}
{{--                                        <button type="button" class="button edit" id="bp-delete-avatar">Delete My Profile Photo</button>--}}
{{--                                        <# } else if ( 'group' === data.object ) { #>--}}
{{--                                        <aside class="bp-feedback bp-messages info">--}}
{{--                                            <span class="bp-icon" aria-hidden="true"></span>--}}
{{--                                            <p>If you&#8217;d like to remove the existing group profile photo but not upload a new one, please use the delete group profile photo button.</p>--}}
{{--                                        </aside>--}}
{{--                                        <button type="button" class="button edit" id="bp-delete-avatar">Delete Group Profile Photo</button>--}}
{{--                                        <# } else { #>--}}
{{--                                        <# } #>--}}
{{--                                    </script>--}}
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

