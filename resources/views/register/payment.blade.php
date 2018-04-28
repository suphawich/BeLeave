@extends('layout.form_account')

@push('style')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    <link href="{{ asset('css/register-payment.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    {{-- <script src="/js/app.js" charset="utf-8"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script>
    new Vue({
        el: '#form-payment',
        data: {
            isToggleCreditCard: false,
            isTogglePaypal: false
        },
        methods: {
            toggleCreditCard: function () {
                this.isToggleCreditCard = true;
                this.isTogglePaypal = false;
            },
            togglePaypal: function () {
                this.isTogglePaypal = true;
                this.isToggleCreditCard = false;
            }
        }
    });
    </script>
@endpush

@section('title')
    Payment - BeLeave
@endsection

@section('form')

    <form id="form-payment" method="get">
        <div class="container">
            <div class="form-content">
                <div class="form-group text-center">
                    <img src="/images/logo.png" class="logo" alt="logo website">
                </div>
                <div class="row">
                    <div class="col-12 col-lg-7">
                        <ul class="list-group payment-type-content">
                            <li class="list-group-item payment-type-header">HOW DO YOU WANT TO PAY?</li>
                            <li class="list-group-item payment-type-item">
                                <div class="">
                                    <input type="radio" name="payment_type" v-on:click="toggleCreditCard">
                                    <label class="payment-type-text" value="creditcard">Credit Card</label>
                                </div>
                                <div class="creditcard-form" v-if="isToggleCreditCard">
                                    <input type="text" name="creditcard-number" class="creditcard-form-number" placeholder="Credit Card Number" pattern="[0-9]" required>
                                    <input type="number" name="creditcard-month" class="creditcard-form-month" min="1" max="12" placeholder="month" required>
                                    <input type="text" name="creditcard-year" class="creditcard-form-year" placeholder="year" pattern="[0-9]" required>
                                    <input type="text" name="creditcard-cvv" class="creditcard-form-cvv" placeholder="CVV" required>
                                </div>
                            </li>
                            <li class="list-group-item payment-type-item">
                                <input type="radio" name="payment_type" v-on:click="togglePaypal" value="paypal">
                                <label class="payment-type-text">Paypal</label>
                            </li>
                        </ul>
                    </div>
                    <div class="col-5 d-none d-sm-none d-md-none d-lg-block">
                        <ul class="list-group payment-type-content">
                            <li class="list-group-item payment-type-header">CARD SUMMARY</li>
                            <li class="list-group-item payment-type-item">
                                <label>{{$plan->name}}</label>
                                <label class="float-right">20.00 usd</label>
                            </li>
                        </ul>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary payment-submit"><i class="fa fa-sign-in"></i> PLACE YOUR ORDER</button>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 d-md-block d-lg-none">
                        <ul class="list-group payment-type-content">
                            <li class="list-group-item payment-type-header">CARD SUMMARY</li>
                            <li class="list-group-item payment-type-item">
                                <label>Plan A</label>
                                <label class="float-right">20.00 usd</label>
                            </li>
                        </ul>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary payment-submit"><i class="fa fa-sign-in"></i> PLACE YOUR ORDER</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
