
@extends('layout.go')

@push('style')

@endpush
@section('title')
    Plan
@endsection

@section('content')

@foreach($plan as $plan)


<div class="jumbotron">
  <h1 class="lead">Packgage:{{$plan->name}}</h1>
  <p>Detail:{{$plan->detail}}<p>
  <p>capacity:{{$plan->capacity}}</p>
  <p>price:{{$plan->price}} bath</p>
  <p>exprie:{{$plan->exprie}} day</p>
  <br>
  <br>
  <p class="lead">

    <a class="btn btn-primary btn-lg" href="/register/{{ Auth::user()->id}}/payment/{{$plan->id}}" role="button">BUY PACKAGE</a>
  </p>
</div>
<br>
<br>
@endforeach


@endsection
