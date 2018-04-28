<html>
    <head>
        <body>
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
    </head>
</html>