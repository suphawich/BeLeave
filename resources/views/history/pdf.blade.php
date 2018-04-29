<!DOCTYPE html>
<html>
<head>
<title>HistoryPDF</title>
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
<h2 style="text-align: center;">History</h2>
<table class="table" id="table">
    <thead>
        <tr>
          <th>Number</th>
          <th>Subordinate Name</th>
          <th>Description</th>
          <th>Substitute Name</th>
          <th>Leave Type</th>
          
          

        </tr>
    </thead>
    <tbody>
    @foreach($leaves as $item)

    <tr class="item{{$item->id}}">

      <td>{{ $loop->iteration }}</td>
      <td>{{ $item->full_name }}</td>
      <td>{{ $item->description }}</td>
      @foreach($users as $user)
      @if($user->id === $item->substitute_id)

      <?php
      $item->subordinate_id = $item->substitute_id;
       $item->substitute_id = $user->full_name;
       ?>

      @endif

      @endforeach

      <td>{{ $item->substitute_id }}</td>
      <td>{{ $item->leave_type }}</td>
      


    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>