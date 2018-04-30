@extends('layout.go')

@push('style')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endpush

@section('title')
    Profile
@endsection

@section('script-data')
    isShowChangePassword: false,
@endsection

@section('script-methods')
    showChangepwd: function () {
        this.isShowChangePassword = true;
    },
    backToProfile: function () {
        this.isShowChangePassword = false;
    },
@endsection

@section('content')
    <div class="container-fluid profile-content">
        <form action="/users/{{ $user->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row float-right d-none d-sm-none d-md-none d-lg-block">
            <button type="submit" class="btn btn-secondary mr-2" name="save" v-if="isShowChangePassword">Change password</button>
            <button type="submit" class="btn btn-secondary mr-2" name="save" v-else>Save changes</button>
            <button type="reset" class="btn btn-success" name="cancel" v-if="isShowChangePassword" v-on:click="backToProfile">Cancel</button>
            <button type="reset" class="btn btn-success" name="cancel" v-else>Cancel</button>
        </div>
        {{-- <p>{{session()->get('status')}}</p> --}}
        <div class="row" v-if="isShowChangePassword">
            <div class="col-xl-8 col-md-6 info-content">
                @if (session()->has('error') || count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>{{ session()->get('error') }}</strong>
                        @foreach ($errors->all() as $message)
                            <strong>{{ $message }}</strong>
                        @endforeach
                    </div>
                @endif
                <div class="form-group input-group">
                    <label class="form-topic">Current Password</label>
                    <input type="password" class="form-control form-field" name="current_password" pattern="[A-Za-z][A-Za-z ]+" placeholder="Current Password*" required>
                </div>
                <div class="form-group input-group">
                    <label class="form-topic">New Password</label>
                    <input type="password" class="form-control form-field" name="password" pattern="[A-Za-z][A-Za-z ]+" placeholder="New Password*" required>
                </div>
                <div class="form-group input-group">
                    <label class="form-topic">Confirm Password</label>
                    <input type="password" class="form-control form-field" name="password_confirm" pattern="[A-Za-z][A-Za-z ]+" placeholder="Confirm Password*" required>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 avatar-content text-center">
            </div>
        </div>
        <div class="row" v-else>
            <div class="col-xl-8 col-md-6 info-content">
                @if (session()->has('error') || count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>{{ session()->get('error') }}</strong>
                        @foreach ($errors->all() as $message)
                            <strong>{{ $message }}</strong>
                        @endforeach
                    </div>
                @endif
                {{-- <p>{{session()->get('status')}}</p> --}}
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
                @if ($user->access_level != 'Administrator' or $user->access_level != 'Manager')
                    <div class="form-group input-group">
                        <label class="form-topic">Supervisor name</label>
                        <input type="text" class="form-control form-field" name="supervisor_name" disabled value="{{ $user->supervisor_name }}">
                    </div>
                @endif
                <div class="form-group input-group">
                    <label class="form-topic">Access Level</label>
                    <input type="text" class="form-control form-field" name="access_level" disabled value="{{ Auth::user()->access_level }}">
                </div>
            </div>
            <div class="col-xl-4 col-md-6 avatar-content text-center">
                <img src="{{ $user->avatar ?? '/images/profiles/user_default.jpg' }}" class="avatar circle mb-5 mt-4">
                <input type="file" class="form-control form-file mb-4 ml-auto mr-auto" name="file">
                <button type="button" name="change-password" class="btn btn-primary mb-5" v-on:click="showChangepwd">Change password</button>
            </div>
        </div>
        <div class="row float-right d-block d-sm-block d-md-block d-lg-none d-xl-none submit-content">
            <button type="submit" class="btn btn-secondary mr-2" name="save2" v-if="isShowChangePassword">Change password</button>
            <button type="submit" class="btn btn-secondary mr-2" name="save2" v-else>Save changes</button>
            <button type="reset" class="btn btn-success" name="cancel2" v-if="isShowChangePassword" v-on:click="backToProfile">Cancel</button>
            <button type="reset" class="btn btn-success" name="cancel2" v-else>Cancel</button>
        </div>
        </form>
    </div>
@endsection
