@extends('layout')
@include('stylesheets')

@section('content')
    
    <div class="title m-b-md">
        Create News
    </div>

    

    <div class="row">
        <div class="col-9">
            {!! Form::open(['url' => '/news', 'files' => true]) !!}
            {!! Form::token() !!}

                {!! Form::label('title', 'Title', ['class' => 'font-weight-bold']) !!}
                {!! Form::text('title', '', ['class' => 'mb-2 lead pl-3 pr-3 w-100', 'placeholder' => 'Title']) !!}
                
                {!! Form::label('content', 'Content', ['class' => 'font-weight-bold']) !!}
                {!! Form::textarea('content', '', ['id' => 'content']) !!}

                <div class="row">
                    <div class="col-3">
                        {!! Form::label('images[]', 'Upload Images', ['class' => 'font-weight-bold btn btn-info mt-1']) !!}
                        <p>Max file size is ~{{env('IMAGE_UPLOAD_SIZE_LIMIT')}}MB</p>
                        {!! Form::file('images[]', ["style" => "visibility: hidden;", "multiple"=>true]) !!}
                    </div>
                    <div class="col-3 offset-6">
                        <a href="/news">
                            {!! Form::button('Cancel', ['class' => 'btn btn-danger mt-1']) !!}
                        </a>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary mt-1']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@include('tinyMCE')
@include('scripts')