@extends('laravel-gravity::layouts.main')

@section('content')
    <h4 class="title is-4">Manage Users</h4>

    <table class="table is-fullwidth is-hoverable">
        <thead>
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th class="has-text-right">Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection