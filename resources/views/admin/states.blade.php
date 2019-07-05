
@extends('admin.admin_layout')
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
 
 	<!--banner-->	
		    
		<!--//banner-->
		@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul type="none">
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
 	 <!--faq-->
 	 
 	<div class="blank">
	 	<div>
	 		<form action="add_state">
		 	 	<table class="table">
		 	 		<tr>
		 	 			<td align="right">Add State:</td>
		 	 			<td><input type="text" autocomplete="off" class="form-control" name="state_name" required></td>
		 	 			<td><button type="submit" class="btn btn-primary">Add</button></td>
		 	 		</tr>
		 	 	</table>
	 	 	</form>
	 	</div>
	

		<div class="blank-page">
			<table class="table">
				<thead>
					<tr>
						<td>ID</td>
						<td>State</td>
						<td>StateID</td>
						<td>New Name</td>
						<td>Update</td>
						<td>Delete</td>
					</tr>
				</thead>
				<tbody>
					@if($states->count()>0)
					@foreach($states as $state)
					<tr>
						<td>{{$state->id}}</td>
						<td>{{$state->state_name}}</td>
						<td>{{$state->id}}</td>
						<form action="update_state">
						<td><input class="form-control" value="{{$state->state_name}}" required="" autocomplete="off" type="text" name="state_name">
							<input type="hidden" value="{{$state->id}}" name="id"></td>
						<td><button type="submit" class="btn btn-primary">Update</button></td>
						</form>
						<td><a class="btn btn-danger" href="delete_state/{{$state->id}}">Delete</a></td>
					</tr>
					@endforeach
					@else
					<tr>
						<td>No Data</td>
					</tr>
					@endif
				</tbody>
			</table>
	    </div>
	</div>
	
	<!--//faq-->
		<!---->

	</div>
</div>
		<div class="clearfix"> </div>
       </div>
 @endsection

