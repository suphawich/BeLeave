@extends('layout.form_account')

@push('style')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    {{-- <script src="/js/app.js" charset="utf-8"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script>

    </script>
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
                <div class="form-group input-group">
                    {{-- <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div> --}}
                    <input type="text" class="form-control" name="full_name" pattern="[A-Za-z]" placeholder="Full name*" required>
                    {{-- <input type="text" class="form-control" placeholder="Middle name*" required> --}}
                </div>
                <div class="form-group input-group">
                    <input type="text" class="form-control" name="company_name" pattern="[A-Za-z]" placeholder="Comoany name*" required>
                </div>
                <div class="form-group input-group">
                    <input type="email" class="form-control" name="company_email" placeholder="Company email*" required>
                </div>
                {{-- <div id="password-container" class="form-group input-group" v-if="isShowPasswordContainer">
                    <input type="password" class="form-control" placeholder="Password" required>
                </div> --}}
                <div class="form-group input-group">
                    <input type="text" class="form-control" name="address" placeholder="Address" required>
                </div>
                <div class="form-group input-group">
                    <input type="tel" class="form-control" name="tel" placeholder="Phone" required>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input agree-checkbox" name="agree" required>
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
