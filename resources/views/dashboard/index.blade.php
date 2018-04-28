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
                              <img src="images/BGtest.jpg" alt="Los Angeles" width="1100" height="500">
                              <div class="carousel-caption">
                                <h3><a href="/history">Los Angeles</a></h3>
                                <p>We had such a great time in LA!</p>
                              </div>
                            </div>
                            <div class="carousel-item">
                              <img src="images/slide1.jpg" alt="Chicago" width="1100" height="500">
                              <div class="carousel-caption">
                                <h3>Chicago</h3>
                                <p>Thank you, Chicago!</p>
                              </div>
                            </div>
                            <div class="carousel-item">
                              <img src="images/slide2.jpg" alt="New York" width="1100" height="500">
                              <div class="carousel-caption">
                                <h3>New York</h3>
                                <p>We love the Big Apple!</p>
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

                        </div>




        </div>

        <div class="col-4  pl-1 pr-1 ml-3  card">

          <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">LEAVES </a>
          </li>

        </ul>
      </nav>








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

          <br>


          <div class="w3-container">


            <div class="w3-card-4" style="width:100%">
              <header class="w3-container w3-light-grey">
                <h3>John Doe</h3>
              </header>
              <div class="w3-container">
                <p>1 new friend request</p>
                <hr>
                <img src="images/slide.jpg" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                <p>CEO at Mighty Schools. Marketing and Advertising. Seeking a new job and new opportunities.</p><br>
              </div>
              <button class="w3-button w3-block w3-dark-grey">+ Connect</button>
            </div>
          </div>

          <br>


          <div class="w3-container">


            <div class="w3-card-4" style="width:100%">
              <header class="w3-container w3-light-grey" >
                <h3>Boomins</h3>
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

          <br>


          <div class="w3-container">


            <div class="w3-card-4" style="width:100%">
              <header class="w3-container w3-light-grey">
                <h3>John Doe</h3>
              </header>
              <div class="w3-container">
                <p>1 new friend request</p>
                <hr>
                <img src="images/slide1.jpg" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                <p>CEO at Mighty Schools. Marketing and Advertising. Seeking a new job and new opportunities.</p><br>
              </div>
              <button class="w3-button w3-block w3-dark-grey">+ Connect</button>
            </div>
          </div>

          <br>

          <div class="w3-container">


            <div class="w3-card-4" style="width:100%">
              <header class="w3-container w3-light-grey">
                <h3>John Doe</h3>
              </header>
              <div class="w3-container">
                <p>1 new friend request</p>
                <hr>
                <img src="images/slide3.jpg" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                <p>CEO at Mighty Schools. Marketing and Advertising. Seeking a new job and new opportunities.</p><br>
              </div>
              <button class="w3-button w3-block w3-dark-grey">+ Connect</button>
            </div>
          </div>

          <br>


        </div>
</div>

@endsection
