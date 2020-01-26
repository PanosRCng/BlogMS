@extends('dashboard.layout.layout')


@section('header_title', 'article')


@section('header_links')


    <link href="{{ URL::asset('css/dashboard/article.css') }}" rel="stylesheet">


@endsection


@section('page-header-title', 'article')


@section('content')


    <div class="row">
        <a href="{{url('/dashboard/articles')}}"><i class="fa fa-long-arrow-left fa-2x" aria-hidden="true"></i></a>
    </div>

    <form class="delete_form" method="POST" action="{{url('/dashboard/article/' . $article->id .'/delete')}}">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary delete_button">delete article</button>
    </form>

    <div class="row preview_area">
        <a href="{{url($article->title)}}" target="_blank"><button class="btn btn-primary preview_button">preview</button></a>
    </div>


    <div class="row form_container">

        <form class="form" method="POST" action="{{url('/dashboard/article/' . $article->id .'/update')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <label>title</label>
                <input type="text" class="form-control" name="title" value="{{ $article->title }}">
                <label>description</label>
                <textarea class="form-control" rows="5" name="description">{{ $article->description }}</textarea>


                <label for="segment_type">template:</label>
                <select class="form-control" name="template" id="template">
                    @foreach(\App\Services\ArticleService::templates() as $template)

                        @if($article->template == $template)
                            <option id="{{$template}}" selected>{{$template}}</option>
                        @else
                            <option id="{{$template}}">{{$template}}</option>
                        @endif

                    @endforeach
                </select>


            </div>
            <button type="submit" class="btn btn-primary">save</button>
        </form>


        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>


    <div class="row create_container">

        <form class="create_form" method="POST" action="{{url('/dashboard/article/' . $article->id . '/create_segment')}}">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="segment_type">segment type:</label>
                <select class="form-control" name="segment_type" id="segment_type">
                    <option id="text">text</option>
                    <option id="document_link">file</option>
                    <option id="photo_gallery">photo gallery</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">create</button>
        </form>

    </div>



    @if(count($article->article_segments) > 0)

        <div class="container-fluid">

            <div class="row header">
                <div class="col-sm-2 header_column column_centered">
                    <p class="item_column_text column_centered">enabled</p>
                </div>
                <div class="col-sm-2 header_column column_centered">
                    <p class="item_column_text column_centered">display order</p>
                </div>
                <div class="col-sm-4 header_column column_centered">
                    <p class="item_column_text">segment type</p>
                </div>
                <div class="col-sm-2 header_column column_centered">
                    <p class="item_column_text">view/edit</p>
                </div>
            </div>


            @foreach($article->article_segments as $article_segment)

                <div class="row">

                    @if($article_segment->enabled == 1)
                        <div class="col-sm-2 item_column column_centered">
                            <a href="{{ url('/dashboard/segment/' . $article_segment->id . '/disable') }}"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>
                        </div>
                    @elseif($article_segment->enabled == 0)
                        <div class="col-sm-2 item_column column_centered">
                            <a href="{{ url('/dashboard/segment/' . $article_segment->id . '/enable') }}"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>
                        </div>
                    @endif

                    <div class="col-sm-2 item_column column_centered">
                        <a href="{{ url('/dashboard/article/' . $article->id . '/move_up_segment/' . $article_segment->id) }}"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                        <a href="{{ url('/dashboard/article/' . $article->id . '/move_down_segment/' . $article_segment->id) }}"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                    </div>
                    <div class="col-sm-4 item_column column_centered">
                        <p class="item_column_text">{{ $article_segment->segment_type }}</p>
                    </div>
                    <div class="col-sm-2 item_column column_centered">
                        <a href="{{ url('/dashboard/segment/' . $article_segment->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </div>
                </div>

            @endforeach

        </div>

    @endif




@stop
