


@extends('layout.go')


@push('style')
    <style media="screen">
        button {
         color       : red;
         height      : auto;
         line-height : 21px;
         text-align  : center;
         width       : auto;
         border      : 0px;
         padding-left:10px;
         padding-right:10px;
         min-width:100px;
        }
    </style>
@endpush
@push('script')
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
@endpush

@section('script-query')
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
@endsection

@section('content')
@if(Auth::user()->access_level == 'Manager' || Auth::user()->access_level == 'Supervisor' )
          <div class="row">
             <div class="mt-5">
               <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                 <ul class="navbar-nav">
                   <li class="nav-item active">
                     <a class="nav-link" style="font-size:30px" >Subordinate history</a>
                   </li>


                 </ul>
               </nav>





                    <br>
                    <table class="table" id="table">
                        <thead>
                            <tr>
                              <th>Number</th>
                              <th>Subordinate Name</th>
                              <th>Position</th>
                              <th>Description</th>
                              <th>Substitute Name</th>
                              <th>Leave Type</th>
                              <th>Depart Date</th>
                              <th>Arrive Date</th>
                              <th>Day</th>
                              <th>Enable</th>
                              <th>Approve</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($leaves as $item)

                        <tr class="item{{$item->id}}">

                          <td>{{ $loop->iteration }}</td>
                          <td><button class="form-control " style="height      : auto"><a href="{{ url('/users/' . $item->subordinate_id.'/profile') }}">{{ $item->full_name }}</td>
                            @foreach($tasks as $task)
                            @if( $task->subordinate_id == $item->subordinate_id )
                            <td>{{ $task->task }}</td>
                            @endif

                            @endforeach
                          <td>{{ $item->description }}</td>
                          @foreach($users as $user)
                          @if($user->id === $item->substitute_id)

                          <?php
                          $item->subordinate_id = $item->substitute_id;
                           $item->substitute_id = $user->full_name;
                           ?>


                          @endif

                          @endforeach



                          <td><button class="form-control "  style="height      : auto"><a href="{{ url('/users/' . $item->subordinate_id.'/profile') }}">{{ $item->substitute_id }}</a></button></td>
                          <td>{{ $item->leave_type }}</td>
                        <td>{{ date_format(date_create($item->depart_at),"m/d/Y") }}</td>
                        <td>{{ date_format(date_create($item->arrive_at),"m/d/Y") }}</td>
                              <td>{{date_diff(date_create($item->depart_at), date_create($item->arrive_at))->format(" %a ")}}</td>

                          <td>{!! $item->is_enabled ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}</td>
                          <td>{!! $item->is_approved ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}</td>


                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                  </div>


          </div>

@endif



@if (Auth::user()->access_level == 'Manager' || Auth::user()->access_level == 'Supervisor' )

    <a href="/getPDFHistory"><button style="float: right;" type="button" class="btn btn-default">Create PDF</button></a>

@endif
<br>

<div class="row col-12 " style="  width:100%">
   <div class="mt-5">
     <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
       <ul class="navbar-nav">
         <li class="nav-item active">
           <a class="nav-link" style="font-size:30px" >Your history</a>
         </li>


       </ul>
     </nav>





          <br>
          <table class="table" id="table">
              <thead>
                  <tr>
                    <th>Number</th>
                    <th>Subordinate Name</th>
                    <th>Position</th>
                    <th>Description</th>
                    <th>Substitute Name</th>
                    <th>Leave Type</th>
                    <th>Depart Date</th>
                    <th>Arrive Date</th>
                    <th>Day</th>
                    <th>Enable</th>
                    <th>Approve</th>

                  </tr>
              </thead>
              <tbody>
              @foreach($leaves_self as $item)

              <tr class="item{{$item->id}}">

                <td>{{ $loop->iteration }}</td>
                <td><button class="form-control " style="height      : auto"><a href="{{ url('/users/' . $item->subordinate_id.'/profile') }}">{{ $item->full_name }}</td>
                  @foreach($tasks as $task)
                  @if( $task->subordinate_id == $item->subordinate_id )
                  <td>{{ $task->task }}</td>
                  @endif

                  @endforeach
                <td>{{ $item->description }}</td>
                @foreach($users as $user)
                @if($user->id === $item->substitute_id)

                <?php
                $item->subordinate_id = $item->substitute_id;
                 $item->substitute_id = $user->full_name;
                 ?>


                @endif

                @endforeach



                <td><button class="form-control "  style="height      : auto"><a href="{{ url('/users/' . $item->subordinate_id.'/profile') }}">{{ $item->substitute_id }}</a></button></td>
                <td>{{ $item->leave_type }}</td>
                <td>{{ date_format(date_create($item->depart_at),"m/d/Y") }}</td>
                <td>{{ date_format(date_create($item->arrive_at),"m/d/Y") }}</td>
                <td>{{date_diff(date_create($item->depart_at), date_create($item->arrive_at))->format(" %a ")}}</td>

                <td>{!! $item->is_enabled ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}</td>
                <td>{!! $item->is_approved ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}</td>


              </tr>
              @endforeach
              </tbody>
          </table>
        </div>


</div>







@endsection
