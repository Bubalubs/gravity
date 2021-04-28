<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin</title>
        <link rel="stylesheet" href="{{ asset('vendor/gravity/gravity.css') }}?v=4282021">
    </head>
    <body>
        <div id="app">
            <section class="hero is-light is-dark">
                <div class="hero-body">
                    <div class="is-pulled-right">
                        <a class="button is-info" href="/" target="_blank" v-tooltip="'Open website home in new tab'">
                            <span class="icon">
                                <i class="fas fa-home"></i>
                            </span>
                        </a>

                        <a
                            class="button is-danger"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                            v-tooltip="'Logout'"
                        >
                            <span class="icon">
                                <i class="fa fa-sign-out-alt"></i>
                            </span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>

                    <h1 class="title">
                        {{ config('app.name') }}
                    </h1>
                    <h2 class="subtitle">
                        Admin
                    </h2>
                </div>
            </section>
            <section class="section" v-cloak>
                <div class="columns">
                    <div class="column is-2">
                        @include('gravity::partials.sidebar')
                    </div>
                    <div class="column is-10">
                        @include('gravity::partials.alerts')

                        @yield('content')
                    </div>
                </div>
            </section>
        </div>

        <script src="{{ asset('vendor/gravity/gravity.js') }}"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.11.2/js/all.js"></script>
    </body>
</html>