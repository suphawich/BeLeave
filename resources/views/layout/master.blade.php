<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <meta charset="utf-8">
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
/* Make the image fully responsive */



.carousel-inner img {
    width: 100%;
    height: 30%;
    
}


.carousel-inner{
  -webkit-filter: blur(3px);
  -moz-filter: blur(3px);
  -o-filter: blur(3px);
  -ms-filter: blur(3px);
  filter: blur(3px);
}
.animate_words{
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  font-size: 10vw;
  color: white;
}
span {
  text-shadow: 5px 2px #000000;
}

span:hover{
  cursor: pointer;
  
}

.animate_words span:nth-child(1):hover{
  animation: ani-one .9s ease-in-out infinite;
}

@keyframes ani-one {
  50%{
    transform: rotate(-30deg) translateX(-80px);
  }
}

.animate_words span:nth-child(2):hover{
  animation: ani-two .9s ease infinite;
}

@keyframes ani-two {
  0%{
 
  }
  
  50%{
    transform: rotate(360deg);
   
  }
}

.animate_words span:nth-child(3):hover{
  animation: ani-three .7s ease infinite;
}

@keyframes ani-three {
  0%{
    
  }
  
  50%{
      transform: skew(20deg, 10deg);
  }
  
  65%{
 
  }
}
.animate_words span:nth-child(4):hover{
  animation: ani-four .9s ease infinite;
}

@keyframes ani-four {
  0%{
 
  }
  
  50%{
   
  }
  
  65%{
    transform: translateY(-80px) ;
  }
  
}
.btn-outline-info , .btn-outline-primary  {
        width: 40%;
        
}


</style>

  </head>
  <body>
  <!-- <div class="row float-right">
            <ul class="list-inline">
            <br>
                <li class="list-inline-item"><button class="btn btn-success btn-sm"><a href="#">Login</a></button></li>
                <li class="list-inline-item"><button class="btn btn-danger btn-sm" name="trail-btn">Register</button></li>
            </ul>
        </div> -->

    
        <div id="demo" class="carousel slide" data-ride="carousel">
        
            <ul class="carousel-indicators">

            
                
                <!-- <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li> -->
                <div class="animate_words"ontouchstart="">
                    <span>Be</span>
                    <span>Le</span>
                    <span>av</span>
                    <span>e!</span>
                    
                    <div class="carousel-caption">
                        <a href="/home"><button class="btn btn-outline-info text-light btn-lg">Login</button></a>
                        <a href="/register"><button class="btn btn-outline-primary text-light btn-lg"  name="trail-btn">Register</button></a>
                    </div>
                </div>
            </ul>
            

            


            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/kik 10-11 Apr 18_180425_0200.jpg" alt="Los Angeles" >
                </div>
                
                <!-- <div class="carousel-item">
                    <img src="images/kik 10-11 Apr 18_180425_0200.jpg" alt="Chicago" >
                </div>
                
                <div class="carousel-item">
                    <img src="images/kik 10-11 Apr 18_180425_0200.jpg" alt="New York" >
                </div> -->
                
                <!-- <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a> -->
        </div>
        <br>

  </body>
</html>