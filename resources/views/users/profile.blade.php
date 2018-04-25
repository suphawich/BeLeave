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
<style type="text/css">

@endpush


@section('content')
<br>
      <div class="row">



            <div class="col-2">

            </div>
            <div class="col-8">
            <img src="{{ $user->avatar }}" class="avatar circle mb-5 mt-4">

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



            <div class="modal-footer">

              <a href="/users/{{ $user->id }}/edit"><button  class="btn btn-default">Edit</button></a>
              <button class="btn btn-default">Contact</button>
          </div>
      </div>








@endsection
