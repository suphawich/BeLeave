
@extends('layout.go')

@push('style')

@endpush
@section('title')
    subscription
@endsection

@section('content')
@csrf
<div class="row mt-4 ">
  <div class="col-3">


  </div>


<div class="card col-6">

  <p class="lead">Full name:{{ Auth::user()->full_name }}</p>
  <p class="lead">Company:{{ Auth::user()->company_name }}</p>
  <p class="lead">Level:{{ Auth::user()->access_level }}</p>


  <p>PACKAGE:</p>

  <p class="lead">
    <a class="btn btn-outline-dark" href="/plan" role="button">BUY PACKAGE</a>
    <button type="button" class="form-control" name="button">{{ count($subordinates)}}</button>
  </p>
</div>
<div class="col-3">

</div>

</div>
@endsection
