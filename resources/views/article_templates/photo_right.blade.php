@extends('layout.layout')


@section('header_title', $article->title)


@section('header_links')


    <link href="{{ URL::asset('css/article_templates/photo_right.css') }}" rel="stylesheet">


@endsection


@section('page-header-title', $article->title)


@section('content')

    <div class="row">


        <div class="col-sm-8 textarea">

            @foreach($article->enabled_article_segments() as $article_segment)

                @if($article_segment->segment_type == 'text')

                    <p>{!! $article_segment->segment()->text !!}</p>

                @endif

            @endforeach

        </div>


        <div class="col-sm-4">

            @if( count($article->images()) > 0 )

                <img src="data:image/png;base64,{{ $article->images()[0] }}" class="img-fluid img-thumbnail" alt="Image"/>

            @endif

        </div>



    </div>

@stop

