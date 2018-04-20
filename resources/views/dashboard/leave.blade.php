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
        @if (session()->has('leave_status'))
            <div class="row">
                <div class="col-12 alert alert-danger text-center">
                    {{ session()->get('leave_status') }}
                </div>
            </div>
        @else
            <div class="row" style="min-height: 60px;"></div>
        @endif

        <div class="row">
            <div class="col-12 pl-0 pr-0 mt-2">
                <button type="button" class="btn btn-light float-right mb-2" data-toggle="modal" data-target="#modalLeaveForm">
                    <i class="fa fa-plus"></i> New Leave letter
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-hover">
                    <thead class="table-text">
                        <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Depart date</th>
                            <th scope="col">Arrive date</th>
                            <th scope="col">Substitute name</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-text">
                        @foreach ($leaves as $leave)
                            <tr>
                                <td>{{ $leave->leave_type }}</td>
                                <td >{{ date_format(date_create($leave->depart_at),"m/d/Y") }}</td>
                                <td>{{ date_format(date_create($leave->arrive_at),"m/d/Y").date_diff(date_create($leave->depart_at), date_create($leave->arrive_at))->format(" (%a days)") }}</td>
                                <td>{{ $leave->substitute_id ?? '-' }}</td>
                                @if ($leave->is_approved)
                                    <td>Approved</td>
                                @else
                                    @if ($leave->is_enabled)
                                        <td>Pending</td>
                                    @else
                                        <td>Decline</td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
