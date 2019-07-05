
@extends('admin.admin_layout')
@section('content')
		 <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
 
 	<!--banner-->	
		    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul type="none">
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
		<!--//banner-->
 	 <!--faq-->
 	<div class="blank">
		<div>
	 		<form action="add_city">
		 	 	<table class="table">
		 	 		<tr>
		 	 			<td align="right">Add City:</td>
		 	 			<td><input type="text" autocomplete="off" class="form-control" name="city" required></td>
		 	 			<td>
		 	 				<select name="state_id" class="form-control">
		 	 					@foreach($states as $state)
		 	 					<option value="{{$state->id}}">{{$state->state_name}}</option>
		 	 					@endforeach
		 	 				</select>
		 	 			</td>
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
							<td>City</td>
							<td>State</td>
							<td>New Name</td>
							<td>Update</td>
							<td>Delete</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							@if($states->count()>0)
							@foreach($cities as $city)
							<tr>
								<td>{{$city->id}}</td>
								<td>{{$city->city}}</td>
								<form action="update_city">
								<td>
									<select class="form-control" name="state_id">
										@foreach($states as $state)
											<option value="{{$state->id}}" @if($state->id == $city->state_id)  selected="selected"  @endif>
												{{$state->state_name}}
											</option>
										@endforeach
									</select>
								</td>
									<td><input class="form-control" value="{{$city->city}}" required="" autocomplete="off" type="text" name="city">
										<input type="hidden" value="{{$city->id}}" name="id"></td>
									<td><button type="submit" class="btn btn-primary">Update</button></td>
								</form>
								<td><a class="btn btn-danger" href="delete_city/{{$city->id}}">Delete</a></td>
							</tr>
							@endforeach
							@else
							<tr>
								<td>No Data</td>
							</tr>
							@endif
						</tr>
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

