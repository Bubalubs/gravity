<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin</title>
        <link rel="stylesheet" href="{{ asset('vendor/laravel-gravity/laravel-gravity.css') }}">
    </head>
    <body>
        <div id="app">
            <section class="hero is-light is-bold">
                <div class="hero-body">
                    <div class="container">
                        <h1 class="title">
                            {{ config('app.name') }}
                        </h1>
                        <h2 class="subtitle">
                            Admin
                        </h2>
                    </div>
                </div>
            </section>
            <section class="section">
                <div class="container">
                    <div class="columns">
                        <div class="column is-2">
                            @include('laravel-gravity::partials.sidebar')
                        </div>
                        <div class="column is-10">
                            @include('laravel-gravity::partials.alerts')

                            @yield('content')
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <script src="{{ asset('vendor/laravel-gravity/laravel-gravity.js') }}"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.11.2/js/all.js"></script>
    </body>
</html>