@extends('layout.go')

@push('style')
<style>
/* Make the image fully responsive */
.carousel-inner img {
    width: 100%;

}
</style>

@endpush



@section('title')
    Dashboard
@endsection

@section('content')
<br>

<div class="row">


        <div class="card col-12">


                        <br>
                          <div id="demo" class="carousel slide" data-ride="carousel">
                          <ul class="carousel-indicators">
                            <li data-target="#demo" data-slide-to="0" class="active"></li>
                            <li data-target="#demo" data-slide-to="1"></li>
                            <li data-target="#demo" data-slide-to="2"></li>
                          </ul>
                          <div class="carousel-inner">
                            <div class="carousel-item active">
                              <img src="images/cover/person.png" alt="Los Angeles" width="1100" height="500">
                              <div class="carousel-caption">
                                <h3><a href="/history">Leave now</a></h3>
                                <p>When you busy day</p>
                              </div>
                            </div>
                            <div class="carousel-item">
                              <img src="images/cover/summer.png" alt="Chicago" width="1100" height="500">
                              <div class="carousel-caption">
                                <h3><a href="/history">Leave now</a></h3>
                                <p>You want to take a rest</p>
                              </div>
                            </div>
                            <div class="carousel-item">
                              <img src="images/cover/sick.jpg" alt="New York" width="1100" height="500">
                              <div class="carousel-caption">
                                <h3><a href="/history">Leave now</a></h3>
                                <p>If you get sick</p>
                              </div>
                            </div>
                          </div>
                          <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                          </a>
                          <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                          </a>
                        </div>
                        <br>



<!--
                        <div class="">
                          <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                        <ul class="navbar-nav">
                          <li class="nav-item active">
                            <a class="nav-link" href="#">FEATURE </a>
                          </li>

                        </ul>
                      </nav>


                        <div class="row">

                          <div class="col-6 ">






                          <div class="w3-container">


                            <div class="w3-card-4" style="width:100%">
                              <header class="w3-container w3-light-grey">
                                <h3>John Doe</h3>
                              </header>
                              <div class="w3-container">
                                <p>1 new friend request</p>
                                <hr>
                                <img src="images/BGtest.jpg" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                                <p>CEO at Mighty Schools. Marketing and Advertising. Seeking a new job and new opportunities.</p><br>
                              </div>
                              <button class="w3-button w3-block w3-dark-grey">+ Connect</button>
                            </div>
                          </div>
                          </div>


                          <br>

                          <div class="col-6">







                          <div class="w3-container">



                            <div class="w3-card-4" style="width:100%">
                              <header class="w3-container w3-light-grey">
                                <h3>John Doe</h3>
                              </header>
                              <div class="w3-container">
                                <p>1 new friend request</p>
                                <hr>
                                <img src="images/slide2.jpg" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                                <p>CEO at Mighty Schools. Marketing and Advertising. Seeking a new job and new opportunities.</p><br>
                              </div>
                              <button class="w3-button w3-block w3-dark-grey">+ Connect</button>
                            </div>
                          </div>
                          </div>
                        </div>
                          <br>

                        </div> -->




        </div>






</div>
@if(count($requests) > 0)


<div class="">

<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" style="font-size:30px" href="#">Leave Request</a>
    </li>
    <li class="nav-item">
      <a class="nav-link mt-3 ml-2" href="manage/request/leave">view all</a>
    </li>

  </ul>
</nav>



<div class="row mt-2">


@foreach ($requests as $request)





  <div class="row col-4 ml-1">

<div class="col-s3 m7">
  <div class="card">
    <div class="card-image">

      <img src=" {{ $request->avatar }} " style="width:100%;height:200px;">
      <h2 class="card-title ml-2">{{ $request->leave_type }}</h2>
    </div>
    <div class="card-content" style="padding:20px">
      <h5 class="ml-2 ">{{$request->full_name}}</h5>
      <p class="ml-2">Depart Date: {{ date_format(date_create($request->depart_at),"m/d/Y") }}</p>
      <p class="ml-2">Day: {{date_diff(date_create($request->depart_at), date_create($request->arrive_at))->format(" %a ")}}</p>

    </div>
    <div class="card-action row">
      @if($request->is_enabled)
      <div class="col-12">

        <div class="row">
          <div class="col-2">

          </div>
          <div class="col-8">
              <button type="button" href="/manage/request/leave/{{ $request->id }}" onclick="myFunction({{$request->subordinate_id}})" id="approve{{$request->subordinate_id}}" class="btn btn-outline-dark" name="button" id="app" style="width:100%" >Approve</button>

          </div>


          <div class="col-2">

          </div>

        </div>



        <br>
        </div>
        @else

        <div class="col-12">

          <div class="row">
            <div class="col-2">

            </div>


            <div class="col-8">
                <button type="button" class="btn btn-outline-dark" name="button" style="width:100%" disabled >Approved</button>

            </div>
            <div class="col-2">

            </div>

          </div>



          <br>
          </div>

        @endif
    </div>
  </div>
</div>
</div>



@endforeach

</div>

</div>
@endif








<div class="">

<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" style="font-size:30px" href="#">Packet</a>
    </li>
    <li class="nav-item">
      <a class="nav-link mt-3 ml-2" href="plan">view all</a>
    </li>

  </ul>
</nav>



<div class="row mt-2">


@foreach ($plans as $plan)
@if ($plan->id != 1)





  <div class="row col-4 ml-1">

<div class="col-s3 m7">
  <div class="card">
    <div class="card-image">

      <img src=" /images/slide3.jpg " style="width:100%;height:200px;">
      <h2 class="card-title ml-2">{{ $plan->name }}</h2>
    </div>
    <div class="card-content" style="padding:20px">
      <p>Price:{{$plan->price}} Baht</p>


      Description: {{$plan->detail}}<br>
      <p>Capacity: {{$plan->capacity}}</p>

      <p>Expire: {{$plan->exprie}} day</p>
    </div>
    <div class="card-action row">
      @if($request->is_enabled)
      <div class="col-12">

        <div class="row">
          <div class="col-2">

          </div>
          <div class="col-8">
              <button type="button" href="/manage/request/leave/{{ $request->id }}" onclick="myFunction({{$request->subordinate_id}})" id="approve{{$request->subordinate_id}}" class="btn btn-outline-dark" name="button" id="app" style="width:100%" >Approve</button>

          </div>


          <div class="col-2">

          </div>

        </div>



        <br>
        </div>
        @else

        <div class="col-12">

          <div class="row">
            <div class="col-2">

            </div>


            <div class="col-8">
                <button type="button" class="btn btn-outline-dark" name="button" style="width:100%" disabled >Approved</button>

            </div>
            <div class="col-2">

            </div>

          </div>



          <br>
          </div>

        @endif
    </div>
  </div>
</div>
</div>
@endif



@endforeach

</div>

</div>




@endsection





<script>
function myFunction(index) {
  console.log("approve"+index);
  document.getElementById("approve"+index).disabled = true;
  document.getElementById("approve"+index).innerHTML = "Approved";
}
</script>
