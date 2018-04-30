@extends('layout.go')
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




@section('content')
<br>

      <div class="row">



            <div class="col-3">

            </div>
            <div class="col-6 card ">

                              <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                                <ul class="navbar-nav">
                                  <li class="nav-item active">
                                    <a class="nav-link" style="font-size:30px" >Profile</a>
                                  </li>


                                </ul>
                              </nav>




                <div class="" style="text-align:center">

                  <img style="border-radius: 50%; width:200px; height:200px;;"src="{{ $user->avatar ?? '/images/profiles/user_default.jpg' }}" class="avatar circle mb-5 mt-4">
              </div>
              <div class="form-group input-group">
                  <label class="form-topic">Full Name</label>
                   <input type="text" class="form-control" name="full_name" pattern="[A-Za-z][A-Za-z ]+" placeholder="Full name*" required value="{{ $user->full_name }}" readonly="readonly">
              </div>
              <div class="form-group input-group">
                  <label class="form-topic">Company Name</label>
                  <input type="text" class="form-control" name="company_name" pattern="[A-Za-z][A-Za-z ]+" placeholder="Comoany name*" required value="{{ $user->company_name }}" disabled>
              </div>
              <div class="form-group input-group">
                  <label class="form-topic">Company E-mail</label>
                  <input type="email" class="form-control" name="company_email" placeholder="Company email*" required value="{{ $user->email }}" disabled>
              </div>
              <div class="form-group input-group">
                  <label class="form-topic">Address</label>
                  <input type="text" class="form-control" name="address" placeholder="Address" required value="{{ $user->address }}" disabled>
              </div>
              <div class="form-group input-group">
                  <label class="form-topic">Phone Number</label>
                  <input type="tel" class="form-control" name="tel" placeholder="Phone" pattern="[0-9][0-9+]+" required value="{{ $user->tel }}" disabled>
              </div>
              <div class="form-group input-group">
                  <label class="form-topic">Access Level</label>
                  <input type="text" class="form-control" name="access_level" disabled value="{{ Auth::user()->access_level }}">

              </div>





        <br>

      </div>






    </div>


















@endsection
