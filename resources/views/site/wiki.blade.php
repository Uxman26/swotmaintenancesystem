@extends('layouts.site.app')

@section('content')
    <header id="featuredbox" class="centered">
        <div class="pagetitle animate-me fadeIn">
            <h1 class="entry-title">Wiki</h1>
{{--            <form role="search" method="get" action="https://demos.alkalab.com/woffice/business/">--}}
{{--                <input type="text" value="" name="s" id="s" placeholder="Search...">--}}
{{--                <input type="hidden" name="searchsubmit" id="searchsubmit" value="true">--}}
{{--                <input type="hidden" name="post_type" value="wiki">--}}
{{--                <button type="submit" name="searchsubmit">--}}
{{--                    <i class="fa fa-search"></i>--}}
{{--                </button>--}}
{{--            </form>--}}
        </div>
        <!-- .pagetitle -->
        <div class="featured-background" style="background-image: url(./site/theme/wp-content/uploads/2016/12/MAIN.jpg)" ;="">
            <div class="featured-layer d-block"></div>
        </div>
    </header>

    <!-- START THE CONTENT CONTAINER -->
    <div id="content-container">

        <!-- START CONTENT -->
        <div id="content">
            <article id="post-191" class="box content post-191 page type-page status-publish">

                <div id="wiki-page-content" class="intern-padding">
                    <p style="text-align: center;">
                        A knowledge base is a technology used to store complex structured and unstructured information used by a computer system. The initial use of the term was in connection with expert systems which were the first knowledge-based systems.
                    </p>
                    <p class="text-center">
{{--                        <a id="woffice-members-filter-btn" class="btn btn-default mt-0" href="https://demos.alkalab.com/woffice/business/wiki-page?sortby=like">--}}
{{--                            <i class="fa fa-sort-amount-desc"></i>--}}
{{--                            Sort By Likes--}}
{{--                        </a>--}}
                    </p>
                    <div class="row">
                        <div class="col-md-12 wiki-category-container">
                            <div class="heading">
                                <h2>
                                    <a href="#" class="text-body font-weight-bold">
                                        <i class="fa fa-folder text-light"></i>
                                        Help
                                        <span class="wiki-category-count">(4)</span>
                                    </a>
                                </h2>
                            </div>
                            <ul class="list-styled list-wiki wiki-category-container collapsed-wiki">
{{--                                <li class="is-publish">--}}
{{--                                    <a href="https://demos.alkalab.com/woffice/business/wiki/another-help/" rel="bookmark" class=" text-body" data-post-id="1156">--}}
{{--                                        another help--}}
{{--                                        <span class="ml-2 count badge badge-primary badge-pill">--}}
{{--                                            <i class="fa fa-thumbs-up"></i>--}}
{{--                                            10--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
                                <li class="is-publish">
                                    <a href="https://swot.com.my/knowledge-base-2/create-email-account-in-cpanel/" rel="bookmark" class=" text-body" data-post-id="1832">
                                        Create Email Account in cPanel
                                        <span class="ml-2 count badge badge-primary badge-pill">
                                            <i class="fa fa-thumbs-up"></i>
                                            5
                                        </span>
                                    </a>
                                </li>
                                <li class="is-publish">
                                    <a href="https://swot.com.my/knowledge-base-2/creating-a-pop3-email-account-in-mozilla-thunderbird/" rel="bookmark" class=" text-body" data-post-id="212">
                                        Creating a POP3 Email Account in Mozilla Thunderbird
                                        <span class="ml-2 count badge badge-primary badge-pill">
                                            <i class="fa fa-thumbs-up"></i>
                                            1
                                        </span>
                                    </a>
                                </li>
                                <li class="is-publish">
                                    <a href="https://swot.com.my/knowledge-base-2/how-to-setup-email-account-in-microsoft-outlook-2016/" rel="bookmark" class="featured text-body" data-post-id="210">
                                        How to setup email account in Microsoft Outlook 2016
                                        <span class="ml-2 count badge badge-primary badge-pill">
                                            <i class="fa fa-thumbs-up"></i>
                                            3
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
{{--                        <div class="col-md-6 wiki-category-container">--}}
{{--                            <div class="heading">--}}
{{--                                <h2>--}}
{{--                                    <a href="https://demos.alkalab.com/woffice/business/wiki-category/marketing/" class="text-body font-weight-bold">--}}
{{--                                        <i class="fa fa-folder text-light"></i>--}}
{{--                                        Marketing--}}
{{--                                        <span class="wiki-category-count">--}}
{{--                                            (5)--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </h2>--}}
{{--                            </div>--}}
{{--                            <ul class="list-styled list-wiki wiki-category-container collapsed-wiki">--}}
{{--                                <li class="is-publish">--}}
{{--                                    <a href="https://demos.alkalab.com/woffice/business/wiki/company-policy-about-web-marketing/" rel="bookmark" class="featured text-body" data-post-id="1820">--}}
{{--                                        Company policy about web marketing--}}
{{--                                        <span class="ml-2 count badge badge-primary badge-pill">--}}
{{--                                            <i class="fa fa-thumbs-up"></i>--}}
{{--                                            2--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="is-publish">--}}
{{--                                    <a href="https://demos.alkalab.com/woffice/business/wiki/facebook-marketing/" rel="bookmark" class=" text-body" data-post-id="1824">--}}
{{--                                        Facebook Marketing--}}
{{--                                        <span class="ml-2 count badge badge-primary badge-pill">--}}
{{--                                            <i class="fa fa-thumbs-up"></i>--}}
{{--                                            2--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="is-publish">--}}
{{--                                    <a href="https://demos.alkalab.com/woffice/business/wiki/how-make-a-marketing-plan/" rel="bookmark" class="featured text-body" data-post-id="1830">--}}
{{--                                        How make a marketing plan--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="is-publish">--}}
{{--                                    <a href="https://demos.alkalab.com/woffice/business/wiki/twitter-marketing/" rel="bookmark" class=" text-body" data-post-id="1826">--}}
{{--                                        Twitter Marketing--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="is-publish">--}}
{{--                                    <a href="https://demos.alkalab.com/woffice/business/wiki/youtube-marketing/" rel="bookmark" class=" text-body" data-post-id="1828">--}}
{{--                                        Youtube Marketing--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
{{--                    <div class="row">--}}
{{--                        <div class="col-md-6 wiki-category-container">--}}
{{--                            <div class="heading">--}}
{{--                                <h2>--}}
{{--                                    <a href="https://demos.alkalab.com/woffice/business/wiki-category/woffice/" class="text-body font-weight-bold">--}}
{{--                                        <i class="fa fa-folder text-light"></i>--}}
{{--                                        Woffice--}}
{{--                                        <span class="wiki-category-count">--}}
{{--                                            (4)--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </h2>--}}
{{--                            </div>--}}
{{--                            <ul class="list-styled list-wiki wiki-category-container collapsed-wiki">--}}
{{--                                <li class="is-publish">--}}
{{--                                    <a href="https://demos.alkalab.com/woffice/business/wiki/1-woffice-wiki-example/" rel="bookmark" class="featured text-body" data-post-id="1812">--}}
{{--                                        #1 Woffice Wiki Example--}}
{{--                                        <span class="ml-2 count badge badge-primary badge-pill">--}}
{{--                                            <i class="fa fa-thumbs-up"></i>--}}
{{--                                            1--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="is-publish">--}}
{{--                                    <a href="https://demos.alkalab.com/woffice/business/wiki/2-woffice-wiki-example/" rel="bookmark" class="featured text-body" data-post-id="1814">--}}
{{--                                        #2 Woffice Wiki Example--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="is-publish">--}}
{{--                                    <a href="https://demos.alkalab.com/woffice/business/wiki/3-woffice-wiki-example/" rel="bookmark" class=" text-body" data-post-id="1816">--}}
{{--                                        #3 Woffice Wiki Example--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="is-publish">--}}
{{--                                    <a href="https://demos.alkalab.com/woffice/business/wiki/4-woffice-wiki-example/" rel="bookmark" class=" text-body" data-post-id="1818">--}}
{{--                                        #4 Woffice Wiki Example--}}
{{--                                        <span class="ml-2 count badge badge-primary badge-pill">--}}
{{--                                            <i class="fa fa-thumbs-up"></i>--}}
{{--                                            1--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 wiki-category-container">--}}
{{--                            <div class="heading">--}}
{{--                                <h2>--}}
{{--                                    <a href="https://demos.alkalab.com/woffice/business/wiki-category/wordpress/" class="text-body font-weight-bold">--}}
{{--                                        <i class="fa fa-folder text-light"></i>--}}
{{--                                        Wordpress--}}
{{--                                        <span class="wiki-category-count">--}}
{{--                                            (7)--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </h2>--}}
{{--                            </div>--}}
{{--                            <ul class="list-styled list-wiki wiki-category-container collapsed-wiki">--}}
{{--                                <li class="sub-category">--}}
{{--                                    <span data-toggle="collapse" data-target="#sub-category" expanded="false" aria-controls="sub-category">--}}
{{--                                        Sub Category--}}
{{--                                        <span class="wiki-category-count">--}}
{{--                                            (2)--}}
{{--                                        </span>--}}
{{--                                    </span>--}}
{{--                                    <ul id="sub-category" class="list-styled list-wiki collapse" aria-expanded="false">--}}
{{--                                        <li class="is-publish">--}}
{{--                                            <a href="https://demos.alkalab.com/woffice/business/wiki/explanation/" rel="bookmark" class=" text-body" data-post-id="1486">--}}
{{--                                                Explanation--}}
{{--                                                <span class="ml-2 count badge badge-primary badge-pill">--}}
{{--                                                    <i class="fa fa-thumbs-up"></i>--}}
{{--                                                    11--}}
{{--                                                </span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <li class="is-publish">--}}
{{--                                            <a href="https://demos.alkalab.com/woffice/business/wiki/new-help/" rel="bookmark" class=" text-body" data-post-id="936">--}}
{{--                                                New Help--}}
{{--                                                <span class="ml-2 count badge badge-primary badge-pill">--}}
{{--                                                    <i class="fa fa-thumbs-up"></i>--}}
{{--                                                    11--}}
{{--                                                </span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                                <li class="is-publish">--}}
{{--                                    <a href="https://demos.alkalab.com/woffice/business/wiki/common-installation-problems/" rel="bookmark" class="featured text-body" data-post-id="201">--}}
{{--                                        Common Installation Problems--}}
{{--                                        <span class="ml-2 count badge badge-primary badge-pill">--}}
{{--                                            <i class="fa fa-thumbs-up"></i>--}}
{{--                                            1--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="is-publish"><a href="https://demos.alkalab.com/woffice/business/wiki/its-awesome/" rel="bookmark" class=" text-body" data-post-id="938">--}}
{{--                                        Company information--}}
{{--                                        <span class="ml-2 count badge badge-primary badge-pill">--}}
{{--                                            <i class="fa fa-thumbs-up"></i>--}}
{{--                                            20--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="is-publish">--}}
{{--                                    <a href="https://demos.alkalab.com/woffice/business/wiki/documentation/" rel="bookmark" class=" text-body" data-post-id="325">--}}
{{--                                        Documentation--}}
{{--                                        <span class="ml-2 count badge badge-primary badge-pill">--}}
{{--                                            <i class="fa fa-thumbs-up"></i>--}}
{{--                                            1--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="is-publish">--}}
{{--                                    <a href="https://demos.alkalab.com/woffice/business/wiki/installing-wordpress/" rel="bookmark" class=" text-body" data-post-id="197">--}}
{{--                                        Installing WordPress--}}
{{--                                        <span class="ml-2 count badge badge-primary badge-pill">--}}
{{--                                            <i class="fa fa-thumbs-up"></i>--}}
{{--                                            5--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="is-publish">--}}
{{--                                    <a href="https://demos.alkalab.com/woffice/business/wiki/wordpress-pages/" rel="bookmark" class=" text-body" data-post-id="204">--}}
{{--                                        Understanding Pages--}}
{{--                                        <span class="ml-2 count badge badge-primary badge-pill">--}}
{{--                                            <i class="fa fa-thumbs-up"></i>--}}
{{--                                            3--}}
{{--                                        </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <hr>
{{--                    <div class="text-center" id="wiki-bottom">--}}
{{--                        <a href="#" class="btn btn-default frontend-wrapper__toggle" data-action="display" id="show-wiki-create">--}}
{{--                            <i class="fa fa-plus-square"></i>--}}
{{--                            New Wiki Article--}}
{{--                        </a>--}}
{{--                    </div>--}}
                </div>


{{--                <div class="frontend-wrapper">--}}
{{--                    <div id="wiki-create" class="intern-padding frontend-wrapper__content " style="display: none;">--}}
{{--                        <form action="https://demos.alkalab.com/woffice/business/wiki-page/" id="primary-post-form" class="mt-0" method="POST">--}}
{{--                            <p>--}}
{{--                                <label for="post_title">--}}
{{--                                    Wiki Title:--}}
{{--                                </label>--}}
{{--                                <input type="text" name="post_title" id="post_title" class="required" required="">--}}
{{--                            </p>--}}
{{--                            <p>--}}
{{--                                <label for="wiki_category">Article Category:</label>--}}
{{--                                <select multiple="multiple" name="wiki_category[]" class="postform form-control">--}}
{{--                                    <option value="no-category">No category</option>--}}
{{--                                    <option value="help">Help</option>--}}
{{--                                    <option value="marketing">Marketing</option>--}}
{{--                                    <option value="woffice">Woffice</option>--}}
{{--                                    <option value="wordpress">Wordpress</option>--}}
{{--                                    <option value="sub-category">&gt; Sub Category</option>--}}
{{--                                </select>--}}
{{--                            </p>--}}
{{--                            <p>--}}
{{--                                <label for="post_content">Wiki content:</label>--}}
{{--                            </p>--}}
{{--                            <div id="wp-post_content-wrap" class="wp-core-ui wp-editor-wrap tmce-active">--}}
{{--                                <link rel="stylesheet" id="editor-buttons-css" href="https://demos.alkalab.com/woffice/business/wp-includes/css/editor.min.css" type="text/css" media="all">--}}
{{--                                <div id="wp-post_content-editor-tools" class="wp-editor-tools hide-if-no-js">--}}
{{--                                    <div class="wp-editor-tabs">--}}
{{--                                        <button type="button" id="post_content-tmce" class="wp-switch-editor switch-tmce" data-wp-editor-id="post_content">--}}
{{--                                            Visual--}}
{{--                                        </button>--}}
{{--                                        <button type="button" id="post_content-html" class="wp-switch-editor switch-html" data-wp-editor-id="post_content">--}}
{{--                                            Text--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div id="wp-post_content-editor-container" class="wp-editor-container">--}}
{{--                                    <div id="qt_post_content_toolbar" class="quicktags-toolbar">--}}
{{--                                        <input type="button" id="qt_post_content_strong" class="ed_button button button-small" aria-label="Bold" value="b">--}}
{{--                                        <input type="button" id="qt_post_content_em" class="ed_button button button-small" aria-label="Italic" value="i">--}}
{{--                                        <input type="button" id="qt_post_content_link" class="ed_button button button-small" aria-label="Insert link" value="link">--}}
{{--                                        <input type="button" id="qt_post_content_block" class="ed_button button button-small" aria-label="Blockquote" value="b-quote">--}}
{{--                                        <input type="button" id="qt_post_content_del" class="ed_button button button-small" aria-label="Deleted text (strikethrough)" value="del">--}}
{{--                                        <input type="button" id="qt_post_content_ins" class="ed_button button button-small" aria-label="Inserted text" value="ins">--}}
{{--                                        <input type="button" id="qt_post_content_img" class="ed_button button button-small" aria-label="Insert image" value="img">--}}
{{--                                        <input type="button" id="qt_post_content_ul" class="ed_button button button-small" aria-label="Bulleted list" value="ul">--}}
{{--                                        <input type="button" id="qt_post_content_ol" class="ed_button button button-small" aria-label="Numbered list" value="ol">--}}
{{--                                        <input type="button" id="qt_post_content_li" class="ed_button button button-small" aria-label="List item" value="li">--}}
{{--                                        <input type="button" id="qt_post_content_code" class="ed_button button button-small" value="code"><input type="button" id="qt_post_content_more" class="ed_button button button-small" aria-label="Insert Read More tag" value="more">--}}
{{--                                        <input type="button" id="qt_post_content_close" class="ed_button button button-small" title="Close all open tags" value="close tags">--}}
{{--                                    </div>--}}
{{--                                    <div id="mceu_24" class="mce-tinymce mce-container mce-panel" hidefocus="1" tabindex="-1" role="application" style="visibility: hidden; border-width: 1px; width: 100%;">--}}
{{--                                        <div id="mceu_24-body" class="mce-container-body mce-stack-layout">--}}
{{--                                            <div id="mceu_25" class="mce-top-part mce-container mce-stack-layout-item mce-first">--}}
{{--                                                <div id="mceu_25-body" class="mce-container-body">--}}
{{--                                                    <div id="mceu_26" class="mce-toolbar-grp mce-container mce-panel mce-first mce-last" hidefocus="1" tabindex="-1" role="group">--}}
{{--                                                        <div id="mceu_26-body" class="mce-container-body mce-stack-layout">--}}
{{--                                                            <div id="mceu_27" class="mce-container mce-toolbar mce-stack-layout-item mce-first" role="toolbar">--}}
{{--                                                                <div id="mceu_27-body" class="mce-container-body mce-flow-layout">--}}
{{--                                                                    <div id="mceu_28" class="mce-container mce-flow-layout-item mce-first mce-last mce-btn-group" role="group">--}}
{{--                                                                        <div id="mceu_28-body">--}}
{{--                                                                            <div id="mceu_0" class="mce-widget mce-btn mce-menubtn mce-fixed-width mce-listbox mce-first mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_0" role="button" aria-haspopup="true">--}}
{{--                                                                                <button id="mceu_0-open" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <span class="mce-txt">Paragraph</span>--}}
{{--                                                                                    <i class="mce-caret"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_1" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Bold (Ctrl+B)">--}}
{{--                                                                                <button id="mceu_1-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-bold"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_2" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Italic (Ctrl+I)">--}}
{{--                                                                                <button id="mceu_2-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-italic"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_3" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Bulleted list (Shift+Alt+U)">--}}
{{--                                                                                <button id="mceu_3-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-bullist"></i>--}}
{{--                                                                                </button></div><div id="mceu_4" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Numbered list (Shift+Alt+O)">--}}
{{--                                                                                <button id="mceu_4-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-numlist"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_5" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Blockquote (Shift+Alt+Q)">--}}
{{--                                                                                <button id="mceu_5-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-blockquote"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_6" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Align left (Shift+Alt+L)">--}}
{{--                                                                                <button id="mceu_6-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-alignleft"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_7" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Align center (Shift+Alt+C)">--}}
{{--                                                                                <button id="mceu_7-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-aligncenter"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_8" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Align right (Shift+Alt+R)">--}}
{{--                                                                                <button id="mceu_8-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-alignright"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_9" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Insert/edit link (Ctrl+K)">--}}
{{--                                                                                <button id="mceu_9-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-link"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_10" class="mce-widget mce-btn" tabindex="-1" role="button" aria-label="Insert Read More tag (Shift+Alt+T)">--}}
{{--                                                                                <button id="mceu_10-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-wp_more"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_11" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Fullscreen">--}}
{{--                                                                                <button id="mceu_11-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-fullscreen"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_12" class="mce-widget mce-btn mce-last" tabindex="-1" role="button" aria-label="Toolbar Toggle (Shift+Alt+Z)">--}}
{{--                                                                                <button id="mceu_12-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-wp_adv"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div id="mceu_29" class="mce-container mce-toolbar mce-stack-layout-item mce-last" role="toolbar" style="display: none;">--}}
{{--                                                                <div id="mceu_29-body" class="mce-container-body mce-flow-layout">--}}
{{--                                                                    <div id="mceu_30" class="mce-container mce-flow-layout-item mce-first mce-last mce-btn-group" role="group">--}}
{{--                                                                        <div id="mceu_30-body">--}}
{{--                                                                            <div id="mceu_13" class="mce-widget mce-btn mce-first" tabindex="-1" aria-pressed="false" role="button" aria-label="Strikethrough (Shift+Alt+D)">--}}
{{--                                                                                <button id="mceu_13-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-strikethrough"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_14" class="mce-widget mce-btn" tabindex="-1" role="button" aria-label="Horizontal line">--}}
{{--                                                                                <button id="mceu_14-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-hr"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_15" class="mce-widget mce-btn mce-splitbtn mce-colorbutton" role="button" tabindex="-1" aria-haspopup="true" aria-label="Text color">--}}
{{--                                                                                <button role="presentation" hidefocus="1" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-forecolor"></i>--}}
{{--                                                                                    <span id="mceu_15-preview" class="mce-preview"></span>--}}
{{--                                                                                </button>--}}
{{--                                                                                <button type="button" class="mce-open" hidefocus="1" tabindex="-1">--}}
{{--                                                                                    <i class="mce-caret"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_16" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Paste as text">--}}
{{--                                                                                <button id="mceu_16-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-pastetext"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_17" class="mce-widget mce-btn" tabindex="-1" role="button" aria-label="Clear formatting">--}}
{{--                                                                                <button id="mceu_17-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-removeformat"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_18" class="mce-widget mce-btn" tabindex="-1" role="button" aria-label="Special character">--}}
{{--                                                                                <button id="mceu_18-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-charmap"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_19" class="mce-widget mce-btn" tabindex="-1" role="button" aria-label="Decrease indent">--}}
{{--                                                                                <button id="mceu_19-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-outdent"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_20" class="mce-widget mce-btn" tabindex="-1" role="button" aria-label="Increase indent">--}}
{{--                                                                                <button id="mceu_20-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-indent"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_21" class="mce-widget mce-btn mce-disabled" tabindex="-1" role="button" aria-label="Undo (Ctrl+Z)" aria-disabled="true">--}}
{{--                                                                                <button id="mceu_21-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-undo"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_22" class="mce-widget mce-btn mce-disabled" tabindex="-1" role="button" aria-label="Redo (Ctrl+Y)" aria-disabled="true">--}}
{{--                                                                                <button id="mceu_22-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-redo"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div id="mceu_23" class="mce-widget mce-btn mce-last" tabindex="-1" role="button" aria-label="Keyboard Shortcuts (Shift+Alt+H)">--}}
{{--                                                                                <button id="mceu_23-button" role="presentation" type="button" tabindex="-1">--}}
{{--                                                                                    <i class="mce-ico mce-i-wp_help"></i>--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div id="mceu_31" class="mce-edit-area mce-container mce-panel mce-stack-layout-item" hidefocus="1" tabindex="-1" role="group" style="border-width: 1px 0px 0px;">--}}
{{--                                                <iframe id="post_content_ifr" frameborder="0" allowtransparency="true" title="Rich Text Area. Press Alt-Shift-H for help." style="width: 100%; height: 434px; display: block;"></iframe>--}}
{{--                                            </div>--}}
{{--                                            <div id="mceu_32" class="mce-statusbar mce-container mce-panel mce-stack-layout-item mce-last" hidefocus="1" tabindex="-1" role="group" style="border-width: 1px 0px 0px;">--}}
{{--                                                <div id="mceu_32-body" class="mce-container-body mce-flow-layout"><div id="mceu_33" class="mce-path mce-flow-layout-item mce-first">--}}
{{--                                                        <div class="mce-path-item">&nbsp;--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div id="mceu_34" class="mce-flow-layout-item mce-last mce-resizehandle">--}}
{{--                                                        <i class="mce-ico mce-i-resize"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <textarea class="wp-editor-area" style="height: 400px; display: none;" autocomplete="off" cols="40" name="post_content" id="post_content" aria-hidden="true"></textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <p>--}}
{{--                            </p>--}}
{{--                            <p class="text-center">--}}
{{--                                <input type="hidden" id="post_nonce_field" name="post_nonce_field" value="7c17bdae85">--}}
{{--                                <input type="hidden" name="_wp_http_referer" value="/woffice/business/wiki-page/">--}}
{{--                                <input type="hidden" name="submitted" id="submitted" value="true">--}}
{{--                                <button type="submit" id="woffice-frontend-submit" class="btn btn-default">--}}
{{--                                    <i class="fa fa-pencil-alt"></i>--}}
{{--                                    Create Wiki--}}
{{--                                </button>--}}
{{--                            </p>--}}
{{--                        </form>--}}
{{--                        <div class="center">--}}
{{--                            <a href="#" class="btn btn-default frontend-wrapper__toggle my-0" data-action="hide" id="hide-wiki-create">--}}
{{--                                <i class="fa fa-arrow-left"></i>--}}
{{--                                Go Back--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </article>
        </div>
    </div>
    <!-- END #content-container -->
@endsection
