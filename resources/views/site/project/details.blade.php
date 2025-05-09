@extends('layouts.site.app')

@section('content')
<header id="featuredbox" class="centered ">
    <div class="pagetitle animate-me fadeIn">
        <h1 class="entry-title">
            {{ $project->name }}
        </h1>
    </div>
    <!-- .pagetitle -->
    <div class="featured-background"
        style="background-image: url({{ asset('site/theme/wp-content/uploads/2016/12/MAIN.jpg') }})">
        <div class="featured-layer d-block"></div>
    </div>
</header>

<div id="content-container">
    <!-- START CONTENT -->
    <div id="content">
        <article id="post-1291"
            class="box content woffice-tab-layout post-1291 project type-project status-publish project-category-marketing">
            <div id="project-nav" class="intern-box">
                <div class="item-list-tabs-project">
                    <ul class="woffice-tab-layout__nav">
                        <li id="project-tab-view" class="active" data-tab="view">
                            <a href="#project-content-view" class="fa-file">
                                View
                            </a>
                        </li>
                        {{-- <li id="project-tab-todo" data-tab="todo" class="">--}}
                            {{-- <a href="#project-content-todo" class="fa-clipboard-list">--}}
                                {{-- Todo--}}
                                {{-- </a>--}}
                            {{-- </li>--}}
                        <li id="project-tab-maintenance-histories" data-tab="maintenance-histories">
                            <a href="#project-content-maintenance-histories" class="fa-wrench">
                                Maintenance<br />History
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="project-tabs-wrapper woffice-tab-layout__content intern-padding">

                <!--View Project Basic Info -->
                <div id="project-content-view" class="woffice-tab-layout__tab" data-tab="view">
                    <header id="project-meta" class="border-0 rounded">
                        <div class="progress project-progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                aria-valuemax="100"
                                style="width: '{{ \App\Models\Project::getProjectCompletion($project->status) }}%'">
                                <span class="progress-current">
                                    <i class="fa fa-tasks"></i> {{
                                    \App\Models\Project::getProjectCompletion($project->status) }} %
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <ul class="project-meta-list">
                                    <li class="project-meta-date">
                                        Website Service Expiry At: <br />{{ ($project->website_services_expiry_at) }}
                                    </li>
                                    <li class="project-meta-category">
                                        <a href="#" rel="tag">
                                            {{ \App\Models\Package::getPackageName($project->package_id) }}
                                        </a>
                                    </li>
                                    <span class="project-status badge badge-pill planned">
                                        <i class="fa fa-book pr-2"></i>
                                        {{ \App\Models\Project::getProjectStatusName($project->status) }}
                                    </span>
                                </ul>
                            </div>

                            <div class="col-md-4">
                                <ul class="project-meta-list">
                                    <li class="project-meta-date">
                                        Last Updated At: <br />{{ ($project->updated_at) }}
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-4">
                                <ul class="project-meta-list">
                                    <li class="project-meta-links">
                                        <a href="{{ $project->server_url }}" target="_blank">Server URL Links</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </header>

                    <div class="intern-padding">
                        {!! $project->description !!}
                    </div>

                    <!--Project info-->
                    <div id="buddypress" class="buddypress-wrap bp-dir-hori-nav">
                        <div id="item-body" class="item-body">
                            <!--Basic Info-->
                            <div class="bp-widget social">
                                <h3 class="screen-heading profile-group-title">
                                    Basic Info
                                </h3>

                                <table class="profile-fields bp-tables-user">
                                    <tbody>
                                        <tr
                                            class="field_1 field_location optional-field visibility-adminsonly field_type_textbox">
                                            <td class="label">
                                                Maintenance ( Hours ) <br /> Max {{ $package->website_maintenance }}
                                                hours
                                            </td>
                                            <td class="data">
                                                <p>
                                                    {{ $project->maintenance }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr
                                            class="field_2 field_location optional-field visibility-adminsonly alt field_type_textbox">
                                            <td class="label">
                                                Revision ( Times ) <br /> Max {{ $package->revisions }} times
                                            </td>
                                            <td class="data">
                                                <p>
                                                    {{ $project->revision }}
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br />
                            <br />

                            <!--Access Info-->
                            <div class="bp-widget social">
                                <h3 class="screen-heading profile-group-title">
                                    Login Access Info
                                </h3>

                                <table class="profile-fields bp-tables-user">
                                    <tbody>
                                        <tr
                                            class="field_1 field_location optional-field visibility-adminsonly field_type_textbox">
                                            <td class="label">
                                                Server URL
                                            </td>
                                            <td class="data">
                                                <p>
                                                    <a href="{{ $project->server_url }}" target="_blank">
                                                        {{ $project->server_url }}
                                                    </a>
                                                </p>
                                            </td>
                                        </tr>

                                        <tr
                                            class="field_2 field_location optional-field visibility-adminsonly alt field_type_textbox">
                                            <td class="label">
                                                Server Username
                                            </td>
                                            <td class="data">
                                                <p>
                                                    {{ $project->server_username }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr
                                            class="field_3 field_facebook optional-field visibility-adminsonly  field_type_textbox">
                                            <td class="label">
                                                Server Password
                                            </td>
                                            <td class="data">
                                                <p>
                                                    {{ $project->server_password }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr
                                            class="field_4 field_twitter optional-field visibility-adminsonly alt field_type_textbox">
                                            <td class="label">Wordpress URL</td>
                                            <td class="data">
                                                <p>
                                                    <a href="{{ $project->wordpress_url }}" rel="nofollow">
                                                        {{ $project->wordpress_url }}
                                                    </a>
                                                </p>
                                            </td>
                                        </tr>

                                        <tr
                                            class="field_5 field_linkedin optional-field visibility-adminsonly field_type_textbox">
                                            <td class="label">
                                                Wordpress Username
                                            </td>
                                            <td class="data">
                                                <p>
                                                    {{ $project->wordpress_username }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr
                                            class="field_6 field_slack optional-field visibility-adminsonly alt field_type_textbox">
                                            <td class="label">Wordpress Password</td>
                                            <td class="data">
                                                <p>
                                                    {{ $project->wordpress_password }}
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br />
                            <br />

                            <!--Date Expiry-->
                            <!--div class="bp-widget social">
                                    <h3 class="screen-heading profile-group-title">
                                        Date Expiry Info
                                    </h3>

                                    <table class="profile-fields bp-tables-user">
                                        <tbody>
                                            @if( isset($project->website_services_expiry_at) )
                                            <tr class="field_1 field_location optional-field visibility-adminsonly field_type_textbox">
                                                <td class="label">
                                                    Website Service Expiry At
                                                </td>
                                                <td class="data">
                                                    <p>{{ getDateDDMMYYYY($project->website_services_expiry_at) }}</p>
                                                </td>
                                            </tr>
                                            @endif

                                            @if( isset($project->hosting_expiry_at) )
                                            <tr class="field_2 field_location optional-field visibility-adminsonly alt field_type_textbox">
                                                <td class="label">
                                                    Hosting Expiry At
                                                </td>
                                                <td class="data">
                                                    <p>{{ getDateDDMMYYYY($project->hosting_expiry_at) }}</p>
                                                </td>
                                            </tr>
                                            @endif

                                            @if( isset($project->domain_expiry_at) )
                                            <tr class="field_3 field_facebook optional-field visibility-adminsonly  field_type_textbox">
                                                <td class="label">
                                                    Domain Expiry At
                                                </td>
                                                <td class="data">
                                                    <p>{{ getDateDDMMYYYY($project->domain_expiry_at) }}</p>
                                                </td>
                                            </tr>
                                            @endif

                                            @if( isset($project->seo_expiry_at) )
                                            <tr class="field_4 field_twitter optional-field visibility-adminsonly alt field_type_textbox">
                                                <td class="label">
                                                    SEO Expiry At
                                                </td>
                                                <td class="data">
                                                    <p>
                                                        {{ getDateDDMMYYYY($project->seo_expiry_at) }}
                                                    </p>
                                                </td>
                                            </tr>
                                            @endif

                                            @if( isset($project->website_maintenance_expiry_at) )
                                            <tr class="field_5 field_linkedin optional-field visibility-adminsonly field_type_textbox">
                                                <td class="label">
                                                    Website Maintenance Expiry At
                                                </td>
                                                <td class="data">
                                                    <p>
                                                        {{ getDateDDMMYYYY($project->website_maintenance_expiry_at) }}
                                                    </p>
                                                </td>
                                            </tr>
                                            @endif

                                            @if( isset($project->facebook_service_expiry_at) )
                                            <tr class="field_6 field_slack optional-field visibility-adminsonly alt field_type_textbox">
                                                <td class="label">Facebook Service Expiry At</td>
                                                <td class="data">
                                                    <p>
                                                        {{ getDateDDMMYYYY($project->facebook_service_expiry_at) }}
                                                    </p>
                                                </td>
                                            </tr>
                                            @endif

                                            @if( isset($project->google_ads_expiry_at) )
                                            <tr class="field_6 field_slack optional-field visibility-adminsonly field_type_textbox">
                                                <td class="label">Google Ads Expiry At</td>
                                                <td class="data">
                                                    <p>
                                                        {{ getDateDDMMYYYY($project->google_ads_expiry_at) }}
                                                    </p>
                                                </td>
                                            </tr>
                                            @endif

                                            @if( isset($project->other_expiry_at) )
                                            <tr class="field_6 field_slack optional-field visibility-adminsonly alt field_type_textbox">
                                                <td class="label">Other Expiry At</td>
                                                <td class="data">
                                                    <p>
                                                        {{ getDateDDMMYYYY($project->other_expiry_at) }}
                                                    </p>
                                                </td>
                                            </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div-->
                        </div>
                    </div>
                </div>

                <!-- To Do Task -->
                {{-- <div id="project-content-todo" data-tab="todo" class="woffice-tab-layout__tab d-none">--}}
                    {{-- <div id="woffice-project-todo" class="woffice-project-todo-group">--}}
                        {{-- <div class="woffice-project-filters clearfix">--}}
                            {{-- <ul class="list-inline float-left">--}}
                                {{-- <li class="list-inline-item">--}}
                                    {{-- <a href="#" class="is-on">All</a>--}}
                                    {{-- </li>--}}
                                {{-- <li class="list-inline-item">--}}
                                    {{-- <a href="#" class="">--}}
                                        {{-- Active--}}
                                        {{-- </a>--}}
                                    {{-- </li>--}}
                                {{-- <li class="list-inline-item">--}}
                                    {{-- <a href="#" class="">--}}
                                        {{-- Urgent--}}
                                        {{-- </a>--}}
                                    {{-- </li>--}}
                                {{-- <li class="list-inline-item">--}}
                                    {{-- <a href="#" class="">--}}
                                        {{-- Completed--}}
                                        {{-- </a>--}}
                                    {{-- </li>--}}
                                {{-- </ul>--}}
                            {{-- <div class="float-right">--}}
                                {{-- <select name="woffice-project-date-filter" id="woffice-project-date-filter">--}}
                                    {{-- <option value="no">--}}
                                        {{-- Order by--}}
                                        {{-- </option>--}}
                                    {{-- <option value="desc_due_date">--}}
                                        {{-- Descending due date--}}
                                        {{-- </option>--}}
                                    {{-- <option value="asc_due_date">Ascending due date</option>
                                    <option value="desc_completion_date">Descending completion date</option>
                                    <option value="asc_completion_date">Ascending completion date</option>
                                </select></div>
                        </div>
                        <div class="tiny-alert tiny-alert-success" style="display: none;"><i
                                class="fa fa-check-circle"></i>--}}
                            {{-- Done!--}}
                            {{-- </div>--}}
                        {{-- <div class="tiny-alert tiny-alert-error" style="display: none;">--}}
                            {{-- <i class="fa fa-times-circle"></i>--}}
                            {{-- Something went wrong!--}}
                            {{-- </div>--}}
                        {{-- <div class="text-center" style="display: none;">--}}
                            {{-- <div class="special-404 text-center">--}}
                                {{-- <i class="fa fa-list-ul"></i>--}}
                                {{-- <h2>--}}
                                    {{-- No to-do created so far.--}}
                                    {{-- </h2>--}}
                                {{-- </div>--}}
                            {{-- </div>--}}
                        {{-- <div class="woffice-tasks-wrapper mb-4">--}}
                            {{-- <div class="woffice-task has-note is-done">--}}
                                {{-- <header>--}}
                                    {{-- <div class="drag-handle">--}}
                                        {{-- <i class="fa fa-bars"></i>--}}
                                        {{-- </div>--}}
                                    {{-- <label class="woffice-todo-label">--}}
                                        {{-- <i class="fa fa-check-square"></i>--}}
                                        {{-- <span>--}}
                                            {{-- Front end design--}}
                                            {{-- </span>--}}
                                        {{-- </label>--}}
                                    {{-- <a href="#" class="woffice-todo-action woffice-todo-note">--}}
                                        {{-- <i class="fas fa-file-text"></i>--}}
                                        {{-- </a>--}}
                                    {{-- <span>--}}
                                        {{-- <span>--}}

                                            {{-- </span>--}}
                                        {{-- </span>--}}
                                    {{-- <span class="todo-date">--}}
                                        {{-- <i class="fa fa-calendar"></i>--}}
                                        {{-- <b>--}}
                                            {{-- February 29, 2016--}}
                                            {{-- </b>--}}
                                        {{-- </span>--}}
                                    {{-- <span class="todo-urgent" style="display: none;">--}}
                                        {{-- <i class="fa fa-bookmark"></i>--}}
                                        {{-- </span>--}}
                                    {{-- </header>--}}
                                {{-- <section class="todo-note" style="display: none;">--}}
                                    {{-- <p>--}}
                                        {{-- Lorem ipsum--}}
                                        {{-- </p>--}}
                                    {{-- </section>--}}
                                {{-- <section class="todo-edit" style="display: none;">--}}
                                    {{-- <form class="woffice-task-form">--}}
                                        {{-- <div class="row">--}}
                                            {{-- <div class="col-md-6">--}}
                                                {{-- <label for="todo_name">--}}
                                                    {{-- Name--}}
                                                    {{-- </label>--}}
                                                {{-- <input type="text" name="todo_name" required="required">--}}
                                                {{-- </div>--}}
                                            {{-- <div class="col-md-6">--}}
                                                {{-- <label for="todo_date">--}}
                                                    {{-- Due date--}}
                                                    {{-- </label>--}}
                                                {{-- <input type="text" name="todo_date" class="datepicker">--}}
                                                {{-- </div>--}}
                                            {{-- </div>--}}
                                        {{-- <div class="row">--}}
                                            {{-- <div class="col-md-6 woffice-add-todo-note">--}}
                                                {{-- <label for="todo_note">--}}
                                                    {{-- Add a note (optional)--}}
                                                    {{-- </label>--}}
                                                {{-- <textarea rows="2" name="todo_note"></textarea>--}}
                                                {{-- </div>--}}
                                            {{-- <div class="col-md-6 woffice-add-todo-assigned">--}}
                                                {{-- <div class="auto-fetch-members-wrapper">--}}
                                                    {{-- <label>--}}
                                                        {{-- Assign a user (tip: type the username)--}}
                                                        {{-- </label>--}}
                                                    {{-- <input type="text" placeholder="Look for a username">--}}
                                                    {{-- <ul class="potential-users"></ul>--}}
                                                    {{-- </div>--}}
                                                {{-- <ul class="project-users"></ul>--}}
                                                {{-- </div>--}}
                                            {{-- </div>--}}
                                        {{-- <div class="clearfix">--}}
                                            {{-- <div class="float-left">--}}
                                                {{-- <label for="todo_urgent">--}}
                                                    {{-- Is it urgent?--}}
                                                    {{-- </label>--}}
                                                {{-- <input type="checkbox" id="todo_urgent" name="todo_urgent">--}}
                                                {{-- </div>--}}
                                            {{-- <div class="text-right">--}}
                                                {{-- <button href="#" type="submit" class="btn btn-default">--}}
                                                    {{-- <i class="fa fa-pencil-alt"></i>--}}
                                                    {{-- Edit task--}}
                                                    {{-- </button>--}}
                                                {{-- </div>--}}
                                            {{-- </div>--}}
                                        {{-- </form>--}}
                                    {{-- </section>--}}
                                {{-- </div>--}}
                            {{-- <div class="woffice-task has-note is-done">--}}
                                {{-- <header>--}}
                                    {{-- <div class="drag-handle">--}}
                                        {{-- <i class="fa fa-bars"></i>--}}
                                        {{-- </div>--}}
                                    {{-- <label class="woffice-todo-label">--}}
                                        {{-- <input type="checkbox" name="woffice-todo-done">--}}
                                        {{-- <span class="checkbox-style"></span>--}}
                                        {{-- <span>Wireframe design</span>--}}
                                        {{-- </label>--}}
                                    {{-- <a href="#" class="woffice-todo-action woffice-todo-note">--}}
                                        {{-- <i class="fas fa-file-text"></i>--}}
                                        {{-- </a>--}}
                                    {{-- <span>--}}
                                        {{-- <span>--}}
                                            {{-- <span class="todo-assigned">--}}
                                                {{-- <a href="https://demos.alkalab.com/woffice/business/members/demo/"
                                                    class="clearfix">--}}
                                                    {{-- <img alt=""
                                                        src="https://demos.alkalab.com/woffice/business/wp-content/uploads/avatars/3/58ecd943d58d5-bpfull.jpg"
                                                        srcset="https://demos.alkalab.com/woffice/business/wp-content/uploads/avatars/3/58ecd943d58d5-bpfull.jpg 2x"
                                                        class="avatar avatar-96 photo" height="96" width="96">--}}
                                                    {{-- </a>--}}
                                                {{-- </span>--}}
                                            {{-- <span class="todo-assigned"><a
                                                    href="https://demos.alkalab.com/woffice/business/members/demo2/"
                                                    class="clearfix">--}}
                                                    {{-- <img alt=""
                                                        src="https://demos.alkalab.com/woffice/business/wp-content/uploads/avatars/2/4e87e06143afc75303f83f44af6aa578-bpfull.jpg"
                                                        srcset="https://demos.alkalab.com/woffice/business/wp-content/uploads/avatars/2/4e87e06143afc75303f83f44af6aa578-bpfull.jpg 2x"
                                                        class="avatar avatar-96 photo" height="96" width="96">--}}
                                                    {{-- </a>--}}
                                                {{-- </span>--}}
                                            {{-- </span>--}}
                                        {{-- </span>--}}
                                    {{-- <span class="todo-date">--}}
                                        {{-- <i class="fa fa-calendar"></i>--}}
                                        {{-- <b>February 12, 2016</b>--}}
                                        {{-- </span>--}}
                                    {{-- <span class="todo-urgent" style="display: none;">--}}
                                        {{-- <i class="fa fa-bookmark"></i>--}}
                                        {{-- </span>--}}
                                    {{-- </header>--}}
                                {{-- <section class="todo-note" style="display: none;">--}}
                                    {{-- <p>Lorem ipsum</p>--}}
                                    {{-- </section>--}}
                                {{-- <section class="todo-edit" style="display: none;">--}}
                                    {{-- <form class="woffice-task-form">--}}
                                        {{-- <div class="row">--}}
                                            {{-- <div class="col-md-6">--}}
                                                {{-- <label for="todo_name">--}}
                                                    {{-- Name--}}
                                                    {{-- </label>--}}
                                                {{-- <input type="text" name="todo_name" required="required"></div>--}}
                                            {{-- <div class="col-md-6">--}}
                                                {{-- <label for="todo_date">--}}
                                                    {{-- Due date--}}
                                                    {{-- </label>--}}
                                                {{-- <input type="text" name="todo_date" class="datepicker">--}}
                                                {{-- </div>--}}
                                            {{-- </div>--}}
                                        {{-- <div class="row">--}}
                                            {{-- <div class="col-md-6 woffice-add-todo-note">--}}
                                                {{-- <label for="todo_note">--}}
                                                    {{-- Add a note (optional)--}}
                                                    {{-- </label>--}}
                                                {{-- <textarea rows="2" name="todo_note"></textarea>--}}
                                                {{-- </div>--}}
                                            {{-- <div class="col-md-6 woffice-add-todo-assigned">--}}
                                                {{-- <div class="auto-fetch-members-wrapper">--}}
                                                    {{-- <label>--}}
                                                        {{-- Assign a user (tip: type the username)--}}
                                                        {{-- </label>--}}
                                                    {{-- <input type="text" placeholder="Look for a username">--}}
                                                    {{-- <ul class="potential-users">--}}
                                                        {{-- </ul>--}}
                                                    {{-- </div>--}}
                                                {{-- <ul class="project-users">--}}
                                                    {{-- <li>--}}
                                                        {{-- <span>--}}
                                                            {{-- demo--}}
                                                            {{-- </span>--}}
                                                        {{-- <a href="#" class="fa fa-times">--}}
                                                            {{-- </a>--}}
                                                        {{-- </li>--}}
                                                    {{-- <li>--}}
                                                        {{-- <span>--}}
                                                            {{-- demo2--}}
                                                            {{-- </span>--}}
                                                        {{-- <a href="#" class="fa fa-times"></a>--}}
                                                        {{-- </li>--}}
                                                    {{-- </ul>--}}
                                                {{-- </div>--}}
                                            {{-- </div>--}}
                                        {{-- <div class="clearfix">--}}
                                            {{-- <div class="float-left">--}}
                                                {{-- <label for="todo_urgent">--}}
                                                    {{-- Is it urgent?--}}
                                                    {{-- </label>--}}
                                                {{-- <input type="checkbox" id="todo_urgent" name="todo_urgent">--}}
                                                {{-- </div>--}}
                                            {{-- <div class="text-right">--}}
                                                {{-- <button href="#" type="submit" class="btn btn-default">--}}
                                                    {{-- <i class="fa fa-pencil-alt"></i>--}}
                                                    {{-- Edit task--}}
                                                    {{-- </button>--}}
                                                {{-- </div>--}}
                                            {{-- </div>--}}
                                        {{-- </form>--}}
                                    {{-- </section>--}}
                                {{-- </div>--}}
                            {{-- <div class="woffice-task has-note is-done">--}}
                                {{-- <header>--}}
                                    {{-- <div class="drag-handle">--}}
                                        {{-- <i class="fa fa-bars"></i>--}}
                                        {{-- </div>--}}
                                    {{-- <label class="woffice-todo-label">--}}
                                        {{-- <input type="checkbox" name="woffice-todo-done">--}}
                                        {{-- <span class="checkbox-style"></span>--}}
                                        {{-- <span>--}}
                                            {{-- Marketing planning--}}
                                            {{-- </span>--}}
                                        {{-- </label>--}}
                                    {{-- <a href="#" class="woffice-todo-action woffice-todo-note">--}}
                                        {{-- <i class="fas fa-file-text"></i>--}}
                                        {{-- </a>--}}
                                    {{-- <span>--}}
                                        {{-- <span>--}}
                                            {{-- <span class="todo-assigned">--}}
                                                {{-- <a href="https://demos.alkalab.com/woffice/business/members/demo/"
                                                    class="clearfix">--}}
                                                    {{-- <img alt=""
                                                        src="https://demos.alkalab.com/woffice/business/wp-content/uploads/avatars/3/58ecd943d58d5-bpfull.jpg"
                                                        srcset="https://demos.alkalab.com/woffice/business/wp-content/uploads/avatars/3/58ecd943d58d5-bpfull.jpg 2x"
                                                        class="avatar avatar-96 photo" height="96"
                                                        width="96"></a></span></span></span> <span class="todo-date"><i
                                            class="fa fa-calendar"></i><b>March 16, 2016</b></span> <span
                                        class="todo-urgent" style="display: none;"><i class="fa fa-bookmark"></i></span>
                                </header>
                                <section class="todo-note" style="display: none;">--}}
                                    {{-- <p>--}}
                                        {{-- Lorem ipsum--}}
                                        {{-- </p>--}}
                                    {{-- </section>--}}
                                {{-- <section class="todo-edit" style="display: none;">--}}
                                    {{-- <form class="woffice-task-form">--}}
                                        {{-- <div class="row">--}}
                                            {{-- <div class="col-md-6">--}}
                                                {{-- <label for="todo_name">--}}
                                                    {{-- Name--}}
                                                    {{-- </label>--}}
                                                {{-- <input type="text" name="todo_name" required="required">--}}
                                                {{-- </div>--}}
                                            {{-- <div class="col-md-6">--}}
                                                {{-- <label for="todo_date">--}}
                                                    {{-- Due date--}}
                                                    {{-- </label>--}}
                                                {{-- <input type="text" name="todo_date" class="datepicker">--}}
                                                {{-- </div>--}}
                                            {{-- </div>--}}
                                        {{-- <div class="row">--}}
                                            {{-- <div class="col-md-6 woffice-add-todo-note">--}}
                                                {{-- <label for="todo_note">--}}
                                                    {{-- Add a note (optional)--}}
                                                    {{-- </label>--}}
                                                {{-- <textarea rows="2" name="todo_note"></textarea>--}}
                                                {{-- </div>--}}
                                            {{-- <div class="col-md-6 woffice-add-todo-assigned">--}}
                                                {{-- <div class="auto-fetch-members-wrapper">--}}
                                                    {{-- <label>--}}
                                                        {{-- Assign a user (tip: type the username)--}}
                                                        {{-- </label>--}}
                                                    {{-- <input type="text" placeholder="Look for a username">--}}
                                                    {{-- <ul class="potential-users"></ul>--}}
                                                    {{-- </div>--}}
                                                {{-- <ul class="project-users">--}}
                                                    {{-- <li>--}}
                                                        {{-- <span>--}}
                                                            {{-- demo--}}
                                                            {{-- </span>--}}
                                                        {{-- <a href="#" class="fa fa-times"></a>--}}
                                                        {{-- </li>--}}
                                                    {{-- </ul>--}}
                                                {{-- </div>--}}
                                            {{-- </div>--}}
                                        {{-- <div class="clearfix">--}}
                                            {{-- <div class="float-left">--}}
                                                {{-- <label for="todo_urgent">--}}
                                                    {{-- Is it urgent?--}}
                                                    {{-- </label>--}}
                                                {{-- <input type="checkbox" id="todo_urgent" name="todo_urgent">--}}
                                                {{-- </div>--}}
                                            {{-- <div class="text-right">--}}
                                                {{-- <button href="#" type="submit" class="btn btn-default">--}}
                                                    {{-- <i class="fa fa-pencil-alt"></i>--}}
                                                    {{-- Edit task--}}
                                                    {{-- </button>--}}
                                                {{-- </div>--}}
                                            {{-- </div>--}}
                                        {{-- </form>--}}
                                    {{-- </section>--}}
                                {{--
                            </div>--}}
                            {{-- <div class="woffice-task is-done">--}}
                                {{-- <header>--}}
                                    {{-- <div class="drag-handle">--}}
                                        {{-- <i class="fa fa-bars"></i>--}}
                                        {{-- </div>--}}
                                    {{-- <label class="woffice-todo-label">--}}
                                        {{-- <i class="fa fa-check-square"></i>--}}
                                        {{-- <span>--}}
                                            {{-- Back end features--}}
                                            {{-- </span>--}}
                                        {{-- </label>--}}
                                    {{-- <a href="#" class="woffice-todo-action woffice-todo-note"
                                        style="display: none;">--}}
                                        {{-- <i class="fas fa-file-text"></i>--}}
                                        {{-- </a>--}}
                                    {{-- <span>--}}
                                        {{-- <span></span>--}}
                                        {{-- </span>--}}
                                    {{-- <span class="todo-date" style="display: none;">--}}
                                        {{-- <i class="fa fa-calendar"></i>--}}
                                        {{-- <b>--}}
                                            {{-- October 3, 2019--}}
                                            {{-- </b>--}}
                                        {{-- </span>--}}
                                    {{-- <span class="todo-urgent" style="display: none;">--}}
                                        {{-- <i class="fa fa-bookmark"></i>--}}
                                        {{-- </span>--}}
                                    {{-- </header>--}}
                                {{-- <section class="todo-note" style="display: none;">--}}
                                    {{-- <p></p>--}}
                                    {{-- </section>--}}
                                {{-- <section class="todo-edit" style="display: none;">--}}
                                    {{-- <form class="woffice-task-form">--}}
                                        {{-- <div class="row">--}}
                                            {{-- <div class="col-md-6">--}}
                                                {{-- <label for="todo_name">--}}
                                                    {{-- Name--}}
                                                    {{-- </label>--}}
                                                {{-- <input type="text" name="todo_name" required="required">--}}
                                                {{-- </div>--}}
                                            {{-- <div class="col-md-6">--}}
                                                {{-- <label for="todo_date">--}}
                                                    {{-- Due date--}}
                                                    {{-- </label>--}}
                                                {{-- <input type="text" name="todo_date" class="datepicker">--}}
                                                {{-- </div>--}}
                                            {{-- </div>--}}
                                        {{-- <div class="row">--}}
                                            {{-- <div class="col-md-6 woffice-add-todo-note">--}}
                                                {{-- <label for="todo_note">--}}
                                                    {{-- Add a note (optional)--}}
                                                    {{-- </label>--}}
                                                {{-- <textarea rows="2" name="todo_note"></textarea>--}}
                                                {{-- </div>--}}
                                            {{-- <div class="col-md-6 woffice-add-todo-assigned">--}}
                                                {{-- <div class="auto-fetch-members-wrapper">--}}
                                                    {{-- <label>--}}
                                                        {{-- Assign a user (tip: type the username)--}}
                                                        {{-- </label>--}}
                                                    {{-- <input type="text" placeholder="Look for a username">--}}
                                                    {{-- <ul class="potential-users">--}}

                                                        {{-- </ul>--}}
                                                    {{-- </div>--}}
                                                {{-- <ul class="project-users"></ul>--}}
                                                {{-- </div>--}}
                                            {{-- </div>--}}
                                        {{-- <div class="clearfix">--}}
                                            {{-- <div class="float-left">--}}
                                                {{-- <label for="todo_urgent">--}}
                                                    {{-- Is it urgent?--}}
                                                    {{-- </label>--}}
                                                {{-- <input type="checkbox" id="todo_urgent" name="todo_urgent">--}}
                                                {{-- </div>--}}
                                            {{-- <div class="text-right">--}}
                                                {{-- <button href="#" type="submit" class="btn btn-default">--}}
                                                    {{-- <i class="fa fa-pencil-alt"></i>--}}
                                                    {{-- Edit task--}}
                                                    {{-- </button>--}}
                                                {{-- </div>--}}
                                            {{-- </div>--}}
                                        {{-- </form>--}}
                                    {{-- </section>--}}
                                {{-- </div>--}}
                            {{-- <div class="woffice-task has-note is-done">--}}
                                {{-- <header>--}}
                                    {{-- <div class="drag-handle">--}}
                                        {{-- <i class="fa fa-bars"></i>--}}
                                        {{-- </div>--}}
                                    {{-- <label class="woffice-todo-label">--}}
                                        {{-- <i class="fa fa-check-square"></i>--}}
                                        {{-- <span>--}}
                                            {{-- Product lunch--}}
                                            {{-- </span>--}}
                                        {{-- </label>--}}
                                    {{-- <a href="#" class="woffice-todo-action woffice-todo-note">--}}
                                        {{-- <i class="fas fa-file-text"></i>--}}
                                        {{-- </a>--}}
                                    {{-- <span>--}}
                                        {{-- <span>--}}
                                            {{-- <span class="todo-assigned">--}}
                                                {{-- <a href="https://demos.alkalab.com/woffice/business/members/demo2/"
                                                    class="clearfix">--}}
                                                    {{-- <img alt=""
                                                        src="https://demos.alkalab.com/woffice/business/wp-content/uploads/avatars/2/4e87e06143afc75303f83f44af6aa578-bpfull.jpg"
                                                        srcset="https://demos.alkalab.com/woffice/business/wp-content/uploads/avatars/2/4e87e06143afc75303f83f44af6aa578-bpfull.jpg 2x"
                                                        class="avatar avatar-96 photo" height="96" width="96">--}}
                                                    {{-- </a>--}}
                                                {{-- </span>--}}
                                            {{-- </span>--}}
                                        {{-- </span>--}}
                                    {{-- <span class="todo-date">--}}
                                        {{-- <i class="fa fa-calendar"></i>--}}
                                        {{-- <b>March 19, 2016</b>--}}
                                        {{-- </span>--}}
                                    {{-- <span class="todo-urgent" style="display: none;">--}}
                                        {{-- <i class="fa fa-bookmark"></i>--}}
                                        {{-- </span>--}}
                                    {{-- </header>--}}
                                {{-- <section class="todo-note" style="display: none;">--}}
                                    {{-- <p>Good luck!</p>--}}
                                    {{-- </section>--}}
                                {{-- <section class="todo-edit" style="display: none;">--}}
                                    {{-- <form class="woffice-task-form">--}}
                                        {{-- <div class="row">--}}
                                            {{-- <div class="col-md-6">--}}
                                                {{-- <label for="todo_name">--}}
                                                    {{-- Name--}}
                                                    {{-- </label>--}}
                                                {{-- <input type="text" name="todo_name" required="required">--}}
                                                {{-- </div>--}}
                                            {{-- <div class="col-md-6">--}}
                                                {{-- <label for="todo_date">--}}
                                                    {{-- Due date--}}
                                                    {{-- </label>--}}
                                                {{-- <input type="text" name="todo_date" class="datepicker">--}}
                                                {{-- </div>--}}
                                            {{-- </div>--}}
                                        {{-- <div class="row">--}}
                                            {{-- <div class="col-md-6 woffice-add-todo-note">--}}
                                                {{-- <label for="todo_note">--}}
                                                    {{-- Add a note (optional)--}}
                                                    {{-- </label>--}}
                                                {{-- <textarea rows="2" name="todo_note"></textarea>--}}
                                                {{-- </div>--}}
                                            {{-- <div class="col-md-6 woffice-add-todo-assigned">--}}
                                                {{-- <div class="auto-fetch-members-wrapper">--}}
                                                    {{-- <label>--}}
                                                        {{-- Assign a user (tip: type the username)--}}
                                                        {{-- </label>--}}
                                                    {{-- <input type="text" placeholder="Look for a username">--}}
                                                    {{-- <ul class="potential-users">--}}
                                                        {{-- </ul>--}}
                                                    {{-- </div>--}}
                                                {{-- <ul class="project-users">--}}
                                                    {{-- <li>--}}
                                                        {{-- <span>--}}
                                                            {{-- demo2--}}
                                                            {{-- </span>--}}
                                                        {{-- <a href="#" class="fa fa-times"></a>--}}
                                                        {{-- </li>--}}
                                                    {{-- </ul>--}}
                                                {{-- </div>--}}
                                            {{-- </div>--}}
                                        {{-- <div class="clearfix">--}}
                                            {{-- <div class="float-left">--}}
                                                {{-- <label for="todo_urgent">--}}
                                                    {{-- Is it urgent?--}}
                                                    {{-- </label>--}}
                                                {{-- <input type="checkbox" id="todo_urgent" name="todo_urgent">--}}
                                                {{-- </div>--}}
                                            {{-- <div class="text-right">--}}
                                                {{-- <button href="#" type="submit" class="btn btn-default">--}}
                                                    {{-- <i class="fa fa-pencil-alt"></i>--}}
                                                    {{-- Edit task--}}
                                                    {{-- </button>--}}
                                                {{-- </div>--}}
                                            {{-- </div>--}}
                                        {{-- </form>--}}
                                    {{-- </section>--}}
                                {{-- </div>--}}
                            {{-- </div>--}}
                        {{--
                    </div>--}}
                    {{-- </div>--}}
                

                <!--Comment-->
                {{-- <div id="project-content-comments" class="woffice-tab-layout__tab d-none" data-tab="comments">--}}
                    {{-- <div id="comments-container" class="box">--}}
                        {{-- <div class="intern-padding">--}}

                            {{-- <!-- THE TITLE -->--}}
                            {{-- <div class="heading">--}}
                                {{-- <h2>--}}
                                    {{-- <i class="fa fa-comments"></i>--}}
                                    {{-- 2 comments--}}
                                    {{-- </h2>--}}
                                {{-- </div>--}}

                            {{-- <!-- THE COMMENTS LIST -->--}}
                            {{-- <ol class="comment-list">--}}
                                {{-- <li id="comment-406"
                                    class="comment byuser comment-author-demo even thread-even depth-1 parent">--}}
                                    {{-- <article id="div-comment-406" class="comment-body">--}}
                                        {{-- <footer class="comment-meta">--}}
                                            {{-- <div class="comment-author vcard">--}}
                                                {{-- <img alt=""
                                                    src="https://demos.alkalab.com/woffice/business/wp-content/uploads/avatars/3/58ecd943d58d5-bpfull.jpg"
                                                    srcset="https://demos.alkalab.com/woffice/business/wp-content/uploads/avatars/3/58ecd943d58d5-bpfull.jpg 2x"
                                                    class="avatar avatar-75 photo" height="75" width="75">--}}
                                                {{-- <b class="fn">--}}
                                                    {{-- <a
                                                        href="https://demos.alkalab.com/woffice/business/members/demo/"
                                                        rel="external nofollow" class="url">--}}
                                                        {{-- Oliver Queen1--}}
                                                        {{-- </a>--}}
                                                    {{-- </b>--}}
                                                {{-- <span class="says">--}}
                                                    {{-- says:--}}
                                                    {{-- </span>--}}
                                                {{-- </div>--}}
                                            {{-- <!-- .comment-author -->--}}

                                            {{-- <div class="comment-metadata">--}}
                                                {{-- <a
                                                    href="https://demos.alkalab.com/woffice/business/project/website-developing/#comment-406">--}}
                                                    {{-- <time datetime="2017-05-18T12:18:00+00:00">--}}
                                                        {{-- May 18, 2017 at 12:18 pm--}}
                                                        {{-- </time>--}}
                                                    {{-- </a>--}}
                                                {{-- </div>--}}
                                            {{-- <!-- .comment-metadata -->--}}

                                            {{-- </footer>--}}
                                        {{-- <!-- .comment-meta -->--}}

                                        {{-- <div class="comment-content">--}}
                                            {{-- <p>--}}
                                                {{-- I have almost completed my tasks--}}
                                                {{-- <img draggable="false" class="emoji" alt="😉"
                                                    src="https://s.w.org/images/core/emoji/12.0.0-1/svg/1f609.svg">--}}
                                                {{-- </p>--}}
                                            {{-- </div>--}}
                                        {{-- <!-- .comment-content -->--}}

                                        {{-- <div class="reply">--}}
                                            {{-- <a rel="nofollow" class="btn btn-default btn-sm"
                                                href="/woffice/business/project/website-developing/?replytocom=406#respond"
                                                data-commentid="406" data-postid="1291"
                                                data-belowelement="div-comment-406" data-respondelement="respond"
                                                aria-label="Reply to Oliver Queen1">--}}
                                                {{-- <i class="fa fa-reply"></i>--}}
                                                {{-- Reply--}}
                                                {{-- </a>--}}
                                            {{-- </div>--}}
                                        {{-- </article>--}}
                                    {{-- <!-- .comment-body -->--}}

                                    {{-- <ol class="children">--}}
                                        {{-- <li id="comment-411"
                                            class="comment byuser comment-author-demo2 odd alt depth-2">--}}
                                            {{-- <article id="div-comment-411" class="comment-body">--}}
                                                {{-- <footer class="comment-meta">--}}
                                                    {{-- <div class="comment-author vcard">--}}
                                                        {{-- <img alt=""
                                                            src="https://demos.alkalab.com/woffice/business/wp-content/uploads/avatars/2/4e87e06143afc75303f83f44af6aa578-bpfull.jpg"
                                                            srcset="https://demos.alkalab.com/woffice/business/wp-content/uploads/avatars/2/4e87e06143afc75303f83f44af6aa578-bpfull.jpg 2x"
                                                            class="avatar avatar-75 photo" height="75" width="75">--}}
                                                        {{-- <b class="fn">--}}
                                                            {{-- <a
                                                                href="https://demos.alkalab.com/woffice/business/members/demo2/"
                                                                rel="external nofollow" class="url">--}}
                                                                {{-- Karol--}}
                                                                {{-- </a>--}}
                                                            {{-- </b>--}}
                                                        {{-- <span class="says">--}}
                                                            {{-- says:--}}
                                                            {{-- </span>--}}
                                                        {{-- </div>--}}
                                                    {{-- <!-- .comment-author -->--}}

                                                    {{-- <div class="comment-metadata">--}}
                                                        {{-- <a
                                                            href="https://demos.alkalab.com/woffice/business/project/website-developing/#comment-411">--}}
                                                            {{-- <time datetime="2017-05-18T12:18:00+00:00">--}}
                                                                {{-- May 18, 2017 at 12:18 pm--}}
                                                                {{-- </time>--}}
                                                            {{-- </a>--}}
                                                        {{-- </div>--}}
                                                    {{-- <!-- .comment-metadata -->--}}

                                                    {{-- </footer>--}}
                                                {{-- <!-- .comment-meta -->--}}

                                                {{-- <div class="comment-content">--}}
                                                    {{-- <p>Really?!? You are very fast!</p>--}}
                                                    {{-- </div>--}}
                                                {{-- <!-- .comment-content -->--}}

                                                {{-- <div class="reply">--}}
                                                    {{-- <a rel="nofollow" class="btn btn-default btn-sm"
                                                        href="/woffice/business/project/website-developing/?replytocom=411#respond"
                                                        data-commentid="411" data-postid="1291"
                                                        data-belowelement="div-comment-411"
                                                        data-respondelement="respond" aria-label="Reply to Karol">--}}
                                                        {{-- <i class="fa fa-reply"></i>--}}
                                                        {{-- Reply--}}
                                                        {{-- </a>--}}
                                                    {{-- </div>--}}
                                                {{-- </article>--}}
                                            {{-- <!-- .comment-body -->--}}
                                            {{-- </li>--}}
                                        {{-- <!-- #comment-## -->--}}
                                        {{-- </ol>--}}
                                    {{-- <!-- .children -->--}}
                                    {{-- </li>--}}
                                {{-- <!-- #comment-## -->--}}
                                {{-- </ol>--}}
                            {{-- <!-- .comment-list -->--}}

                            {{-- <!-- THE COMMENTS NAVIGATION -->--}}
                            {{-- <!-- NEED CHANGES -->--}}


                            {{-- </div>--}}
                        {{-- </div>--}}


                    {{-- <!-- THE COMMENT FORM -->--}}
                    {{-- <div class="box">--}}
                        {{-- <div class="intern-padding">--}}

                            {{-- <div id="respond" class="comment-respond">--}}
                                {{-- <h3 id="reply-title" class="comment-reply-title">--}}
                                    {{-- Leave a Reply--}}
                                    {{-- <small>--}}
                                        {{-- <a rel="nofollow" id="cancel-comment-reply-link"
                                            href="/woffice/business/project/website-developing/#respond"
                                            style="display:none;">--}}
                                            {{-- Cancel Reply--}}
                                            {{-- </a>--}}
                                        {{-- </small>--}}
                                    {{-- </h3>--}}
                                {{-- <form action="https://demos.alkalab.com/woffice/business/wp-comments-post.php"
                                    method="post" id="comment-form" class="comment-form form-horizontal" novalidate="">
                                    --}}
                                    {{-- <p class="logged-in-as">--}}
                                        {{-- <a
                                            href="https://demos.alkalab.com/woffice/business/members/demo/profile/edit/"
                                            aria-label="Logged in as Oliver Queen1. Edit your profile.">--}}
                                            {{-- Logged in as Oliver Queen1--}}
                                            {{-- </a>.--}}
                                        {{-- <a
                                            href="https://demos.alkalab.com/woffice/business/wp-login.php?action=logout&amp;redirect_to=https%3A%2F%2Fdemos.alkalab.com%2Fwoffice%2Fbusiness%2Fproject%2Fwebsite-developing%2F&amp;_wpnonce=468fd76920">--}}
                                            {{-- Log out?--}}
                                            {{-- </a>--}}
                                        {{-- </p>--}}
                                    {{-- <p class="comment-form-comment">--}}
                                        {{-- <label for="comment">--}}
                                            {{-- Comment--}}
                                            {{-- </label>--}}
                                        {{-- <textarea class="bp-suggestions" id="comment" name="comment" cols="45"
                                            rows="8" maxlength="65525" required="required"></textarea>--}}
                                        {{-- </p>--}}
                                    {{-- <p class="form-submit"><input name="submit" type="submit" id="submit"
                                            class="submit" value="Post Comment">--}}
                                        {{-- <input type="hidden" name="comment_post_ID" value="1291"
                                            id="comment_post_ID">--}}
                                        {{-- <input type="hidden" name="comment_parent" id="comment_parent"
                                            value="0">--}}
                                        {{-- </p>
                                    <div class="control-group text-right">--}}
                                        {{-- <button class="btn btn-default" type="submit">--}}
                                            {{-- <i class="fa fa-paper-plane"></i>--}}
                                            {{-- Post Comment--}}
                                            {{-- </button>--}}
                                        {{-- </div>--}}
                                    {{--
                                </form>--}}
                                {{-- </div>--}}
                            {{-- <!-- #respond -->--}}
                            {{-- </div>--}}
                        {{-- </div>--}}
                    {{-- </div>--}}

                <!--Comment-->
                <div id="project-content-maintenance-histories" class="woffice-tab-layout__tab d-none"
                    data-tab="maintenance-histories">
                    <div id="comments-container" class="box">
                        <div class="intern-padding">

                            <!-- THE TITLE -->
                            <div class="heading">
                                <h2>
                                    <i class="fa fa-wrench"></i>
                                    Maintenance History
                                </h2>
                            </div>
                        </div>

                        <div class="intern-padding">
                            <table id="ssfa-table-6625" data-filter="#filter-6625"
                                data-page-navigation=".ssfa-pagination" data-page-size="15"
                                class="footable ssfa-sortable ssfa-minimalist  ssfa-center dirtree-table bd-table footable-loaded no-paging">
                                <thead>
                                    <tr>
                                        <th class="ssfa-sortname footable-sortable footable-sorted" title=""
                                            data-sort-initial="true">
                                            Balance Maintenance Hour
                                        </th>
                                        <th class="ssfa-sortdate footable-sortable" data-type="numeric" title="">
                                            Remark
                                        </th>
                                        <th class="ssfa-sortdate footable-sortable" data-type="numeric" title="">
                                            Created At
                                        </th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="100">
                                            <div class="ssfa-pagination ssfa-pagination-centered hide-if-no-paging">
                                                <ul>
                                                    <li class="footable-page-arrow disabled">
                                                        <a data-page="first" href="#first">«</a>
                                                    </li>
                                                    <li class="footable-page-arrow disabled">
                                                        <a data-page="prev" href="#prev">‹</a>
                                                    </li>
                                                    <li class="footable-page active">
                                                        <a data-page="0" href="#">1</a>
                                                    </li>
                                                    <li class="footable-page-arrow disabled">
                                                        <a data-page="next" href="#next">›</a>
                                                    </li>
                                                    <li class="footable-page-arrow disabled">
                                                        <a data-page="last" href="#last">»</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach( $maintenanceHistories as $maintenanceHistory)
                                    <tr id="ssfa-file-6625-1" class="" style="display: table-row;">
                                        <td id="filename-ssfa-file-6625-1" class="ssfa-sortname" style="width: 20%">
                                            {{ $maintenanceHistory->maintenance_hour }}
                                        </td>
                                        <td id="mod-ssfa-file-6625-1" class="ssfa-sortdate" style="width: 50%">
                                            {{ $maintenanceHistory->maintenance_remark }}
                                        </td>
                                        <td id="mod-ssfa-file-6625-1" class="ssfa-sortdate" style="width: 30%">
                                            {{ $maintenanceHistory->created_at }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>
@endsection