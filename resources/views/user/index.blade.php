@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">

                <div class="d-flex w-100 justify-content-between">
                    <h1 class="mb-1">Users</h1>
                    <a href="/user/create" class="btn btn-primary">New</a>
                </div>

                <div class="list-group mt-4">

                    @foreach($users as $user)
                        <a href="/user/{{ $user->id }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h3 class="mb-1">{{ $user->first_name . ' ' . $user->last_name }}</h3>
                                <small>3 days ago</small>
                            </div>
                            <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                            <small>Donec id elit non mi porta.</small>
                        </a>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
@endsection
