@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">

                <div class="d-flex w-100 justify-content-between">
                    <h1 class="mb-1">{{ $user ? $user->first_name . ' ' . $user->last_name : 'Create User' }}</h1>
                    <a href="/user{{ $user && $user->id ? '/' . $user->id : '' }}" class="btn btn-outline-primary">Back</a>
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

                <form action="{{ $user && $user->id ? '/user/' . $user->id : '/user'}}" class="mt-5" method="post">
                    @csrf
                    @if($user && $user->id)
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input
                            type="text"
                            id="first_name"
                            name="first_name"
                            class="form-control"
                            value="{{ $user && $user->first_name ? $user->first_name : '' }}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input
                            type="text"
                            id="last_name"
                            name="last_name"
                            class="form-control"
                            value="{{ $user && $user->last_name ? $user->last_name : '' }}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input
                            type="text"
                            id="email"
                            name="email"
                            class="form-control"
                            value="{{ $user && $user->email ? $user->email : '' }}"
                        >
                    </div>
                    @if(!$org_id)
                        <div class="form-group">
                            <label for="org_id">Organisation</label>
                            <select class="form-control" id="org_id" name="org_id">
                                <option value="">Please select...</option>
                                <option value="99999" >--- DonateMate ---</option>
                                @foreach($orgs as $org)
                                    @php
                                        $selected = '';
                                        if ($user && $user->org_id && $user->org_id == $org->id) {
                                            $selected = 'selected';
                                        }
                                    @endphp
                                    <option value="{{ $org->id }}" {{ $selected }}>{{ $org->org_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <input type="hidden" name="org_id" value="{{ $org_id }}">
                    @endif

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
