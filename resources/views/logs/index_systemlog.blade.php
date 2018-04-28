@extends('layout.go')

@push('style')
    {{-- <link href="{{ asset('css/accounts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/users.css') }}" rel="stylesheet">

@endpush

@push('script')

@endpush

@section('title')
    System Logs
@endsection

@section('script-data')

@endsection

@section('script-methods')

@endsection

@section('script-query')

@endsection

@section('content')
    <div class="container-fluid body-content">
        {!! Form::open(['action' => 'LogsController@index_systemlog', 'method' => 'PUT']) !!}
        {!! Form::select(
            'date',
            $dates,
            $date,
            [
                'onchange' => 'this.form.submit()'
            ]
        ) !!}
        {!! Form::close() !!}
        <div class="row">
            <div class="col-12">
                <table class="table table-hover">
                    <thead class="table-text">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Action Type</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-text">
                        @foreach ($logs as $log)
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->action_type }}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ date_format(date_create($log->created_at),"m/d/Y H:i A") }}</td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-2 ml-auto mr-auto mt-5">
                {!! $logs->render() !!}
            </div>
        </div>
    </div>
@endsection
