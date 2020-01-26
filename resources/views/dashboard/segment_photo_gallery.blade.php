@extends('dashboard.layout.layout')


@section('header_title', 'photo gallery segment')


@section('header_links')


    <link href="{{ URL::asset('css/dashboard/segment_photo_gallery.css') }}" rel="stylesheet">


@endsection


@section('page-header-title', 'photo gallery segment')


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

        <form class="form" method="POST" action="{{url('/dashboard/segment/' . $segment->article_segment->id .'/photo_gallery_segment/update_description')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <label>description</label>

                @if( isset($segment) )
                    <textarea class="form-control" rows="2" name="description">{{ $segment->description }}</textarea>
                @else
                    <textarea class="form-control" rows="10" name="description"></textarea>
                @endif

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



    <div class="row photo_form_container">

        <div class="col">


            <form method="POST" enctype="multipart/form-data" action="{{url('/dashboard/segment/' . $segment->article_segment->id .'/photo_gallery_segment/add_photo')}}">

                <label>add photo</label>

                {{ csrf_field() }}

                <div class="file_upload">
                    <input name="file" type="file"/>
                </div>
                <button type="submit" class="btn btn-primary">upload</button>
            </form>



        </div>

    </div>


    @if( count($segment->photos) > 0 )

        <div class="container-fluid">

            <div class="row header">
                <div class="col-sm-10 header_column column_centered">
                    <p class="item_column_text">photo</p>
                </div>
                <div class="col-sm-2 header_column column_centered">
                    <p class="item_column_text">delete</p>
                </div>
            </div>

            @foreach($segment->photos as $photo)

                <div class="row">
                    <div class="col-sm-10 item_column column_centered">
                        <img src="data:image/png;base64,{{ $photo->bytes }}" class="img-fluid img-thumbnail photo" alt="Image">
                    </div>
                    <div class="col-sm-2 item_column column_centered">
                        <a href="{{ url('/dashboard/segment/' . $segment->article_segment->id . '/photo_gallery_segment/photo/' . $photo->id . '/delete') }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </div>
                </div>

            @endforeach

        </div>

    @endif








@stop
