@extends('layout.go')

@push('style')
    <link href="{{ asset('css/leave.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/vue-clickaway@2.2.2/dist/vue-clickaway.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@endpush

@section('title')
    Leave
@endsection

@section('script-data')
    searchText: '',
    result: [],
    isShowAutocomplete: false,
@endsection

@section('script-methods')
    live_search: function () {
        if (this.searchText != '') {
            axios.get('/leave/search', {
                params: {
                  keyword: this.searchText
                }
              }).then(response => this.result = response.data);
            this.isShowAutocomplete = true;
        } else {
            this.isShowAutocomplete = false;
            this.result = [];
        }
    },
    assign: function(response) {
        console.log(response.data);
    }
@endsection

@section('content')
    <div class="container-fluid body-content">
        <div class="modal fade" id="modalLeaveForm">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title ml-auto mr-auto">Create New Leave letter</h4>
                    <button type="button" class="btn btn-light float-right" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                      {!! Form::open(['action' => 'ManageController@takeLeave', 'method' => 'PUT']) !!}
                      <div class="col-12">
                          <div class="form-group input-group">
                              <label class="input-title">Leave type</label>
                              {!! Form::select('leave_type', ['Vacation' => 'Vacation leave', 'Personal Errand' => 'Personal errand leave', 'Sick' => 'Sick leave'], null, ['class' => 'form-control leave_type']) !!}
                          </div>
                          {{-- <div class="center-block"><div class="connect-dashed login-dashed-margin-top"></div></div> --}}
                          <hr>
                          <div class="form-group input-group">
                              {{-- <input type="date" name="depart_at" class="form-control" value=""> --}}
                              <label class="input-title">Depart date</label>
                              {{ Form::date('depart_at', \Carbon\Carbon::now(), ['class' => 'form-control date', 'required']) }}
                          </div>
                          <hr>
                          <div class="form-group input-group">
                              {{-- <input type="date" name="depart_at" class="form-control" value=""> --}}
                              <label class="input-title">Arrive date</label>
                              {!! Form::date('arrive_at', null, ['class' => 'form-control date', 'required']) !!}
                          </div>
                          <hr>
                          <div class="form-group input-group">
                              {{-- <input type="date" name="depart_at" class="form-control" value=""> --}}
                              <label class="input-title">Description</label>
                              {!! Form::textarea('description', null, [
                                  'class' => 'form-control description',
                                  'required'
                              ])!!}
                          </div>
                          <hr>
                          <div class="" style="display:inline-block; position:relative;">
                              {{-- <input type="date" name="depart_at" class="form-control" value=""> --}}
                              <div class="form-group input-group">
                                  <label class="input-title">Substitute</label>
                                  {!! Form::text('search', null, [
                                      'class' => 'form-control substitute',
                                      'v-model' => 'searchText',
                                      'v-on:keyup' => 'live_search',
                                      'required'
                                  ])!!}
                              </div>
                              <div class="autocomplete" v-if="result.length > 0" >
                                  <a href="#" class="sidebar-item autocomplete-item autocomplete-item-hover-default" v-for="account in result" style="font-size: 10px; color: black;">@{{ account.full_name }}</a>
                              </div>
                          </div>
                          <div class="form-group input-group">
                          </div>
                          {{-- @{{ result }} --}}
                          {!! Form::submit('Send', ['class' => 'btn btn-light']) !!}
                      </div>
                      {!! Form::close() !!}
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>

                </div>
            </div>
        </div>
        <div class="row">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalLeaveForm">
                Open modal
            </button>
        </div>
        <div class="row">
            {{-- {!! Form::open(['url' => '/takeleave', 'method' => 'PUT']) !!} --}}
            {!! Form::open(['action' => 'ManageController@takeLeave', 'method' => 'PUT']) !!}
            <div class="col-12">
                <div class="form-group input-group">
                    <label>Leave type</label>
                    {!! Form::select('leave_type', ['Vacation' => 'Vacation leave', 'Personal Errand' => 'Personal errand leave', 'Sick' => 'Sick leave'], null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group input-group">
                    {{-- <input type="date" name="depart_at" class="form-control" value=""> --}}
                    <label>Depart date</label>
                    {{ Form::date('depart_at', \Carbon\Carbon::now(), ['class' => 'form-control', 'required']) }}
                </div>
                <div class="form-group input-group">
                    {{-- <input type="date" name="depart_at" class="form-control" value=""> --}}
                    <label>Arrive date</label>
                    {!! Form::date('arrive_at', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group input-group">
                    {{-- <input type="date" name="depart_at" class="form-control" value=""> --}}
                    <label>Description</label>
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'required']) !!}
                </div>
                {!! Form::submit('Send', ['class' => 'btn btn-light']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
