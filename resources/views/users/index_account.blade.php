@extends('layout.go')

@push('style')
    <link href="{{ asset('css/accounts.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/vue-clickaway@2.2.2/dist/vue-clickaway.min.js"></script>
@endpush

@section('title')
    Accounts
@endsection

@section('script-data')
    isCopyUrl: false,
    isShowNewUser: false,
@endsection

@section('script-methods')
    clickNewUser: function () {
        this.isShowNewUser = true;
    },
    closeNewUser: function () {
        this.isShowNewUser = false;
    },
    copyToClipboard: function (event) {
        event.target.select();
        document.execCommand('copy');
        this.isCopyUrl = true;
        {{-- @focus="$event.target.select()" --}}
    },
    clickAwayUrl: function () {
        this.isCopyUrl = false;
    }
@endsection

@section('content')
    <div class="container-fluid body-content">
        <div class="row">
            <div class="row table-row table-header" >
                <div class="col">1</div>
                <div class="col">Mark</div>
            </div>
            @foreach ($users as $user)
            <div class="row table-row table-body">
                <div class="col">{{ $user->id }}</div>
                <div class="col">{{ $user->full_name }}</div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-2 ml-auto mr-auto mt-5">
            {!! $users->render() !!}
            </div>
        </div>
        <div class="row">

        </div>
    </div>
@endsection
