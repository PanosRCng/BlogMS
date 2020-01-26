@extends('dashboard.layout.layout')


@section('header_title', 'file segment')


@section('header_links')


    <link href="{{ URL::asset('css/dashboard/segment_file.css') }}" rel="stylesheet">


@endsection


@section('page-header-title', 'file segment')


@section('content')


    <div class="row back_button">
        <a href="{{url('/dashboard/article/' . $segment->article()->id)}}"><i class="fa fa-long-arrow-left fa-2x" aria-hidden="true"></i></a>
    </div>


    @if( isset($segment) )
        <form class="delete_form" method="POST" action="{{url('/dashboard/segment/' . $segment->article_segment->id . '/delete')}}">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary delete_button">delete segment</button>
        </form>
    @endif




    <div class="row form_container">

        <form class="form" method="POST" action="{{url('/dashboard/segment/' . $segment->article_segment->id .'/file_segment/update')}}">
            {{ csrf_field() }}
            <div class="form-group">

                <label>name</label>
                @if( isset($segment) )
                    <input type="text" class="form-control" name="name" value="{{ $segment->name }}">
                @else
                    <input type="text" class="form-control" name="name" value="">
                @endif

                <label>description</label>
                <textarea class="form-control" rows="2" name="description">{{ $segment->description }}</textarea>

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

            @if($segment->file == null)

                <div class="col item_column column_centered">
                    <form method="POST" enctype="multipart/form-data" action="{{url('/dashboard/segment/' . $segment->article_segment->id .'/file_segment/upload_file')}}">
                        <label>upload file</label>

                        {{ csrf_field() }}

                        <div class="file_upload">
                            <input name="file" type="file"/>
                        </div>
                        <button type="submit" class="btn btn-primary">upload</button>
                    </form>
                </div>

            @else

                <div class="col-sm-6 item_column column_centered">
                    <form method="POST" enctype="multipart/form-data" action="{{url('/dashboard/segment/' . $segment->article_segment->id .'/file_segment/upload_file')}}">
                        <label>upload file</label>

                        {{ csrf_field() }}

                        <div class="file_upload">
                            <input name="file" type="file"/>
                        </div>
                        <button type="submit" class="btn btn-primary">upload</button>
                    </form>
                </div>

                <div class="col-sm-4 item_column column_centered">
                    <i class="fa fa-file fa-5x" aria-hidden="true"></i>
                </div>

                <div class="col-sm-2 item_column column_centered">
                    <a href="{{ url('/dashboard/segment/' . $segment->article_segment->id . '/file_segment/delete_file') }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </div>

            @endif

        </div>

    </div>




    <div class="container-fluid">

        <div class="row file_area">

            @if($segment->preview == null)

                <div class="col-sm item_column column_centered">
                    <form method="POST" enctype="multipart/form-data" action="{{url('/dashboard/segment/' . $segment->article_segment->id .'/file_segment/upload_preview')}}">
                        <label>upload file preview</label>

                        {{ csrf_field() }}

                        <div class="file_upload">
                            <input name="file" type="file"/>
                        </div>
                        <button type="submit" class="btn btn-primary">upload</button>
                    </form>
                </div>

            @else

                <div class="col-sm-6 item_column column_centered">
                    <form method="POST" enctype="multipart/form-data" action="{{url('/dashboard/segment/' . $segment->article_segment->id .'/file_segment/upload_preview')}}">
                        <label>upload file preview</label>

                        {{ csrf_field() }}

                        <div class="file_upload">
                            <input name="file" type="file"/>
                        </div>
                        <button type="submit" class="btn btn-primary">upload</button>
                    </form>
                </div>

                <div class="col-sm-4 item_column column_centered">
                    <img src="data:image/png;base64,{{ $segment->preview }}" class="img-fluid img-thumbnail photo" alt="Image">
                </div>

                <div class="col-sm-2 item_column column_centered">
                    <a href="{{ url('/dashboard/segment/' . $segment->article_segment->id . '/file_segment/delete_preview') }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </div>

            @endif

        </div>

    </div>




@stop
