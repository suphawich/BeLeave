
<!DOCTYPE html>
<html>
<head>
    <title>RequestPDF</title>
<style>
.table {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

.table td, .table th {
    border: 1px solid #000000;
    padding: 8px;
}

.table tr:nth-child(even){background-color: LemonChiffon ;}



.table th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: LightSeaGreen ;
    color: white;
}
</style>
</head>
<body>
<h1 style="text-align: center;">BeLeave!</h1>
<h2 style="text-align: center;">Request</h2>
        <div class="container-fluid body-content">
        <div class="row">
            <div class="col-12">
                <table class="table table-hover">
                    <thead class="table-text">
                        <tr>
                            <th scope="col">Request message</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-text">
                        @foreach ($settings as $setting)
                            <tr>
                                @if ($setting->is_r2sup)
                                    <td>{{ $setting->full_name }}<span> is request Supervisor.</span></td>
                                @endif
                                <td>
                                    <a href="/r2sup/accept/{{ $setting->user_id }}" class="btn btn-light"><i class="fa fa-check"></i></a>
                                    <a href="/r2sup/decline/{{ $setting->user_id }}" class="btn btn-light"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-2 ml-auto mr-auto mt-5">
                {!! $settings->render() !!}
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
</body>
</html>