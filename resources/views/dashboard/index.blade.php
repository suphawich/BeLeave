@extends('layout.go')

@push('style')

@endpush

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container-fluid" style="background-color: green; margin-top: 5px;">
        <h2>Hello</h2>
        <p>In this example, we have added a dropdown menu inside the sidebar.</p>
        <p>Notice the caret-down icon, which we use to indicate that this is a dropdown menu.</p>
    </div>
@endsection
