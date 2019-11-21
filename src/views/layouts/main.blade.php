<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    </head>
    <body>
        <section class="hero is-dark is-bold">
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
    </body>
</html>