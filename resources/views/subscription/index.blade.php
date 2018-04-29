
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

  <p class="lead">Full name: {{ Auth::user()->full_name }}</p>
  <p class="lead">Company: {{ Auth::user()->company_name }}</p>
  <p class="lead">Level: {{ Auth::user()->access_level }}</p>

  @if(count($plan) > 0)

  <p class="lead">Package: {{ $plan[0]->plan }}</p>
  <p class="lead">Members: {{ count($subordinates)}}/{{ $plan[0]->capacity }}</p>
  <p class="lead">You have  {{ $day_left }} left</p>

  <p class="lead">
    <button class="btn btn-outline-dark" disabled><a  href="/plan" role="button" >BUY PACKAGE</a></button>

  </p>
  @else

  <p class="lead">
    <a class="btn btn-outline-dark" href="/plan" role="button">BUY PACKAGE</a>

  </p>




  @endif
  </p>
</div>
<div class="col-3">

</div>



  <div class="row col-4 ml-1">

<div class="col-s3 m7">
  <div class="card">
    <div class="card-image">

      <img src=" /images/slide3.jpg " style="width:100%;height:200px;">
      <h2 class="card-title ml-2"></h2>
    </div>
    <div class="card-content" style="padding:20px">
      <p>Price: Baht</p>
      <p>  Description:  </p>
      <p>Capacity: </p>

      <p>Expire:  day</p>
    </div>
    <div class="card-action row">



        <div class="col-12">

          <div class="row">
            <div class="col-2">

            </div>


            <div class="col-8">
                <button type="button" class="form-control" name="button" style="width:100%" >Buy Packet</button>

            </div>
            <div class="col-2">

            </div>

          </div>



          <br>
          </div>


    </div>
  </div>
</div>
</div>

</div>
@endsection
