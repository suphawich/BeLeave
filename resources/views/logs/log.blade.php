/<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
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
    <div class="container-fluid body-content">
        
        <div class="row">
            <div class="col-12">
                <table class="table table-hover">
                    <thead class="table-text">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Action Type</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-text">
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->full_name }}</td>
                                <td>{{ $log->action_type }}</td>
                                <td>{{ date_format(date_create($log->created_at),"m/d/Y H:i A") }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
  </body>
</html>
