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
    isFocusAutocomplete: false,
    isOverAutocomplete: false,
@endsection

@section('script-methods')
    live_search: function () {
        if (this.searchText != '') {
            axios.post('/leave/search', {
                {{-- params: { --}}
                  keyword: this.searchText
                {{-- } --}}
              }).then(response => this.result = response.data);
            this.isShowAutocomplete = true;
        } else {
            this.isShowAutocomplete = false;
            this.result = [];
        }
    },
    setSubstitute: function(full_name) {
        this.searchText = full_name;
        this.isOverAutocomplete = false;
    },
    focusAutocomplete: function () {
        this.isFocusAutocomplete = true;
    },
    nofocusAutocomplete: function () {
        if (!this.isOverAutocomplete) {
            this.isFocusAutocomplete = false;
        }
    },
    overAutocomplete: function () {
        this.isOverAutocomplete = true;
    },
    outAutocomplete: function () {
        this.isOverAutocomplete = false;
    },
@endsection

@section('script-mounted')
    $(this.$refs.modalLeaveForm).on('hidden.bs.modal', () => {
        this.$refs.search.value = null
        this.$refs.arrive_at.value = null
        this.$refs.description.value = null
        this.$refs.leave_type.value = "Vacation"

        this.isShowAutocomplete = false;
        this.isFocusAutocomplete = false;
        this.isOverAutocomplete = false;
    })
@endsection

@section('content')
    <div class="container-fluid body-content">
        <div class="modal fade" id="modalLeaveForm" ref="modalLeaveForm">
            <div class="modal-dialog modal-lg">
                {!! Form::open(['action' => 'ManageController@takeLeave', 'method' => 'PUT']) !!}
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title ml-auto mr-auto">Create New Leave letter</h4>
                    <button type="button" class="btn btn-light float-right" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                      <div class="col-12">
                          <div class="form-group input-group">
                              <label class="input-title">Leave type</label>
                              {!! Form::select('leave_type', ['Vacation' => 'Vacation leave', 'Personal Errand' => 'Personal errand leave', 'Sick' => 'Sick leave'], null,
                                  ['class' => 'form-control leave_type', 'ref' => 'leave_type']) !!}
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
                              {!! Form::date('arrive_at', null, [
                                  'class' => 'form-control date',
                                  'ref' => 'arrive_at',
                                  'required'
                                  ])
                              !!}
                          </div>
                          <hr>
                          <div class="form-group input-group">
                              {{-- <input type="date" name="depart_at" class="form-control" value=""> --}}
                              <label class="input-title">Description</label>
                              {!! Form::textarea('description', null, [
                                  'class' => 'form-control description',
                                  'ref' => 'description',
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
                                      'v-on:focus' => 'focusAutocomplete',
                                      'v-on:focusout' => 'nofocusAutocomplete',
                                      'autocomplete' => 'off',
                                      'ref' => 'search',
                                      'required'
                                  ])!!}
                              </div>
                              <div class="autocomplete" v-if="result.length > 0 && isFocusAutocomplete" v-on:focusout="nofocusAutocomplete">
                                  <a href="#" class="sidebar-item autocomplete-item autocomplete-item-hover-default" v-for="account in result" v-on:click="setSubstitute(account.full_name)" @mouseover="overAutocomplete" @mouseout="outAutocomplete">@{{ account.full_name }}, @{{ account.task }}</a>
                              </div>
                          </div>
                          <div class="form-group input-group">
                          </div>
                          {{-- @{{ isFocusAutocomplete }} --}}
                      </div>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                      {!! Form::submit('Send', ['class' => 'btn btn-light']) !!}
                      <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="row">
            <div class="col-12 pl-0 pr-0 mt-2">
                <button type="button" class="btn btn-light float-right mb-2" data-toggle="modal" data-target="#modalLeaveForm">
                    <i class="fa fa-plus"></i> New Leave letter
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 table-responsive">
                <form action="/user-create" method="post" >
                @csrf
                <input type="hidden" name="supervisor_id" value="{{ session()->get('id') }}">
                <input type="hidden" name="company_name" value="{{ session()->get('company_name') }}">
                <table class="table table-hover">
                    <thead class="table-text">
                        <tr>
                            <th scope="col">Full name</th>
                            <th scope="col" v-if="!isShowNewUser">Supervisor name</th>
                            <th scope="col">Task</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Phone number</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-text">

                    </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>
@endsection
