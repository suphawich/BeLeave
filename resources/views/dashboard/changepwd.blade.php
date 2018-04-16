@extends('layout.go')

@push('style')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endpush

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container-fluid profile-content">
        <form action="edit-profile" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value={{ csrf_token() }}>
        <div class="row float-right d-none d-sm-none d-md-none d-lg-block">
            <button type="submit" class="btn btn-secondary mr-2" name="save">Save changes</button>
            <button type="reset" class="btn btn-success" name="cancel">Cancel</button>
        </div>
        <div class="row">
            <div class="col-xl-8 col-md-6 info-content">
                <div class="alert alert-danger" v-if="{{ $emailalready or 'false' }}">
                    <strong>E-mail is already, please try again.</strong>
                </div>
                {{-- <p>{{session()->get('status')}}</p> --}}
                <div class="form-group input-group">
                    <label class="form-topic">Current Password</label>
                    <input type="password" class="form-control form-field" name="current_password" pattern="[A-Za-z][A-Za-z ]+" placeholder="Current Password*" required>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 avatar-content text-center">
            </div>
        </div>
        <div class="row float-right d-block d-sm-block d-md-block d-lg-none d-xl-none submit-content">
            <button type="submit" class="btn btn-secondary mr-2" name="save2">Save changes</button>
            <button type="reset" class="btn btn-success" name="cancel2">Cancel</button>
        </div>
        </form>
    </div>
@endsection
