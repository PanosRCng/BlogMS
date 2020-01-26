<!DOCTYPE html>
<html lang="en">



<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('header_title')</title>

    <link href="{{ URL::asset('bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('css/dashboard/layout.css') }}" rel="stylesheet">

    @yield('header_links')

</head>



<script src="{{ URL::asset('jquery/jquery.v3.4.1.min.js') }}"></script>
<script src="{{ URL::asset('bootstrap/bootstrap.bundle.min.js') }}"></script>



<body>

<div class="d-flex" id="wrapper">

    <div class="border-right" id="sidebar-wrapper">

        <div class="sidebar-heading">Dashboard</div>

        <div class="sidebar-logout">

            <a href="{{url('/logout')}}" class="logout-icon"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
            <a href="{{url('/settings')}}" class="logout-icon"><i class="fa fa-cogs" aria-hidden="true"></i></a>

        </div>

        <div class="list-group list-group-flush">
            <a href="{{ url('/dashboard/sidebar') }}" class="list-group-item list-group-item-action">sidebar</a>
        </div>

        <div class="list-group list-group-flush">
            <a href="{{ url('/dashboard/featured_articles') }}" class="list-group-item list-group-item-action">featured articles</a>
        </div>
        
        <div class="list-group list-group-flush">
            <a href="{{ url('/dashboard/articles') }}" class="list-group-item list-group-item-action">articles</a>
        </div>

        <div class="list-group list-group-flush">
            <a href="{{ url('/dashboard/categories') }}" class="list-group-item list-group-item-action">categories</a>
        </div>

        <div class="list-group list-group-flush">
            <a href="{{ url('/dashboard/social_links') }}" class="list-group-item list-group-item-action">social links</a>
        </div>

    </div>

    <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light border-bottom">
            <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>
        </nav>

        <div id="content_page_container" class="container-fluid">

            <div id="content_page_space" class="row">

                <div id="centered_content_space" class="col-lg-8">

                    <div id="content_container" class="container-fluid">

                        <div id="content_header" class="row">
                            <div id="content_header_text" class="col-sm">
                                <h1 class="mt-4">@yield('page-header-title')</h1>
                            </div>
                        </div>

                        @yield('content')

                    </div>

                </div>

            </div>


        </div>
    </div>

</div>


<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

</body>

</html>