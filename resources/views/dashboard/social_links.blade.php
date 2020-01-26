@extends('dashboard.layout.layout')


@section('header_title', 'social links')


@section('header_links')


    <link href="{{ URL::asset('css/dashboard/articles.css') }}" rel="stylesheet">


@endsection


@section('page-header-title', 'social links')


@section('content')


    <div class="row create_container">
        <form class="create_form" method="POST" action="{{url('/dashboard/social_link/create')}}">

            {{ csrf_field() }}

            <label for="type">type:</label>
            <select class="form-control" name="type" id="type">

                @foreach( array_keys(\App\Services\SocialLinkService::LINKS_TYPES_ICONS) as $type)
                    <option id="{{$type}}">{{$type}}</option>
                @endforeach

            </select>

            <div class="form-group">
                <label>url</label>
                <input type="text" class="form-control" name="url" value="{{ old('url') }}">
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



    @if(count($socialLinks) > 0)

        <div class="container-fluid">

            <div class="row header">

                <div class="col-sm-1 header_column column_centered">
                    <p class="item_column_text column_centered">enabled</p>
                </div>
                <div class="col-sm-2 header_column column_centered">
                    <p class="item_column_text column_centered">display_order</p>
                </div>
                <div class="col-sm-2 header_column column_centered">
                    <p class="item_column_text">type</p>
                </div>
                <div class="col-sm-6 header_column column_centered">
                    <p class="item_column_text">url</p>
                </div>
                <div class="col-sm-1 header_column column_centered">
                    <p class="item_column_text">delete</p>
                </div>
            </div>


            @foreach($socialLinks as $link)

                <div class="row">

                    @if($link->enabled == 1)
                        <div class="col-sm-1 item_column column_centered">
                            <a href="{{ url('/dashboard/social_link/' . $link->id . '/disable') }}"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>
                        </div>
                    @elseif($link->enabled == 0)
                        <div class="col-sm-1 item_column column_centered">
                            <a href="{{ url('/dashboard/social_link/' . $link->id . '/enable') }}"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>
                        </div>
                    @endif

                    <div class="col-sm-2 item_column column_centered">
                        <a href="{{ url('/dashboard/social_link/' . $link->id . '/move_up/') }}"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                        <a href="{{ url('/dashboard/social_link/' . $link->id . '/move_down/') }}"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                    </div>
                    <div class="col-sm-2 item_column">
                        <p class="item_column_text">{{ $link->type }}</p>
                    </div>
                    <div class="col-sm-6 item_column">
                        <a href="{{ $link->url }}"> <p class="item_column_text">{{ $link->url }}</p></a>
                    </div>
                    <div class="col-sm-1 item_column column_centered">
                        <a href="{{ url('/dashboard/social_link/' . $link->id . '/delete') }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </div>

                </div>

            @endforeach

        </div>

    @endif


@stop
