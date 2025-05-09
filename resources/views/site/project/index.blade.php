@extends('layouts.site.app')

@section('content')
    <!-- START FEATURED IMAGE AND TITLE -->
    <header id="featuredbox" class="centered has-search is-404">
        <div class="pagetitle animate-me fadeIn">
            <h1 class="entry-title">Projects</h1>
            <form role="search" method="get" action="">
                <input type="text" value="" name="keyword" id="keyword" placeholder="Search...">
{{--                <input type="hidden" name="searchsubmit" id="searchsubmit" value="true">--}}
{{--                <input type="hidden" name="post_type" value="projects">--}}
                <button type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
        <!-- .pagetitle -->
        <div class="featured-background" style="background-image: url(./site/theme/wp-content/uploads/2016/12/MAIN.jpg)" ;="">
            <div class="featured-layer d-block">

            </div>
        </div>
    </header>

    <!-- START THE CONTENT CONTAINER -->
    <div id="content-container">

        <!-- START CONTENT -->
        <div id="content">
            <div id="post-216" class="post-216 page type-page status-publish">
                <div id="projects-page-content" class="box content">
                    <div class="intern-padding">
                        <p style="text-align: center;">
                            Welcome to the projects page, here you can see all of your projects.
                        </p>
                        <div class="text-center">
                            <div id="woffice-project-date-filters" class="dropdown woffice-project-filter">
                                <form id="woffice-projects-filter-date-form" action="#" method="get">
                                    <input type="hidden" name="filterDate" id="filterDate">
                                    <button id="woffice-projects-date-filter-btn" type="button" class="btn btn-default" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-calendar-times pr-3 ml-0"></i>
                                        Sort by date
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="" data-date="desc_creation_date" class="dropdown-item">
                                                Creation Date - Desc
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" data-date="asc_creation_date" class="dropdown-item">
                                                Creation Date - Asc
                                            </a>
                                        </li>
{{--                                        <li>--}}
{{--                                            <a href="javascript:void(0)" data-date="desc_completion_date" class="dropdown-item">--}}
{{--                                                Completion Date - Desc--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <a href="javascript:void(0)" data-date="asc_completion_date" class="dropdown-item">--}}
{{--                                                Completion Date - Asc--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
                                    </ul>
                                </form>
                            </div>
{{--                            <script type="text/javascript">--}}
{{--                                jQuery("#woffice-project-date-filters .dropdown-menu a").on("click",function(){--}}
{{--                                    jQuery("#filterDate").val(jQuery(this).data("date"));--}}
{{--                                    jQuery("#woffice-projects-filter-date-form").submit();--}}
{{--                                });--}}
{{--                            </script>--}}
                            <div id="woffice-project-status-filters" class="dropdown woffice-project-filter">
                                <form id="woffice-projects-filter-status-form" action="https://demos.alkalab.com/woffice/business/projects" method="get">
                                    <input type="hidden" name="filterStatus" id="filterStatus">
                                    <button id="woffice-projects-status-filter-btn" type="button" class="btn btn-default" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-hourglass-start pr-3 ml-0"></i>
                                        Sort by status
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="javascript:void(0)" data-status="all" class="dropdown-item">
                                                All Projects
                                            </a>
                                        </li>
                                        {{-- @foreach($projectStatus as $item)
                                        <li>
                                            <a href="{{ route('site.projects').'?sort_by=' . $item }}" data-status="archived" class="dropdown-item">
                                                {{ $item }}
                                            </a>
                                        </li>
                                        @endforeach --}}

                                    </ul>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                @if(count($projects) == 0 )
                    <article id="post-1894" class="box content post-1894 project type-project status-publish">

                        <div class="intern-padding">
                            <div class="special-404 text-center">
                                <i class="fa fa-meh text-light"></i>
                            </div>
                            <div class="heading text-center">
                                <h2>
                                    Nothing Found
                                </h2>
                            </div>
                        </div>
                        <div class="intern-padding">
                            <p class="blog-sum-up text-center">
                                Sorry, you do not have any web project with us right now. <br/>
                                If you interested to get one, please refer to
                                <a href="https://swot.com.my/web-design-malaysia/" target="_blank">here</a>.
                            </p>

                            <div class="blog-button text-center">
                                <a href="{{ route('user.dashboard') }}" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i>
                                    Back on the home page
                                </a>
                            </div>
                        </div>
                    </article>
                @endif

                <!-- LOOP ALL THE PROJECTS-->
                <ul id="projects-list" class="">
                    @foreach( $projects as $project)
                        <li class="box content ">
                            <div class="intern-padding">

                                <a href="{{ route('site.project_details', ['id' => $project->id ]) }}" rel="bookmark" class="project-head">

                                    <h2 class="project-title">
                                        <i class="fa fa-cubes pr-3"></i>
                                        {{ $project->name }}
                                    </h2>


                                    <span class="project-category">
                                        <i class="fa fa-tag"></i>
                                            {{ \App\Models\Package::getPackageName($project->package_id) }}
                                    </span>

                                    <span class="project-category">
                                        <i class="fa fa-calendar"></i>
                                         Website Service Expiry At: {{ ($project->website_services_expiry_at) }}

                                    </span>
                                        <span class="project-status badge badge-pill planned">
                                        <i class="fa fa-book pr-2"></i>
                                            {{ \App\Models\Project::getProjectStatusName($project->status) }}
                                    </span>
                                </a>


                                <div class="progress project-progress">
                                    <div class="progress-bar" role="progressbar"
                                         aria-valuenow="100" aria-valuemin="0"
                                         aria-valuemax="100" style="width: '{{ \App\Models\Project::getProjectCompletion($project->status) }}%'">
                                    <span class="progress-current">
                                        <i class="fa fa-tasks"></i> {{ \App\Models\Project::getProjectCompletion($project->status) }} %
                                    </span>
                                    </div>
                                </div>
                                <p class="project-excerpt"></p>
                                <p>
                                    {!! $project->description !!}
                                </p>
                                <p>
                                </p>

                                <div class="text-right">
                                    <a href="{{ route('site.project_details', ['id' => $project->id ]) }}" class="btn btn-default">
                                        See Project
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- .intern-padding -->
                        </li>
                    @endforeach
                </ul>





            </div>
        </div>

    </div>
    <!-- END #content-container -->
@endsection