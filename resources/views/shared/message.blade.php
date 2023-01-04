@if (Session::has('message'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {!! nl2br(e(Session::get('message'))) !!}
    </div>
@endif
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
