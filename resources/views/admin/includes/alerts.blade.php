@if ($errors->any())
    <div class="alert alert-warning">
        @foreach ($errors->all() as $error)
            <p><i class="fa fa-warning-sign"></i> {{ $error }}</p>
        @endforeach
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
            <p><i class="fa fa-check"></i> {{ session('success') }}</p>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
            <p><i class="fa fa-times"></i> {{ session('error') }}</p>
    </div>
@endif