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
        <section class="section">
            <div class="container">
                <h2 class="title is-2">
                    <a href="/admin">
                        {{ config('app.name') }}
                    </a>
                </h2>

                <div class="columns">
                    <div class="column is-2">
                        @include('laravel-gravity::partials.sidebar')
                    </div>
                    <div class="column is-10">
                        <h5 class="title is-5">New Page</h5>

                        <form method="post" action="/admin/pages/create">
                            <div class="field">
                                <div class="control">
                                    <input class="input" name="name" type="text" placeholder="Name">
                                </div>
                            </div>

                            <button type="submit" class="button is-primary">Create</button>
                        </form>

                        <hr>
                        
                        <h5 class="title is-5">Pages</h5>

                        @foreach ($pages as $page)
                            {{ $page->name }}
                            <form type="post" method="/admin/pages/{{ $page->id }}/delete">
                                <input type="hidden" name="_method" value="delete">
                                
                                <button type="submit" class="button is-danger">Delete</button>
                            </form>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>