@extends('dashboard.layout.layout')


@section('header_title', 'category')


@section('header_links')


    <link href="{{ URL::asset('css/dashboard/category.css') }}" rel="stylesheet">


@endsection


@section('page-header-title', 'category')


@section('content')


    <div class="row">
        <a href="{{url('/dashboard/categories')}}"><i class="fa fa-long-arrow-left fa-2x" aria-hidden="true"></i></a>
    </div>

    <form class="delete_form" method="POST" action="{{url('/dashboard/category/' . $category->id .'/delete')}}">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary delete_button">delete category</button>
    </form>

    <div class="row preview_area">
        <a href="{{url('/category/' . $category->name)}}" target="_blank"><button class="btn btn-primary preview_button">preview</button></a>
    </div>


    <div class="row form_container">

        <form class="form" method="POST" action="{{url('/dashboard/category/' . $category->id .'/update_name')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <label>name</label>
                <input type="text" class="form-control" name="name" value="{{ $category->name }}">
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

        <form class="create_form" method="POST" action="{{url('/dashboard/category/' . $category->id . '/attach_article')}}">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="segment_type">attach article:</label>
                <select class="form-control" name="article_id" id="article_id">

                    @foreach(\App\Services\CategoryService::unattached_articles($category->id) as $article)

                        <option id="{{$article->id}}" value="{{$article->id}}">{{$article->title}}</option>

                    @endforeach

                </select>
            </div>

            <button type="submit" class="btn btn-primary">attach</button>
        </form>

    </div>


    @if(count($category->articles) > 0)

        <div class="container-fluid">

            <div class="row header">
                <div class="col-sm-2 header_column column_centered">
                    <p class="item_column_text column_centered">display order</p>
                </div>
                <div class="col-sm-8 header_column column_centered">
                    <p class="item_column_text">name</p>
                </div>
                <div class="col-sm-2 header_column column_centered">
                    <p class="item_column_text">detach</p>
                </div>
            </div>


            @foreach($category->articles as $article)

                <div class="row">
                    <div class="col-sm-2 item_column column_centered">
                        <a href="{{ url('/dashboard/category/' . $category->id . '/move_up_article/' . $article->id) }}"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                        <a href="{{ url('/dashboard/category/' . $category->id . '/move_down_article/' . $article->id) }}"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                    </div>
                    <div class="col-sm-8 item_column">
                        <p class="item_column_text">{{ $article->title }}</p>
                    </div>
                    <div class="col-sm-2 item_column column_centered">
                        <a href="{{ url('/dashboard/category/' . $category->id . '/detach_article/' . $article->id) }}"><i class="fa fa-chain-broken" aria-hidden="true"></i></a>
                    </div>
                </div>

            @endforeach

        </div>

    @endif



@stop
