@if($errors->any())
    <div class="col-6 offset-2">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>    
    </div>
@endif

@if(session('success'))
    <div class="col-6 offset-2">
        <div class="alert alert-success">
            {!! session('success') !!}
        </div>
    </div>
@endif

@if(session('error'))
    <div class="col-6 offset-2">
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    </div>
@endif
