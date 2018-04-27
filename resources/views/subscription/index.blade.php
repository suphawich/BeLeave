
@extends('layout.go')

@push('style')

@endpush
@section('title')
    subscription
@endsection

@section('content')
@csrf
<div class="jumbotron">

  <p class="lead">Full name:{{ Auth::user()->full_name }}</p>
  <p class="lead">Company:{{ Auth::user()->company_name }}</p>
  <p class="lead">Level:{{ Auth::user()->access_level }}</p>


  <p>PACKAGE:</p>
  @if(Auth::user()->access_level == 'Manager' or Auth::user()->access_level == 'Guest' )
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="/plan" role="button">BUY PACKAGE</a>
  </p>
@endif
</div>

@endsection
