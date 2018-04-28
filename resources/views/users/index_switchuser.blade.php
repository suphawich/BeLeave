@extends('layout.go')

@push('style')
    <link href="{{ asset('css/accounts.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/profile.css') }}" rel="stylesheet"> --}}

@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/vue-clickaway@2.2.2/dist/vue-clickaway.min.js"></script>
@endpush

@section('title')
    Switch
@endsection

@section('script-data')

@endsection

@section('script-methods')

@endsection

@section('content')
    <div class="container-fluid body-content">
        Hello
    </div>
@endsection
