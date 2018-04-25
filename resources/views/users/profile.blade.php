@extends('layout.go')




@section('content')
      <div class="row">


            <div class="col-3">

            </div>
            <div class="col-9">

              <div class="form-group input-group">
                  <label class="form-topic">Full Name</label>
                  <input type="text" class="form-control form-field" name="full_name" pattern="[A-Za-z][A-Za-z ]+" placeholder="Full name*" required value="{{ $user->full_name }}">
              </div>
              <div class="form-group input-group">
                  <label class="form-topic">Company Name</label>
                  <input type="text" class="form-control form-field" name="company_name" pattern="[A-Za-z][A-Za-z ]+" placeholder="Comoany name*" required value="{{ $user->company_name }}">
              </div>
              <div class="form-group input-group">
                  <label class="form-topic">Company E-mail</label>
                  <input type="email" class="form-control form-field" name="company_email" placeholder="Company email*" required value="{{ $user->email }}">
              </div>
              <div class="form-group input-group">
                  <label class="form-topic">Address</label>
                  <input type="text" class="form-control form-field" name="address" placeholder="Address" required value="{{ $user->address }}">
              </div>
              <div class="form-group input-group">
                  <label class="form-topic">Phone Number</label>
                  <input type="tel" class="form-control form-field" name="tel" placeholder="Phone" pattern="[0-9][0-9+]+" required value="{{ $user->tel }}">
              </div>
              <div class="form-group input-group">
                  <label class="form-topic">Access Level</label>
                  <input type="text" class="form-control form-field" name="access_level" disabled value="{{ Auth::user()->access_level }}">
              </div>
          </div>
      </div>

  \

@endsection
