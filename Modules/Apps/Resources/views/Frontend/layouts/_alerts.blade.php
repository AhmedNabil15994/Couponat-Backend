<div class="container-fluid">
@if (!is_string($errors) && $errors->all())
    <div class="alert alert-danger mb-3 border-radius-10px" role="alert">
        <center>
            @foreach ($errors->all() as $error)
                <li>-<p style="display: inline-block">{{ $error }}</p></li>
            @endforeach
        </center>
    </div>
@endif

@if (session('msg'))
    <div class="alert alert-{{session('status')}} mb-3 border-radius-10px" role="alert">
        <center>
            {{ session('msg') }}
        </center>
    </div>
@endif

@if (is_string($errors))
    <div class="alert alert-danger mb-3 border-radius-10px" role="alert">
        <center>
            {{ $errors }}
        </center>
    </div>
@endif
</div>
