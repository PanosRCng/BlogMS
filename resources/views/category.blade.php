@extends('layout.layout')


@section('header_title', 'Category: ' . $category->name)


@section('header_links')


    <link href="{{ URL::asset('css/category.css') }}" rel="stylesheet">


@endsection


@section('page-header-title', 'Category: ' . $category->name)


@section('content')


    @foreach($category->articles as $article)

        <div class="row category_link">

            <div class="row category_link_header">
                <div class="col-sm-12 category_link_header_text">
                    <div class="container d-flex h-100">
                        <div class="row justify-content-right">
                            <p>{{ $article->title }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if( count($article->images()) == 0 )

                <div class="row category_link_summary">
                    <div class="col-sm-12 category_link_summary_text">
                        <div class="container d-flex h-100">
                            <div class="row justify-content-right align-self-center">
                                <p>{{ $article->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            @else

                <div class="row category_link_summary">
                    <div class="col-sm-9 category_link_summary_text">
                        <div class="container d-flex h-100">
                            <div class="row justify-content-right align-self-center">
                                <p>{{ $article->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 category_link_summary_preview">
                        <div class="container d-flex h-100">
                            <div class="row justify-content-center align-self-center">
                                <img src="data:image/png;base64,{{ $article->images()[0] }}" class="img-fluid category_link_summary_preview_img" alt="Image"/>
                            </div>
                        </div>
                    </div>
                </div>

            @endif

            <a href="{{url('/' . $article->title)}}" class="stretched-link"></a>
        </div>

    @endforeach


@stop

