@extends('layout.form_account')

@push('style')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="/js/app.js" charset="utf-8"></script>
@endpush

@section('title')
    Sign up - BeLeave
@endsection

@section('form')
    <form id="form-register" method="get">
        <div class="container">
            <div class="form-content">
                <div class="form-group text-center">
                    <img src="/images/logo.png" class="logo" alt="logo website">
                </div>
                <div class="form-group text-center">
                    <span>Hello</span>
                </div>
                <div class="form-group input-group">
                    {{-- <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div> --}}
                    <input type="text" class="form-control" placeholder="First name*" required>
                    {{-- <input type="text" class="form-control" placeholder="Middle name*" required> --}}
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Last name*" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Middle name*" required>
                </div>
                <div class="form-group input-group">
                    <input type="text" class="form-control" placeholder="Comoany name*" required>
                </div>
                <div class="form-group input-group">
                    <input type="email" class="form-control" placeholder="Company email*" required>
                </div>
                {{-- <div id="password-container" class="form-group input-group" v-if="isShowPasswordContainer">
                    <input type="password" class="form-control" placeholder="Password" required>
                </div> --}}
                <div class="form-group input-group">
                    <input type="text" class="form-control" placeholder="Address" required>
                </div>
                <div class="form-group input-group">
                    <input type="tel" class="form-control" placeholder="Phone" required>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input agree-checkbox" required>
                        I agree to the <a href="#">term</a> and <a href="#">data policy</a>.
                    </label>
                </div>
                <div id="register-container" class="form-group">
                    <button type="submit" class="form-control btn btn-danger"><i class="fa fa-sign-in"></i> Get a account now</button>
                </div>
                <div class="center-block"><div class="connect-dashed login-dashed-margin-top"></div></div>
            </div>
        </div>
    </form>
@endsection
