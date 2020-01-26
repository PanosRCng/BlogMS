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

    <link href="{{ URL::asset('css/layout.css') }}" rel="stylesheet">

    @yield('header_links')

</head>



<script src="{{ URL::asset('jquery/jquery.v3.4.1.min.js') }}"></script>
<script src="{{ URL::asset('bootstrap/bootstrap.bundle.min.js') }}"></script>



<body>

    <div class="d-flex" id="wrapper">

        <div class="border-right" id="sidebar-wrapper">


            @if(\App\Services\SidebarService::sidebar()->title != null)
                <div class="sidebar-heading">PanosRCng</div>
            @endif


            @if(\App\Services\SidebarService::sidebar()->logo != null)
                <div class="sidebar-logo">
                    <img src="data:image/png;base64,{{ \App\Services\SidebarService::sidebar()->logo }}" class="img-thumbnail logo" alt="Image"/>
                </div>
            @endif


            <div class="list-group list-group-flush">


                @if(\App\Services\SidebarService::sidebar()->show_featured_articles == 1)

                    @foreach(\App\Services\ArticleService::featured_articles() as $article)
                        <a href="{{ url('/' . $article->title) }}" class="list-group-item list-group-item-action">{{ $article->title }}</a>
                    @endforeach

                @endif


            </div>



            @if(\App\Services\SidebarService::sidebar()->show_social_links == 1)

                <div class="sidebar-social">

                    @foreach(\App\Models\SocialLink::all()->where('enabled', '=', 1)->sortBy('display_order') as $social_link)
                        <a href="{{ $social_link->url }}" target="_blank" class="social-icon"><i class="{{ \App\Services\SocialLinkService::LINKS_TYPES_ICONS[$social_link->type] }}" aria-hidden="true"></i></a>
                    @endforeach

                </div>

            @endif



            @if(\App\Services\SidebarService::sidebar()->show_categories == 1)

                <div class="sidebar-heading-posts">categories</div>

                <div class="list-group list-group-flush">

                    @foreach(\App\Models\Category::all()->where('enabled', '=', 1)->sortBy('display_order') as $category)
                        <a href="{{ url('/category/' . $category->name ) }}" class="list-group-item list-group-item-action">{{ $category->name }}</a>
                    @endforeach

                </div>

            @endif


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