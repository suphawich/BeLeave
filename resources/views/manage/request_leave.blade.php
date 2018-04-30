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
                    @if (count($requests) == 0)
                        <td colspan="5" class="text-center pt-5 pb-5">No found request.</td>
                    @else
                        @foreach ($requests as $request)
                            @if ($request->is_enabled)
                                <tr data-toggle="collapse" data-target="#demo">
                                    <a href="/manage/request/{{ $request->subordinate_id }}/history"></a>
                                    <td><a href="/manage/request/{{ $request->subordinate_id }}/history">{{ $request->full_name }}</a></td>
                                    <td>{{ $request->description }}</td>
                                    <td>{{ date_format(date_create($request->depart_at),"m/d/Y") }}</td>
                                    <td>{{ date_format(date_create($request->arrive_at),"m/d/Y").date_diff(date_create($request->depart_at), date_create($request->arrive_at))->format(" (%a days)") }}</td>
                                    <td>
                                        <a href="/manage/request/leave/{{ $request->id }}/accept" class="btn btn-light"><i class="fa fa-check"></i></a>
                                        <a href="/manage/request/leave/{{ $request->id }}/decline" class="btn btn-light"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                <tr id="demo" class="collapse">
                                    <td colspan="5">
                                        <div class="container">
                                            <span>Full name: {{ $users[$request->subordinate_id]->full_name }}</span>
                                            <br>
                                            <span>
                                                Leave:
                                                {{ $users[$request->subordinate_id]->leave_count
                                                    .' (in '.\Carbon\Carbon::now()->year
                                                    .')'
                                                }}
                                            </span>
                                            <ul>
                                                <li>Vacation: {{ $users[$request->subordinate_id]->leave_vacation_count }}</li>
                                                <li>Personal Errand: {{ $users[$request->subordinate_id]->leave_personal_errand_count }}</li>
                                                <li>Sick: {{ $users[$request->subordinate_id]->leave_sick_count }}</li>
                                            </ul>
                                            <span>Latest Leave from: {{ date_format(date_create($users[$request->subordinate_id]->leave_latest_depart),"m/d/Y") }}</span>
                                            <br>
                                            <span>Latest Leave to: {{ date_format(date_create($users[$request->subordinate_id]->leave_latest_arrive),"m/d/Y").date_diff(date_create($users[$request->subordinate_id]->leave_latest_depart), date_create($users[$request->subordinate_id]->leave_latest_arrive))->format(" (%a days)") }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
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
        @forelse($requests as $request)
        @if ($request->is_enabled)
        <a href="/getPDFRequestLeave"><button style="float: right;" type="button" class="btn btn-info">Create PDF</button></a>
        @endif
        @empty
            
        @endforelse

    </div>
@endsection
