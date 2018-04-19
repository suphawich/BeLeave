@extends('layout.go')

@push('style')
    <link href="{{ asset('css/users.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/vue-clickaway@2.2.2/dist/vue-clickaway.min.js"></script>
@endpush

@section('title')
    Request Leave
@endsection

@section('script-data')

@endsection

@section('script-methods')

@endsection

@section('content')
    <div class="container-fluid body-content">
        <div class="row">
            <div class="col-12">
                <table class="table table-hover">
                    <thead class="table-text">
                        <tr>
                            <th scope="col">Full Name</th>
                            <th scope="col">Message</th>
                            <th scope="col">Depart date</th>
                            <th scope="col">Arrive date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-text">
                        @foreach ($requests as $request)
                            @if ($request->is_enabled)
                                <tr>
                                    <td>{{ $request->full_name }}</td>
                                    <td>{{ $request->description }}</td>
                                    <td>{{ date_format(date_create($request->depart_at),"m/d/Y") }}</td>
                                    <td>{{ date_format(date_create($request->arrive_at),"m/d/Y").date_diff(date_create($request->depart_at), date_create($request->arrive_at))->format(" (%a days)") }}</td>
                                    <td>
                                        <a href="/manage/leave/accept/{{ $request->id }}" class="btn btn-light"><i class="fa fa-check"></i></a>
                                        <a href="/manage/leave/decline/{{ $request->id }}" class="btn btn-light"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-2 ml-auto mr-auto mt-5">
                {!! $requests->render() !!}
            </div>
        </div>
        {{-- @foreach ($settings as $setting)
            <div class="row">
                <div class="col-md-6 col-sm-8 col-12 pl-0 pr-0" >
                    <div class="card">
                        <div class="card-header">
                            <span>Request</span>
                        </div>
                        <div class="card-body">
                            <span>{{ $setting->full_name }}</span>
                            @if ($setting->is_r2sup)
                                <span> is request Supervisor.</span>
                                <a href="#" class="btn btn-light float-right"><i class="fa fa-times"></i></a>
                                <a href="/r2sup/accept/{{ $setting->account_id }}" class="btn btn-light float-right"><i class="fa fa-check"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach --}}
    </div>
@endsection
