@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">

                <div class="d-flex w-100 justify-content-between">
                    <h1 class="mb-1">{{ $org->display_name }}</h1>
                    <a href="/org" class="btn btn-primary">Back</a>
                    <a href="/org/{{ $org->id }}/edit" class="btn btn-outline-primary">Edit</a>
                </div>

                <div class="row mb-5">
                    <div class="col">
                        <h4>
                            @if($org->active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </h4>
                    </div>
                </div>

                <div class="row mb-5">

                    <div class="col-md-6">
                        <h3>Details</h3>
                        <div><strong>Organisation Name: </strong>{{ $org->org_name }}</div>
                        <div><strong>Display Name: </strong>{{ $org->display_name }}</div>
                        <div><strong>Charity Number: </strong>{{ $org->charity_number }}</div>
                    </div>

                    <div class="col-md-6">
                        <h3>People <a href="/user/create?org_id={{ $org->id }}" class="btn btn-primary">Add</a></h3>
                        <div class="list-group">
                            @foreach($org->users as $user)
                                <a href="/user/{{ $user->id }}" class="list-group-item list-group-item-action">{{ $user->first_name . ' ' . $user->last_name }}</a>
                            @endforeach
                        </div>
                    </div>

                </div>

                <hr>

                <div class="row mb-5">
                    <div class="col">
                        <h3>Donations</h3>

                        <table class="table">

                            <thead>
                            <tr>
                                <th>Donation ID</th>
                                <th>Donor ID</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Device</th>
                            </tr>
                            </thead>

                            <tbody>

                            @if($org->donations && count($org->donations) > 0)
                                @foreach($org->donations as $donation)
                                    <tr>
                                        <td>{{ $donation->id }}</td>
                                        <td>{{ $donation->user_id }}</td>
                                        <td>{{ $donation->amount }}</td>
                                        <td>{{ $donation->status }}</td>
                                        <td>{{ $donation->created_at }}</td>
                                        <td>to be sorted</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="6">No donations found</td>
                                </tr>
                            @endif

                            </tbody>

                        </table>

                    </div>
                </div>

                <hr>

                <div class="row mb-5">
                    <div class="col">

                        <div class="row">
                            <div class="col-md-auto">
                                <h3>Devices</h3>
                            </div>
                            <div class="col">
                                <a href="/device/create?org_id={{ $org->id }}" class="btn btn-primary float-right">New Device</a>
                            </div>
                        </div>

                        @foreach($org->devices as $device)
                            @php
                              $qr = $base_url . '/pledge?org_hash=' . $org->org_hash . '&device_hash=' . $device->device_hash . '&org_name=' . rawurlencode($org->display_name) . '&donation=' . $device->suggested_donation;
                            @endphp
                        <div class="row mb-3">
                            <div class="col-md-auto">
                                {!! QrCode::size(200)->margin(5)->errorCorrection('L')->generate($qr); !!}
                            </div>
                            <div class="col">
                                <div>Name: {{ $device->name }}</div>
                                <div>Description: {{ $device->description }}</div>
                                <div>Suggested Donation: {{ $device->suggested_donation ? $device->suggested_donation : 0 }}</div>
                                <div>QR content: {{ $qr }}</div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
