@extends('layout.layout')


@section('header_title', $article->title)


@section('header_links')


    <link href="{{ URL::asset('css/article.css') }}" rel="stylesheet">


@endsection


@section('page-header-title', $article->title)


@section('content')


    @foreach($article->enabled_article_segments() as $article_segment)

        @if($article_segment->segment_type == 'file')

            <div class="row document_link">
                <div class="col-sm-9 document_link_text">
                    <div class="container d-flex h-100">
                        <div class="row justify-content-right align-self-center">
                            <p>{!! $article_segment->segment()->description !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 document_link_preview">
                    <div class="container d-flex h-100">
                        <div class="row justify-content-center align-self-center">
                            <img src="data:image/png;base64,{{ $article_segment->segment()->preview }}" class="img-fluid document_link_preview_img" alt="Image"/>
                        </div>
                    </div>
                </div>
                <a href="{{ url('document/' . $article_segment->segment()->name) }}" target="_blank" class="stretched-link"></a>
            </div>

        @elseif($article_segment->segment_type == 'text')


            <div class="row article_textarea">
                <div class="article_text">
                    <p>{!! $article_segment->segment()->text !!}</p>
                </div>
            </div>


        @elseif($article_segment->segment_type == 'photo gallery')


            <div class="row photos_gallery">

                @foreach($article_segment->segment()->photos as $photo)

                    <div class="col photo_container">
                        <div class="container d-flex h-100">
                            <div class="row justify-content-center align-self-center">
                                <img src="data:image/png;base64,{{ $photo->bytes}}" class="img-fluid img-thumbnail photo" alt="Image"/>
                                <a href="{{ url('image/' . $photo->id) }}" target="_blank" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>

        @endif


    @endforeach



@stop

