@extends('layout.go')

@push('style')
    <link href="{{ asset('css/accounts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">

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
                <div class="col-1">#</div>
                <div class="col">Full Name</div>
                <div class="col">Company Name</div>
                <div class="col">Type</div>
            </div>
            @foreach ($users as $user)
            <div class="row table-row table-body" data-toggle="collapse" data-target="#c-{{ $user->id }}">
                <div class="col-1">{{ $user->id }}</div>
                <div class="col">{{ $user->full_name }}</div>
                <div class="col">{{ $user->company_name }}</div>
                <div class="col">{{ $user->access_level }}</div>
            </div>
            <form action="/users/{{ $user->id }}/account" method="post">
            @csrf
            @method('PUT')
            <div id="c-{{ $user->id }}" class="row collapse">
                <div class="container col">
                    <div class="row" style="padding: 2% 25% 0 25%;">
                        <div class="form-group input-group">
                            <label class="form-topic">Full Name</label>
                            <input type="text" class="form-control form-field" name="full_name" pattern="[A-Za-z][A-Za-z ]+" placeholder="Full name*" required value="{{ $user->full_name }}">
                        </div>
                        <div class="form-group input-group">
                            <label class="form-topic">Company Name</label>
                            <input type="text" class="form-control form-field" name="company_name" pattern="[A-Za-z][A-Za-z ]+" placeholder="Comoany name*" required value="{{ $user->company_name }}">
                        </div>
                        <div class="form-group input-group">
                            <label class="form-topic">Company E-mail</label>
                            <input type="email" class="form-control form-field" name="company_email" placeholder="Company email*" required value="{{ $user->email }}">
                        </div>
                        <div class="form-group input-group">
                            <label class="form-topic">Address</label>
                            <input type="text" class="form-control form-field" name="address" placeholder="Address" required value="{{ $user->address }}">
                        </div>
                        <div class="form-group input-group">
                            <label class="form-topic">Phone Number</label>
                            <input type="tel" class="form-control form-field" name="tel" placeholder="Phone" pattern="[0-9][0-9+]+" required value="{{ $user->tel }}">
                        </div>
                        <div class="form-group input-group">
                            <label class="form-topic">Access Level</label>
                            <input type="text" class="form-control form-field" name="access_level" value="{{ Auth::user()->access_level }}">
                        </div>
                    </div>
                    <div class="row float-right" style="padding: 0 25% 2% 25%;">
                        <button type="submit" class="btn btn-light mr-2" name="save" >Save changes</button>
                        <button type="reset" class="btn btn-light" name="cancel" >Cancel</button>
                        <a href="#" class="btn btn-light">Ban</a>
                    </div>
                </div>
            </div>
            </form>
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
