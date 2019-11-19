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
                        <a href="/admin/pages" class="button is-info">Back</a>

                        <hr>

                        <h4 class="title is-4">New Field</h4>

                        <form method="post" action="/admin/pages/{{ $page->name }}/fields/create">
                            <div class="field">
                                <div class="control">
                                    <input class="input" name="name" type="text" placeholder="Name">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <div class="select">
                                        <select name="type">
                                            <option value="single-line-text">Single Line Text</option>
                                            <option value="multi-line-text">Multi Line Text</option>
                                            <option value="image">Image</option>
                                            <option value="color">Color</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="button is-primary">Create</button>
                        </form>

                        <hr>

                        <h4 class="title is-4">Manage Fields</h4>

                        <h6 class="subtitle is-6">Page: {{ $page->name }}</h6>

                        <table class="table is-fullwidth is-hoverable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th class="has-text-right">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($page->fields as $field)
                                    <tr>
                                        <td>
                                            <p class="is-size-4">{{ $field->displayName }}</p>
                                        </td>
                                        <td>
                                            <p class="is-size-4">{{ $field->displayType }}</p>
                                        </td>
                                        <td>
                                            <div class="field is-grouped is-grouped-right">
                                                <p class="control">
                                                    <form method="post" action="/admin/pages/{{ $page->name }}/fields/{{ $field->id }}/delete">
                                                        <input type="hidden" name="_method" value="delete">
                                                        
                                                        <button type="submit" class="button is-danger">Delete</button>
                                                    </form>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>