@extends('layout.go')

@push('style')
    <link href="{{ asset('css/users.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/vue-clickaway@2.2.2/dist/vue-clickaway.min.js"></script>
@endpush

@section('title')
    Setting
@endsection

@section('script-data')

@endsection

@section('script-methods')

@endsection

@section('content')
    <div class="container-fluid body-content">
        <div class="row">
            <div class="col-md-6 col-sm-8 col-12 pl-0 pr-0" >
                <div class="card">
                    <div class="card-header">
                        <span>Features</span>
                    </div>
                    <div class="card-body">
                        <span>Request Supervisor</span>
                        @if ($setting->r2sup)
                            <a name="request" class="btn btn-light float-right" style="cursor: no-drop;">Approved</a>
                        @elseif ($setting->is_r2sup)
                            <a name="request" class="btn float-right" style="cursor: no-drop;" disabled>Pending</a>
                        @else
                            <a href="/setting/r2sup" name="request" class="btn btn-light float-right">Request</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
