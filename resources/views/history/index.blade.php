@extends('layout.go')


@push('script')
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">



<script>
$(document).ready(function() {
$('#table').DataTable();
} );



$(document).on('click', '.edit-modal', function() {
    $('#footer_action_button').text(" Update");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('delete');
    $('.actionBtn').addClass('edit');
    $('.modal-title').text('Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    var stuff = $(this).data('info').split(',');
    fillmodalData(stuff)
    $('#myModal').modal('show');
});
</script>


@endpush



@section('content')

<br>
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
      <td>{{ $item->full_name }}</td>
      <td>{{ $item->description }}</td>
      <td>{{ $item->substitute_id }}</td>
      <td>{{ $item->leave_type }}</td>
      <td>{!! $item->is_enabled ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}</td>
      <td>{!! $item->is_approved ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}</td>


    </tr>
    @endforeach
    </tbody>
</table>


{{ Auth::user()->id }}




@endsection
