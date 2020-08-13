@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">

                <div class="d-flex w-100 justify-content-between">
                    <h1 class="mb-1">{{ $device ? $device->first_name . ' ' . $device->last_name : 'Create Device' }}</h1>
                    <a href="/user{{ $device && $device->id ? '/' . $device->id : '' }}" class="btn btn-outline-primary">Back</a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mt-5">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ $device && $device->id ? '/device/' . $device->id : '/device'}}" class="mt-5" method="post">
                    @csrf
                    @if($device && $device->id)
                        @method('PUT')
                    @endif
                    <input type="hidden" name="org_id" value="{{ $org_id }}">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control"
                            value="{{ $device && $device->name ? $device->name : '' }}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input
                            type="text"
                            id="description"
                            name="description"
                            class="form-control"
                            value="{{ $device && $device->description ? $device->description : '' }}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="suggested_donation">Suggested Donation</label>
                        <input
                            type="number"
                            step="0.5"
                            min="1"
                            id="suggested_donation"
                            name="suggested_donation"
                            class="form-control"
                            value="{{ $device && $device->suggested_donation ? $device->suggested_donation : '' }}"
                        >
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
