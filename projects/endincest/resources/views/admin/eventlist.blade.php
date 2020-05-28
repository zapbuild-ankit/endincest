@extends('layouts.admin')
@section('content')

	<div class='container' style='margin-top:50px;'>


		<div class="col-md-3"></div>
		<div class='col-md-12'>

				<a href='eventform' class='btn btn-info btn-sm' >Create Event</a>

@if($message = Session::get('success'))
<div class='alert alert-success'>
	<p>{{$message}}</p>
</div>
@endif
<table class='table table-hover table-white'>

  <tr>
    <th>Sr No</th>
    <th>Name</th>
    <th>Description</th>
    <th>Location</th>
    <th>Speaker</th>
    <th>Begining</th>
    <th>Ending</th>
    <th>Image</th>
    <th>Status</th>
	<th>Actions</th>

  </tr>
  @if(!empty($events))
<?php $i = 1;?>
@endif
    <tbody>
         @foreach($events as $event)
          <tr>
              <td> {{$i}} </td>
              <td> {{$event->name}} </td>
              <td> {{$event->description}} </td>
              <td> {{$event->location}} </td>
              <td> {{$event->speaker}} </td>
              <td> {{$event->start_date}} </td>
              <td> {{$event->end_date}} </td>
              <td><img src="{{ asset('/dist/img/' . $event->image)}}" style='width:50px;float: left;' class="img-circle elevation-2" alt="Event Image"></td>

              <td> {{$event->status}} </td>
              <td>

              		<a class='btn btn-sm btn-success' href="{{route('editevent',$event->id)}}"><i class="fas fa-pen-square"></i></a>

              		<form class='form-group pull-right'  action="{{route('destroyevent',$event->id)}}" method="POST">

              			@method('DELETE')
              			@csrf

              			<button type='submit'  name='submit' class='btn btn-sm btn-info'><i class="fas fa-trash"></i></button>

              	</form>
              </td>

          </tr>
<?php $i++;?>
         @endforeach
   </tbody>
</table>
{!! $events->links() !!}
</div>
</div>
</div>
</div>


@endsection