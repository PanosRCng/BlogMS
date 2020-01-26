@extends('dashboard.layout.layout')


@section('header_title', 'sidebar')


@section('header_links')


    <link href="{{ URL::asset('css/dashboard/sidebar.css') }}" rel="stylesheet">


@endsection


@section('page-header-title', 'sidebar')


@section('content')



    <div class="row form_container">

        <form class="form" method="POST" action="{{url('/dashboard/sidebar/update')}}">
            {{ csrf_field() }}
            <div class="form-group">

                <label>title</label>
                <input type="text" class="form-control" name="title" value="{{ $sidebar->title }}">

                <label>homepage</label>
                <select class="form-control" name="homepage" id="homepage">

                    @foreach(\App\Models\Article::all() as $article)

                        @if($article->title == $sidebar->homepage)
                            <option id="{{$article->id}}" value="{{$article->title}}" selected>{{$article->title}}</option>
                        @else
                            <option id="{{$article->id}}" value="{{$article->title}}">{{$article->title}}</option>
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


    <div class="container-fluid">

        <div class="row file_area">

            @if($sidebar->logo == null)

                <div class="col item_column column_centered">
                    <form method="POST" enctype="multipart/form-data" action="{{url('/dashboard/sidebar/upload_logo')}}">
                        <label>upload logo</label>

                        {{ csrf_field() }}

                        <div class="file_upload">
                            <input name="logo" type="file"/>
                        </div>
                        <button type="submit" class="btn btn-primary">upload</button>
                    </form>
                </div>

            @else

                <div class="col item_column column_centered">
                    <form method="POST" enctype="multipart/form-data" action="{{url('/dashboard/sidebar/upload_logo')}}">
                        <label>upload logo</label>

                        {{ csrf_field() }}

                        <div class="file_upload">
                            <input name="logo" type="file"/>
                        </div>
                        <button type="submit" class="btn btn-primary">upload</button>
                    </form>
                </div>

                <div class="col-sm-4 item_column column_centered">
                    <img src="data:image/png;base64,{{ $sidebar->logo }}" class="img-fluid img-thumbnail photo" alt="Image">
                </div>

                <div class="col-sm-2 item_column column_centered">
                    <a href="{{ url('/dashboard/sidebar/delete_logo') }}"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
                </div>

            @endif

        </div>

    </div>


    <div class="container-fluid">

        <div class="row header">

            <div class="col-sm-2 header_column column_centered">
                <p class="item_column_text column_centered">enabled</p>
            </div>
            <div class="col-sm-4 header_column column_centered">
                <p class="item_column_text">option</p>
            </div>
        </div>

        @foreach($sidebar->options() as $option)

            <div class="row">

                @if($sidebar->$option == 1)
                    <div class="col-sm-2 item_column column_centered">
                        <a href="{{ url('/dashboard/sidebar/' . $option . '/option_disable') }}" ><i class="fa fa-toggle-on" aria-hidden="true"></i></a>
                    </div>
                @elseif($sidebar->enabled == 0)
                    <div class="col-sm-2 item_column column_centered">
                        <a href="{{ url('/dashboard/sidebar/' . $option . '/option_enable') }}"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>
                    </div>
                @endif

                <div class="col-sm-4 item_column">
                    <p class="item_column_text">{{ $option }}</p>
                </div>
            </div>

        @endforeach

    </div>




@stop
