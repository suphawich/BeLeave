
@extends('layout.go')






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
                              <img src="images/cover/person.png" alt="Los Angeles" width="100%" height="500">
                              <div class="carousel-caption">
                                <h3><a href="/leave">Leave now</a></h3>
                                <p>When you busy day</p>
                              </div>
                            </div>
                            <div class="carousel-item">
                              <img src="images/cover/summer.png" alt="Chicago" width="100%" height="500">
                              <div class="carousel-caption">
                                <h3><a href="/leave">Leave now</a></h3>
                                <p>You want to take a rest</p>
                              </div>
                            </div>
                            <div class="carousel-item">
                              <img src="images/cover/sick.jpg" alt="New York" width="100%" height="500">
                              <div class="carousel-caption">
                                <h3><a href="/leave">Leave now</a></h3>
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





        </div>






</div>
@if(count($requests) > 0)


<div class="mt-5 card">

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" style="font-size:30px" href="#">Leave Request</a>
    </li>
    <li class="nav-item">
      <a class="nav-link mt-2 ml-2" href="manage/request/leave">view all</a>
    </li>

  </ul>
</nav>



<div class="row mt-2 ">


@foreach ($requests as $request)

<div class="row">


    <div class="col-lg-5">
        <div class="media">
            <a class="pull-left" href="{{ url('/users/' . $request->subordinate_id.'/profile') }}">
                <img class="media-object dp img-circle" src="{{ $request->avatar ?? '/images/profiles/user_default.jpg' }}" style="width: 100px;height:100px;">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{ $request->full_name}} <small> {{ $request->leave_type}}</small></h4>
                <h5>{{ $request->task}}      <a href="{{ url('/users/' . $request->subordinate_id.'/profile') }}" >profile</a></h5>
                <p>Arrive Date : {{ date_format(date_create($request->depart_at),"m/d/Y") }}</p>
                <p>Day : {{date_diff(date_create($request->depart_at), date_create($request->arrive_at))->format(" %a ")}}</p>

                    <p>Description : {{ $request->description}}</p>

                <hr style="margin:8px auto">



            </div>
        </div>

    </div>



</div>










@endforeach

</div>

</div>
@endif







@if(Auth::user()->access_level === 'Manager')
<div class="mt-4">

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" style="font-size:30px" href="#">Package</a>
    </li>
    <li class="nav-item">
      <a class="nav-link mt-2 ml-2" href="plan">view all</a>
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
      <p>  Description: {{$plan->detail}} </p>
      <p>Capacity: {{$plan->capacity}}</p>

      <p>Expire: {{$plan->exprie}} day</p>
    </div>
    <div class="card-action row">



        <div class="col-12">

          <div class="row">
            <div class="col-2">

            </div>


            <div class="col-8">
                <a href="/subscription/{{ Auth::user()->id }}"><button type="button" class="form-control" name="button" style="width:100%"  >Buy Packet</button></a>

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
@endif





@endforeach

</div>

</div>

@endif

@push('script')

<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="//code.jquery.com/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<link href="css/bootstrap-form-helpers.min.css" rel="stylesheet">
<script src="js/bootstrap-formhelpers.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<link rel="shortcut icon" type="image/png" href="img/favicon.ico"/>
<!-- <style type="text/css"> -->



<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<style media="screen">
.media
{
   /*box-shadow:0px 0px 4px -2px #000;*/
   margin: 20px 0;
   padding:30px;
}
.dp
{
   border:10px solid #eee;
   transition: all 0.2s ease-in-out;
}
.dp:hover
{
   border:2px solid #eee;
   transform:rotate(360deg);
   -ms-transform:rotate(360deg);
   -webkit-transform:rotate(360deg);
   /*-webkit-font-smoothing:antialiased;*/
}
</style>
@endpush




@endsection





<script>
function myFunction(index) {
  console.log("approve"+index);
  document.getElementById("approve"+index).disabled = true;
  document.getElementById("approve"+index).innerHTML = "Approved";
}
</script>
