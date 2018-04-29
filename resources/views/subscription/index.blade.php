
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


<div class=" col-6">



<div class="col-s3 m7">
  <div class="card">
    <div class="card-image">

      <img src=" /images/slide3.jpg " style="width:100%;height:200px;">
      <h2 class="card-title ml-2"></h2>
    </div>
    <div class="card-content" style="padding:20px">
      <p class="lead">Full name: {{ Auth::user()->full_name }}</p>
      <p class="lead">Company: {{ Auth::user()->company_name }}</p>
      <p class="lead">Level: {{ Auth::user()->access_level }}</p>


    </div>
    <div class="card-action row">



        <div class="col-12 ml-3">

          @if(count($plan) > 0)

          <p class="lead">Package: {{ $plan[0]->plan }}</p>
          <p class="lead">Members: {{ count($subordinates)}}/{{ $plan[0]->capacity }}</p>
          <p class="lead">You have  {{ $day_left }} left</p>



            <div class="col-12">
              <center>


            <button class="btn btn-outline-dark"   disabled><a  href="/plan" role="button" >BUY PACKAGE</a></button>
            <br>
            <center>
            </div>



          @else

          <div class="col-12">
            <center>


          <a  href="/plan" role="button" ><button class="btn btn-outline-dark" >BUY PACKAGE</button></a>
          <br>
          <center>
          </div>





          @endif
          </p>
          <br>
          </div>


    </div>
  </div>

</div>
</div>
<div class="col-3">

</div>





</div>
@endsection
