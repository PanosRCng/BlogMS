@extends('dashboard.layout.layout')


@section('header_title', 'categories')


@section('header_links')


    <link href="{{ URL::asset('css/dashboard/categories.css') }}" rel="stylesheet">


@endsection


@section('page-header-title', 'categories')


@section('content')


    <div class="row create_container">
        <form class="create_form" method="POST" action="{{url('/dashboard/category/create')}}">

            {{ csrf_field() }}

            <div class="form-group">
                <label>name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
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



    @if(count($categories) > 0)

        <div class="container-fluid">

            <div class="row header">

                <div class="col-sm-1 header_column column_centered">
                    <p class="item_column_text column_centered">enabled</p>
                </div>
                <div class="col-sm-8 header_column column_centered">
                    <p class="item_column_text">name</p>
                </div>
                <div class="col-sm-2 header_column column_centered">
                    <p class="item_column_text">display order</p>
                </div>
                <div class="col-sm-1 header_column column_centered">
                    <p class="item_column_text">view/edit</p>
                </div>
            </div>


            @foreach($categories as $category)

                <div class="row">

                    @if($category->enabled == 1)
                        <div class="col-sm-1 item_column column_centered">
                            <a href="{{ url('/dashboard/category/' . $category->id . '/disable') }}"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>
                        </div>
                    @elseif($category->enabled == 0)
                        <div class="col-sm-1 item_column column_centered">
                            <a href="{{ url('/dashboard/category/' . $category->id . '/enable') }}"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>
                        </div>
                    @endif

                    <div class="col-sm-8 item_column">
                        <p class="item_column_text">{{ $category->name }}</p>
                    </div>
                    <div class="col-sm-2 item_column item_date column_centered">
                        <p class="item_column_text">{{ $category->display_order }}</p>
                    </div>
                    <div class="col-sm-1 item_column column_centered">
                        <a href="{{ url('/dashboard/category/' . $category->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </div>
                </div>

            @endforeach

        </div>

    @endif


@stop
