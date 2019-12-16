@if (session('success'))
    <div class="notification is-success">
        {{ session('success') }}
    </div>
@endif

@if (count($errors) > 0)
    <div class="notification is-danger">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif