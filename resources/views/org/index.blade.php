@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">

                <div class="d-flex w-100 justify-content-between">
                    <h1 class="mb-1">Organisations</h1>
                    <a href="/org/create" class="btn btn-primary">New</a>
                </div>

                <div class="list-group mt-4">

                    @foreach($orgs as $org)
                    <a href="/org/{{ $org->id }}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h3 class="mb-1">{{ $org->display_name }}</h3>
                            <h4>
                                @if($org->active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </h4>
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
