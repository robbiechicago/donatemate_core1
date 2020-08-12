@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">

                <div class="d-flex w-100 justify-content-between">
                    <h1 class="mb-1">{{ $org && $org->display_name ? $org->display_name : 'Create Organisation' }}</h1>
                    <a href="/org{{ $org && $org->id ? '/' . $org->id : '' }}" class="btn btn-outline-primary">Back</a>
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

                <form action="{{ $org && $org->id ? '/org/' . $org->id : '/org'}}" class="mt-5" method="post">
                    @csrf
                    @if($org && $org->id)
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="org_name">Organisation Name</label>
                        <input
                            type="text"
                            id="org_name"
                            name="org_name"
                            class="form-control"
                            value="{{ $org && $org->org_name ? $org->org_name : '' }}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="display_name">Display Name</label>
                        <input
                            type="text"
                            id="display_name"
                            name="display_name"
                            class="form-control"
                            value="{{ $org && $org->display_name ? $org->display_name : '' }}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="charity_number">Charity Number</label>
                        <input
                            type="text"
                            id="charity_number"
                            name="charity_number"
                            class="form-control"
                            value="{{ $org && $org->charity_number ? $org->charity_number : '' }}"
                        >
                    </div>
                    <div class="form-group form-check mt-4">
                        <input
                            type="checkbox"
                            class="form-check-input"
                            id="active"
                            name="active"
                            value="1"
                            {{ $org && $org->active ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="active">Active?</label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
