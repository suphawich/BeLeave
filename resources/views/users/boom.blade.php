<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <style media="screen">
  iframes,
    h1, h2, h3, h4, h5, h6, p{
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
    }

    article, aside, details, figcaption, figure,
    footer, header, hgroup, menu, nav, section {
        display: block;
    }

    blockquote, q {
        quotes: none;
    }

    blockquote:before, blockquote:after,
    q:before, q:after {
        content: '';
        content: none;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }
    .card {
    cursor: default;
    position: relative;
    width: 371px;
    top: 50%;
    left: 50%;
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
    background-position: 0 0;
    border-radius: 1px 1px 0 0;
    -webkit-transition: all .3s ease-in-out;
    -moz-transition: all .3s ease-in-out;
    -ms-transition: all .3s ease-in-out;
    -o-transition: all .3s ease-in-out;
    transition: all .3s ease-in-out;
}

.card:hover .card-header {
    background-size: 403px 267px;
    background-position: -16px -16px;
}
.card-header-mask {
    height: 100%;
    -webkit-transition: all .3s ease-in-out;
    -moz-transition: all .3s ease-in-out;
    -ms-transition: all .3s ease-in-out;
    -o-transition: all .3s ease-in-out;
    transition: all .3s ease-in-out;
}

.card:hover .card-header-mask {
    background-color: rgba(0, 0, 0, .6);
}
.card-header-date, .card-body-header-category {
    text-transform: uppercase;
    background-color: #EF5A31;
    color: #FFF;
    font-weight: bold;
    text-align: center;
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


    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <br>
    <br>
    <div class="card">

    <!-- En-tête de la carte -->
    <div class="card-header" style="background: url(images/slide2.jpg) no-repeat;
    background-size: 371px 235px;
    background-position: 0 0;">

        <!-- Le masque pour l'effet d'assombrissement lors du survol -->
        <div class="card-header-mask">
            <div class="card-header-date">
                <div class="card-header-date-day">12</div>
                <div class="card-header-date-month">May</div>
            </div>
        </div>

    </div>

    <!-- Corps de la carte -->
    <div class="card-body">

        <!-- En-tête du corps -->
        <div class="card-body-header">
            <div class="card-body-category">Photos</div>
            <h1>True Paradise on Earth: Unknown Place</h1>
            <p class="card-body-sentence">
                They call it <span>"</span>God's Own Country.<span>"</span>
            </p>
        </div>

        <!-- Description cachée par l'en-tête -->
        <p class="card-body-description">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Molestias autem aliquid, recusandae maiores iste fuga,
            explicabo dolor vitae magnam!
        </p>

        <!-- Pied de la carte -->
        <div class="card-body-footer">
            <i class="icon icon-time"></i> 6min. read
            <i class="icon icon-comment"></i> 39 comments
        </div>

    </div>

</div>


  </body>
</html>
