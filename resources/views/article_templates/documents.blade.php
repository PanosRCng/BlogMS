@extends('layout.layout')


@section('header_title', $article->title)


@section('header_links')


    <link href="{{ URL::asset('css/article_templates/documents.css') }}" rel="stylesheet">


@endsection


@section('page-header-title', $article->title)


@section('content')

    <div class="row document_link">


        @foreach($article->enabled_article_segments() as $article_segment)

            @if($article_segment->segment_type == 'file')

                <div class="col-sm-6 document_link_preview">
                    <div class="row justify-content-center align-self-center">
                        <img src="data:image/png;base64,{{ $article_segment->segment()->preview }}" class="img-fluid document_link_preview_img" alt="Image"/>
                        <a href="{{ url('/document/'. $article_segment->segment()->name) }}" target="_blank" class="stretched-link"></a>
                    </div>
                    <div>
                        <p class="document_link_text">{{ $article_segment->segment()->description }}</p>
                    </div>
                </div>

            @endif

        @endforeach


    </div>

@stop

