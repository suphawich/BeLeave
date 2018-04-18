@extends('layout.go')

@push('style')
    <link href="{{ asset('css/users.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/vue-clickaway@2.2.2/dist/vue-clickaway.min.js"></script>
@endpush

@section('title')
    Leave
@endsection

@section('script-data')

@endsection

@section('script-methods')

@endsection

@section('content')
    <div class="container-fluid body-content">
        <div class="row">
            {{-- {!! Form::open(['url' => '/takeleave']) !!} --}}
            {!! Form::open(['action' => 'ManageController@takeLeave', 'method' => 'PUT']) !!}
            <div class="col-12">
                <div class="form-group input-group">
                    <label>Leave type</label>
                    {!! Form::select('leave_type', ['Vacation' => 'Vacation leave', 'Personal Errand' => 'Personal errand leave', 'Sick' => 'Sick leave'], null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group input-group">
                    {{-- <input type="date" name="depart_at" class="form-control" value=""> --}}
                    <label>Depart date</label>
                    {{ Form::date('depart_at', \Carbon\Carbon::now(), ['class' => 'form-control']) }}
                </div>
                <div class="form-group input-group">
                    {{-- <input type="date" name="depart_at" class="form-control" value=""> --}}
                    <label>Arrive date</label>
                    {!! Form::date('arrive_at', null, ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit('Send', ['class' => 'btn btn-light']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
