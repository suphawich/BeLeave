@extends('layout.go')

@push('style')
    {{-- <link href="{{ asset('css/users.css') }}" rel="stylesheet"> --}}
@endpush

@push('script')
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue-clickaway@2.2.2/dist/vue-clickaway.min.js"></script> --}}
@endpush

@section('title')
    Graph
@endsection

@section('script-data')

@endsection

@section('script-methods')

@endsection

@section('content')
    <div class="container-fluid body-content">
        {!! Form::open(['action' => 'AnalyticController@index_admin', 'method' => 'PUT']) !!}
        {!! Form::select(
            'year',
            $years,
            $year,
            [
                'onchange' => 'this.form.submit()'
            ]
        ) !!}
        {!! Form::close() !!}
        <div id="ncu"></div>
        @areachart('number_of_created_users-'.$year, 'ncu')

        {{-- <div id="leaveleast"></div>
        @barchart('LeaveLeast-'.$year, 'leaveleast')

        <div id="leavecount"></div>
        @piechart('LeaveCount-'.$year, 'leavecount') --}}
    </div>
@endsection
