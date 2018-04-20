@extends('layout.form_account')

@push('style')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="/js/app.js" charset="utf-8"></script>
@endpush

@section('title')
    Sign in - BeLeave
@endsection

@section('form')
    <form id="form-login" action="/login" method="post">
        <input type="hidden" name="_token" value={{ csrf_token() }}>
        @method('PUT')
        <div class="container">
            <div class="form-content">
                <div class="form-group text-center">
                    <img src="/images/logo.png" class="logo" alt="logo website">
                </div>
                <div class="alert alert-danger" v-if="{{ $isWrong or 'false' }}">
                    <strong>Please enter email or password again.</strong>
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="email" class="form-control" name="email" value="{{ $oldEmail or '' }}"
                    placeholder="Please enter E-mail address" required>
                </div>
                <div id="next-container" class="form-group" v-if="isShowNextContainer">
                    <button type="button" class="form-control btn btn-danger" v-on:click="showPasswordContainer">Next</button>
                </div>
                <div id="password-container" class="form-group input-group" v-if="isShowPasswordContainer">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" v-model="password" name="password" placeholder="Please enter Password" required>
                </div>
                <div id="login-container" class="form-group" v-if="isShowLoginContainer">
                    <button type="submit" class="form-control btn btn-danger"><i class="fa fa-sign-in"></i> Login</button>
                </div>
                <div class="center-block"><div class="connect-dashed login-dashed-margin-top"></div></div>
                <div class="text-center">
                    <a href="#"><i class="fa fa-lock"></i> Forget password?</a>
                    <br>
                    <a href="#"><i class="fa fa-user"></i> Sign up</a>
                </div>
            </div>
        </div>
    </form>
@endsection
