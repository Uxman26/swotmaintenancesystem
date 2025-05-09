@extends('layouts.site.app')

@section('content')
    <!-- START FEATURED IMAGE AND TITLE -->
    <header id="featuredbox" class="centered ">
        <div class="pagetitle animate-me fadeIn">
            <h1 class="entry-title">Dashboard</h1>
        </div>
        <!-- .pagetitle -->
        <div class="featured-background" style="background-image: url(./site/theme/wp-content/uploads/2016/12/MAIN.jpg)";>
            <div class="featured-layer d-block">

            </div>
        </div>
    </header>

    <!-- START THE CONTENT CONTAINER -->
    <div id="content-container">
        <!-- START CONTENT -->
        <div id="content">
            <div id="dashboard" class="masonry-layout--1-columns is-draggie">

                @include('site.dashboard.welcome_widget')
            </div>
        </div>

    </div>
    <!-- END #content-container -->
@endsection