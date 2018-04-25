<?php
use App\Plan; ?>
@extends('layout.go')

@push('style')
    
@endpush
@section('title')
    subscription
@endsection

@section('content')
<div class="jumbotron">
  <h1 class="lead">Packgage 0 : 30 Baht/Account</h1>
  <p>Detail คุณสามารถซื้อ packgage ตามจำนวน account ที่คุณต้องการได้ โดยราคาจะอยู่ที่ 1 account = 30 บาท</p>
  จำนวน account ที่คุณต้องการ<input type="number" name="fname" value="0" min="0">
  <br>
  <br>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">BUY จำนวน account</a>
  </p>
</div>

<br>
<br>


<div class="jumbotron">
  <h1 class="lead">Packgage 1 : 1 Month</h1>
  <p>Detail ใช้งานได้ 30 วัน นับตั้งแต่วันที่ได้ทำการกดซื้อ</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">BUY PACKAGE 1 Month</a>
  </p>
</div>

<br>
<br>


<div class="jumbotron">
  <h1 class="lead">Packgage 2 : 6 Month</h1>
  <p>Detail ใช้งานได้ 180 วัน นับตั้งแต่วันที่ได้ทำการกดซื้อ</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">BUY PACKAGE 6 Month</a>
  </p>
</div>

<br>
<br>


<div class="jumbotron">
  <h1 class="lead">Packgage 2 : 1 Year</h1>
  <p>Detail ใช้งานได้ 365 วัน นับตั้งแต่วันที่ได้ทำการกดซื้อ</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">BUY PACKAGE 1 Year</a>
  </p>
</div>
@endsection