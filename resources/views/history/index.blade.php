@extends('layout.go')


@section('content')


<br>
<br>
<div >


  <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">




    <table class="table table-hover">
      <thead class="table-text">
      <tr>
        <td>ID</td>
        <td>Subordinate ID</td>
        <td>Description</td>
        <td>Substitute ID</td>
        <td>Leave Type</td>
        <td>Enable</td>
        <td>Approved</td>
      </tr>
    </thead>

      <tr>
        <?php foreach ($leaves as $leave): ?>
          <tr>
            <td>{{ $leave->id }}</td>
            <td>{{ $leave->subordinate_id }}</td>
            <td>{{ $leave->description }}</td>
            <td>{{ $leave->substitute_id }}</td>
            <td>{{ $leave->leave_type }}</td>
            <td>{{ $leave->is_enabled }}</td>
            <td>{{ $leave->is_approved }}</td>
          </tr>

        <?php endforeach; ?>
      </tr>
    </table>


    <div class="row">
        <div class="col-2 ml-auto mr-auto mt-5">
            {{ $leaves->appends(['sort' => request()->sort])->links() }}
        </div>
    </div>


</div>

<p>Boomin</p>


@endsection
