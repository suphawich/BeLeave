<?php
use App\Supervisor; ?>
@extends('layout.go')

@push('style')
    
@endpush
@section('title')
    subscription
@endsection

@section('content')
<div class="jumbotron">
  <p class="lead">Full name:{{ session()->get('full_name') }}</p>
  <p class="lead">Company:{{ session()->get('company_name') }}</p>
  <p class="lead">Level:{{ session()->get('access_level') }}</p>


  <p>PACKAGE:{{}}</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="/register/plan" role="button">BUY PACKAGE</a>
  </p>
</div>
@endsection