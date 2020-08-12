@extends('website.layouts.website')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1>DonateMate</h1>

                <h3>{{ $device->org->display_name }}</h3>

                <p>Suggested Donation: {{ $device->suggested_donation }}</p>

            </div>
        </div>
    </div>

@endsection
