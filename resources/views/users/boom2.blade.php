<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <style media="screen">
      * { box-sizing: border-box;  }
      .card{
  position: absolute;
  overflow: hidden;
  top: 50%;
  left: 50%;
  width: 370px;
  transform: translateX(-50%) translateY(-50%);
  background-color: #fff;
  box-shadow: 0px 0px 20px rgba(0,0,0, 0.1);
  transition: box-shadow $duration;
}

.card a{
  color:inherit;
  text-decoration: none;
}

.card:hover{
  box-shadow: 0px 0px 50px rgba(0,0,0,0.3);
}

.card__date{
  position: absolute;
  top: 20px;
  right: 20px;

  width: 45px;
  height: 45px;
  padding-top: 10px;

  color: #FFF;
  text-align: center;
  line-height: 13px;
  font-weight: bold;

  background-color: $color;
  border-radius: 50%;

  &__day{
    display: block;
    font-size: 14px;
  }

  &__month{
    display: block;
    font-size: 10px;
    text-transform: uppercase;
  }
}

.card__thumb{
  height: 235px;
  overflow: hidden;
  background-color: #000;
  transition: height $duration;

  img{
    display: block;
    opacity: 1;
    transition: opacity $duration, transform $duration;
    transform: scale(1);
  }

  .card:hover & img{
    opacity: 0.6;
    transform: scale(1.2);
  }
  .card:hover &{
    height: 235px - 145px;
  }
}

.card__body{
  position: relative;
  padding: 20px;
  height: 185px;
  transition: height $duration;

  .card:hover &{ height: 185px + 145px; }
}
.card__description{
  position: absolute;
  left: 20px;
  right: 20px;
  bottom: 65px;

  margin: 0;
  padding: 0;

  color: #666C74;
  font-size: 14px;
  line-height: 27px;

  opacity: 0;
  transition: opacity $duration - 0.1s, transform $duration - 0.1s;
  transition-delay: 0s;
  transform: translateY(25px);

  .card:hover &{
    opacity: 1;
    transition-delay: 0.1s;
    transform: translateY(0);
  }
}

.card__footer{
  position: absolute;
  bottom: 20px;
  left: 20px;
  right: 20px;

  font-size: 11px;
  color: #A3A9AB;

  .icon--comment{
    margin-left: 12px;
  }
}
.card__title{
  margin: 0;
  padding: 0 0 10px 0;

  font-size: 22px;
  color: #000;
  font-weight: bold;

  .card:hover &{
    animation: titleBlur $duration;
  }
}

.card__subtitle{
  margin: 0;
  padding: 0 0 10px 0;

  font-size: 19px;
  color: $color;

  .card:hover &{
    animation: subtitleBlur $duration;
  }
}

@keyframes titleBlur {
  0%{
    opacity:0.6;
    text-shadow: 0px 5px 5px rgba(0,0,0,0.6);
  }
  100%{
    opacity:1;
    text-shadow: 0px 5px 5px rgba(0,0,0,0);
  }
}

@keyframes subtitleBlur {
  0%{
    opacity:0.6;
    text-shadow: 0px 5px 5px rgba($color,0.6);
  }
  100%{
    opacity:1;
    text-shadow: 0px 5px 5px rgba($color,0);
  }
}
    </style>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>



    <article class="card">
  <header class="card__thumb">
    <a href="#">
      <img src="http://lorempicsum.com/futurama/370/235/2">
    </a>
  </header>
  <div class="card__date">
    <span class="card__date__day">12</span>
    <span class="card__date__month">Mai</span>
  </div>
  <div class="card__body">
    <div class="card__category"><a href="#">Photos</a></div>
    <h2 class="card__title"><a href="#">Bender Should Not Be Allowed on TV</a></h2>
    <div class="card__subtitle">A Head in the Polls</div>
    <p class="card__description">
      With a warning label this big, you know they gotta be fun! This is the worst part. The calm before the battle. No! The cat shelter's on to me. Yes, I saw. You were doing well, until everyone died. Daylight and everything.
    </p>
  </div>
  <footer class="card__footer">
    <button type="button" class="form-control" name="button"></button>
  </footer>
</article>

  </body>
</html>
