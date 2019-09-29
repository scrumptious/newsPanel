@extends('layout')

@section('stylesheets')
    <link rel="stylesheet" href="/css/generic.css">
@endsection

@section('content')

    <div class="title m-b-md">
    Manage All News
    </div>

    @if(count($news) > 0)
        <table>
        <tr>
            <th>Title</th>
            <th>Last Updated</th>
        </tr>
        @foreach ($news as $item)
            <tr>
                <td><a href="/news/{{ $item->id }}">{{ $item->title }}</a></td>
                <td>{{ $item->updated_at }}</td>
                <td class="pr-0"><a href="/news/{{ $item->id }}/edit" class="btn btn-outline-info">Edit</a></td>
                {{-- needs to be DELETE request --}}
                <td>
                    {!! Form::open(['action' => ['NewsController@destroy', $item->id], 'method' => 'DELETE']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger']) !!}
                    {!! Form::close() !!}
                </td>

            </tr>
            @endforeach
        </table>
    @else
        <p class="lead">There are no News yet.</p>
    @endif
@endsection