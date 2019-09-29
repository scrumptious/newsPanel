@extends('layout')

@section('stylesheets')
    <link rel="stylesheet" href="/css/generic.css">
@endsection

@section('content')

    <div class="row">
        <div class="col-9">
            <h2 class="mt-5 font-italic">{{ $news->title }}</h2>
            <p class="mb-5">{!! $news->content !!}</p>

            @if($images != null)
                <div class="col-8">
                    <ul class="list-unstyled mt-5">
                        @foreach ($images as $image)
                        <li style="display: inline;">
                            <img src="{{ '/images/thumb/' . $image }}"/>
                        </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <a href="/news"><input type="button" class="btn btn-primary" value="Back"></a>
            <a href="/news/{{ $news->id }}/edit"><input type="button" class="btn btn-info" value="Edit"></a>
        </div>


    </div>

@endsection