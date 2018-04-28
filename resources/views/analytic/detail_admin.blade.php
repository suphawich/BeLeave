@extends('layout.go')

@push('style')
    {{-- <link href="{{ asset('css/users.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/accounts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endpush

@push('script')
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue-clickaway@2.2.2/dist/vue-clickaway.min.js"></script> --}}
@endpush

@section('title')
    Graph
@endsection

@section('script-data')

@endsection

@section('script-methods')

@endsection

@section('content')
    <div class="container-fluid body-content">
        <div class="row">
            <div class="row table-row table-header" >
                <div class="col-3">Website</div>
                <div class="col">Detail</div>
            </div>
        </div>
        <div class="row">
            @foreach ($data_website as $key => $value)
                <div class="row table-row table-body">
                    <div class="col-3">{{ $key }}</div>
                    <div class="col">{{ $value }}</div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="row table-row table-header" >
                <div class="col-3">Number of User</div>
                <div class="col">Detail</div>
            </div>
        </div>
        <div class="row">
            @foreach ($data_user as $key => $value)
                <div class="row table-row table-body">
                    <div class="col-3">{{ $key }}</div>
                    <div class="col">{{ $value }} Users</div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="row table-row table-header" >
                <div class="col-3">Plan</div>
                <div class="col">Detail</div>
            </div>
        </div>
        <div class="row">
            @foreach ($data_plan as $key => $value)
                <div class="row table-row table-body">
                    <div class="col-3">
                        {{ $key }}
                        @if ($key != 'Total Plan')
                            ({{ $data_price_plan[$key][0] }} $)
                        @endif
                    </div>
                    <div class="col">
                        {{ $value }} Users
                        {{-- @if (array_key_exists($key, $data_price_plan)) --}}
                            ({{ $data_price_plan[$key][1] }} $)
                        {{-- @endif --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
