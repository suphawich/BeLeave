@extends('layout.go')

@push('style')
    <link href="{{ asset('css/accounts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endpush

@push('script')

@endpush

@section('title')
    Accounts
@endsection

@section('script-data')

@endsection

@section('script-methods')

@endsection

@section('script-query')

@endsection

@section('content')
    <div class="container-fluid body-content">
        <div class="row">
            @if (count($errors) > 0)
                <div class="col-12 alert alert-danger text-center">
                    @foreach ($errors->all() as $error)
                        <b>{{ $error }}</b>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-12">
                <form action="/account/accounts" method="post">
                @csrf
                @method('PUT')
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <select class="form-control input-group-item" name="search_type">
                            @foreach ($type as $key => $value)
                                @if ($key == ($search_type ?? ''))
                                    <option value="{{ $key }}" selected>{{ $value }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <input class="form-control" type="text" name="search" value="{{ $search ?? '' }}" placeholder="Please enter to searching..">
                    <input type="submit" name="save" style="display: none;">
                </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="row table-row table-header" >
                <div class="col-1">#</div>
                <div class="col">Full Name</div>
                <div class="col">Company Name</div>
                <div class="col">Type</div>
            </div>
            @if (count($users) > 0)
                @foreach ($users as $user)
                <div class="row table-row table-body" data-toggle="collapse" data-target="#c-{{ $user->id }}">
                    <div class="col-1">{{ $user->id }}</div>
                    <div class="col">{{ $user->full_name }}</div>
                    <div class="col">{{ $user->company_name }}</div>
                    <div class="col">{{ $user->access_level }}</div>
                </div>
                <div class="row">
                    <form action="/users/{{ $user->id }}/account" method="post">
                    @csrf
                    @method('PUT')
                    <div id="c-{{ $user->id }}" class="row collapse">
                        <div class="container col-12">
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
                                    @if ($user->access_level == 'Administrator')
                                        <select class="form-control form-field" name="access_level" disabled>
                                            <option value="Administrator">Administrator</option>
                                        </select>
                                    @else
                                        <select class="form-control form-field" name="access_level">
                                        @foreach ($access_level as $key => $value)
                                            @if ($key == $user->access_level)
                                                <option value="{{ $key }}" selected>{{ $value }}</option>
                                            @else
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                            <div class="row float-right" style="padding: 0 25% 2% 25%;">
                                <button type="submit" class="btn btn-light mr-2" name="save" >Save changes</button>
                                <button type="reset" class="btn btn-light" name="cancel" >Cancel</button>
                                @if ($user->access_level != 'Administrator')
                                    <a href="/users/{{ $user->id }}/delete" class="btn btn-light" onclick="return confirm('Are you sure you want to ban {{ $user->full_name }}?');">Ban</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                @endforeach
            @else
                <div class="row table-row table-body text-center">
                    <div class="col-12 mt-5 mb-5">No found account.</div>
                </div>
            @endif
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
