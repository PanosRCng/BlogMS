@extends('dashboard.layout.layout')


@section('header_title', 'articles')


@section('header_links')


    <link href="{{ URL::asset('css/dashboard/articles.css') }}" rel="stylesheet">


@endsection


@section('page-header-title', 'articles')


@section('content')


    <div class="row create_container">
        <form class="create_form" method="POST" action="{{url('/dashboard/article/create')}}">

            {{ csrf_field() }}

            <div class="form-group">
                <label>title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
            </div>
            <button type="submit" class="btn btn-primary">create</button>
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



    @if(count($articles) > 0)

        <div class="container-fluid">

            <div class="row header">

                <div class="col-sm-1 header_column column_centered">
                    <p class="item_column_text column_centered">enabled</p>
                </div>
                <div class="col-sm-8 header_column column_centered">
                    <p class="item_column_text">title</p>
                </div>
                <div class="col-sm-2 header_column column_centered">
                    <p class="item_column_text">updated at</p>
                </div>
                <div class="col-sm-1 header_column column_centered">
                    <p class="item_column_text">view/edit</p>
                </div>
            </div>


            @foreach($articles as $article)

                <div class="row">

                    @if($article->enabled == 1)
                        <div class="col-sm-1 item_column column_centered">
                            <a href="{{ url('/dashboard/article/' . $article->id . '/disable') }}"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>
                        </div>
                    @elseif($article->enabled == 0)
                        <div class="col-sm-1 item_column column_centered">
                            <a href="{{ url('/dashboard/article/' . $article->id . '/enable') }}"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>
                        </div>
                    @endif

                    <div class="col-sm-8 item_column">
                        <p class="item_column_text">{{ $article->title }}</p>
                    </div>
                    <div class="col-sm-2 item_column item_date column_centered">
                        <p class="item_column_text">{{ $article->updated_at }}</p>
                    </div>
                    <div class="col-sm-1 item_column column_centered">
                        <a href="{{ url('/dashboard/article/' . $article->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </div>
                </div>

            @endforeach

        </div>

    @endif


@stop
