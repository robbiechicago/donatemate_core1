@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">

                <div class="d-flex w-100 justify-content-between mb-5">
                    <h1 class="mb-1">{{ $user->first_name . ' ' . $user->last_name }}</h1>
                    <a href="/user" class="btn btn-primary">Back</a>
                    <a href="/user/{{ $user->id }}/edit" class="btn btn-outline-primary">Edit</a>
                </div>

                <div class="row">
                    <div class="col">
                        <h3>Details</h3>
                        <div><strong>Name: </strong>{{ $user->first_name . ' ' . $user->last_name }}</div>
                        <div><strong>Email: </strong>{{ $user->email }}</div>
                        <div><strong>Organisation: </strong>{{ $user->org && $user->org->org_name ? $user->org->org_name : 'n/a' }}</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
