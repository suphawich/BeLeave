
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style >
  iframes,
    h1, h2, h3, h4, h5, h6, p{
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
    }




    blockquote:before, blockquote:after,

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }
    .card {
    cursor: default;

    width: 371px;

    transform: -webkit-translate(-50%, -50%);
    transform: -moz-translate(-50%, -50%);
    transform: -ms-translate(-50%, -50%);
    transform: -o-translate(-50%, -50%);
    transform: translate(-50%, -50%);
}
.card-header {
    width: 371px;
    height: 235px;

    background-size: 371px 235px;

    border-radius: 1px 1px 0 0;
    -webkit-transition: all .3s ease-in-out;
    -moz-transition: all .3s ease-in-out;
    -ms-transition: all .3s ease-in-out;
    -o-transition: all .3s ease-in-out;
    transition: all .3s ease-in-out;
}
.logo {
    width: 100px;
    height: 50px;
    border: 0;
}

.card:hover .card-header {
    background-size: 403px 267px;

}
.card-header-mask {
    height: 100%;

    -webkit-transition: all .3s ease-in-out;
    -moz-transition: all .3s ease-in-out;
    -ms-transition: all .3s ease-in-out;
    -o-transition: all .3s ease-in-out;
    transition: all .3s ease-in-out;
}

/* .card:hover .card-header-mask {
    background-color: rgba(0, 0, 0, .6);
} */
.card-header:hover{
  color : black;

}
.card-header-date, .card-body-header-category {
    text-transform: uppercase;
    background-color: #EF5A31;
    color: #FFF;
    font-weight: bold;
    text-align: center;
}

.topnav a {
    color: #f2f2f2;
    border-left: 1px solid #78C76C;
    text-align: center;
    padding: 0 15px;
    line-height: 50px;
    text-decoration: none;
    font-size: 15px;
}

.topnav a:hover {
    background-color: #bbd3eb;
}

.card-body-header-category {
    position: absolute;
    font-size: 13px;
    top: -31px;
    left: 0;
    padding: 8px 14px;
    line-height: 15px;
}

.card-header-date {
    float: right;
    margin: 20px 20px 0 0;
    border-radius: 50%;
    font-weight: bold;
    padding: 12px 15px;
    line-height: 15px;
}

.card-header-date-day {
    font-size: 18px;
}

.card-header-date-month {
    font-size: 11px;
}
.card-body {
    background-color: #FFF;
    border-radius: 0 0 1px 1px;
    padding: 0 26px 26px 26px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, .2);

}
.card-body-header {
    position: absolute;
    left: 0;
    padding: 26px;
    background-color: #FFF;
    -webkit-transition: all .3s ease-in-out;
    -moz-transition: all .3s ease-in-out;
    -ms-transition: all .3s ease-in-out;
    -o-transition: all .3s ease-in-out;
    transition: all .3s ease-in-out;
      width: 100%
}

.card:hover .card-body-header {
    margin-top: -141px;
}
h1 {
    color: #23282D;
    letter-spacing: -1px;
    font-size: 24px;
    font-weight: bold;
}

.card-body-header-sentence {
    color: #EF5A31;
    margin-top: 14px;
    font-size: 19px;
}

.card-body-header-sentence span {
    font-style: italic;
}
.card-body-description {
    opacity: 0;
    color: #757B82;
    line-height: 30px;
    -webkit-transition: all .2s ease-in-out;
    -moz-transition: all .2s ease-in-out;
    -ms-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
    transition: all .2s ease-in-out;
}


.card:hover .card-body-description {
    opacity: 1;
    -webkit-transition: all .5s ease-in-out;
    -moz-transition: all .5s ease-in-out;
    -ms-transition: all .5s ease-in-out;
    -o-transition: all .5s ease-in-out;
    transition: all .5s ease-in-out;
}
.card-body-footer {
    position: relative;
    z-index: 10;
    margin-top: 14px;
    font-size: 14px;
    color: #9FA5A8;
}

.icon {
    display: inline-block;
    vertical-align: middle;
    margin-right: 2px;
}

.icon-time {
    margin-top: -3px;
    width: 10px;
    height: 17px;
    background: url(../images/icon-time.png) no-repeat;
}

.icon-comment {
    margin-top: -2px;
    margin-left: 12px;
    width: 14px;
    height: 14px;
    background: url(images/slide1.jpg) no-repeat;
}
      </style>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>


    <div class="row" style="background-color:#343a40">
        <div class="col-lg-3 col-xl-3 logo-content" style="background-color:#343a40">
            <a href="dashboard"><img src="/images/logo.png" class="logo" alt="logo website" style="background-color:#343a40"></a>
        </div>
        <div class="col"></div>
        <div class="col-lg-5 col-xl-4 d-none d-sm-none d-md-none d-lg-block" style="background-color:#343a40">
            <div class="row float-right topnav " style="background-color:#343a40">

                <a href="/users/{{ Auth::user()->id }}/edit" class="username"><span><i class="fa fa-user"></i></span><span>{{ Auth::user()->full_name }}</span></a>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span><i class="fa fa-sign-out"></i></span><span> Log Out</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>

        </div>

    </div>



    <div class="" style="text-align:center">

      <button class="form-control">
        <h2 style="font-size:20px">
      Choose You Packgage
    </h2>
    </button>
    </div>


    <div class="container">
          <div class="row">
    @foreach($plans as $plan)
    @if ($plan->id != 1 )



                  <div class="col-6 mt-5">
                  <div class="card" style="top:300px;left:300px;">

                  <!-- En-tête de la carte -->
                  <div class="card-header" style="background: url(images/slide2.jpg) no-repeat;background-size: 369px 235px">


                      <!-- Le masque pour l'effet d'assombrissement lors du survol -->
                      <div class="card-header-mask">
                          <div class="card-header-date">
                              <div class="card-header-date-month">{{$plan->capacity}} user</div>

                              <div class="card-header-date-month">{{$plan->exprie}} day</div>
                          </div>
                      </div>

                  </div>

                  <!-- Corps de la carte -->
                  <div class="card-body">

                      <!-- En-tête du corps -->
                      <div class="card-body-header">
                          <div class="card-body-category">Packgage</div>
                          <h1>{{$plan->name }}</h1>
                          <p class="card-body-sentence">
                              <span></span>BeMark Production<span></span>

                          </p>
                          <p>Price:{{$plan->price}} Baht</p>

                      </div>

                      <!-- Description cachée par l'en-tête -->
                      <br>
                      <p class="card-body-description">
                          Description: {{$plan->detail}}<br>
                          <p>Capacity: {{$plan->capacity}}</p>

                          <p>Expire: {{$plan->exprie}} day</p>

                      </p>

                      <!-- Pied de la carte -->
                      <br>
                      <div class="card-body-footer">
                        <button type="button" class="form-control" name="button"><a href="/register/{{ Auth::user()->id}}/payment/{{$plan->id}">Buy Packgage</a></button>

                      </div>

                  </div>

              </div>

            </div>
            @endif
            @endforeach
          </div>
  </div>



  </body>
</html>
