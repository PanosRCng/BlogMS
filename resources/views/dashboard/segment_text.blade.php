@extends('dashboard.layout.layout')


@section('header_title', 'text segment')


@section('header_links')


    <link href="{{ URL::asset('css/dashboard/segment_text.css') }}" rel="stylesheet">


@endsection


@section('page-header-title', 'text segment')


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

        <form class="form" method="POST" action="{{url('/dashboard/segment/' . $segment->article_segment->id .'/text_segment/update')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <label>text</label>

                @if( isset($segment) )
                    <textarea class="form-control" rows="10" name="text">{{ $segment->text }}</textarea>
                @else
                    <textarea class="form-control" rows="10" name="text"></textarea>
                @endif

            </div>
            <button type="submit" class="btn btn-primary">save</button>
        </form>

    </div>






@stop
