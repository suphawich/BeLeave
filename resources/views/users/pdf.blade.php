<!DOCTYPE html>
<html>
<head>
    <title>UsersPDF</title>
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
<h2 style="text-align: center;">Users</h2>
        <div class="row">
            <div class="col-12 table-responsive">
                <form action="users" method="post" >
                @csrf
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
                        @foreach ($subordinates as $subordinate)
                            <tr>
                                <td>{{ $subordinate->full_name }}</td>
                                <td v-if="!isShowNewUser">{{ $subordinate->supervisor_name ?? '-' }}</td>
                                <td>{{ $subordinate->task ?? '-' }}</td>
                                <td>{{ $subordinate->email }}</td>
                                <td>{{ $subordinate->tel }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </form>
            </div>
        </div>
</body>
</html>