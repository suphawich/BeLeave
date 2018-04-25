@extends('layout.go')



@section('content')
<table class="table" id="table">
    <thead>
        <tr>
          <th>ID</th>
          <th>Subordinate ID</th>
          <th>Description</th>
          <th>Substitute ID</th>
          <th>Leave Type</th>
          <th>Enable</th>
          <th>Approve</th>

        </tr>
    </thead>
    <tbody>
    @foreach($leaves as $item)
    <tr class="item{{$item->id}}">
      <td>{{ $item->id }}</td>
      <td>{{ $item->subordinate_id }}</td>
      <td>{{ $item->description }}</td>
      <td>{{ $item->substitute_id }}</td>
      <td>{{ $item->leave_type }}</td>
      <td>{{ $item->is_enabled }}</td>
      <td>{{ $item->is_approved }}</td>

    </tr>
    @endforeach
    </tbody>
</table>




@endsection
