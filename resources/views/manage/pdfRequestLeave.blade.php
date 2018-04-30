<!DOCTYPE html>
<html>
<head>
    <title>Request-LeavePDF</title>
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

.

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
<h2 style="text-align: center;">Request-Leave</h2>
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
                            
                        </tr>
                    </thead>
                    <tbody class="tbody-text">
                        @foreach ($requests as $request)
                            @if ($request->is_enabled)
                                <tr data-toggle="collapse" data-target="#demo">
                                    <a href="/manage/request/{{ $request->subordinate_id }}/history"></a>
                                    <td>{{ $request->full_name }}</td>
                                    <td>{{ $request->description }}</td>
                                    <td>{{ date_format(date_create($request->depart_at),"m/d/Y") }}</td>
                                    <td>{{ date_format(date_create($request->arrive_at),"m/d/Y") }}</td>
                                    
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>