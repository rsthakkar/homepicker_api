
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
	 		<form action="add_area">
		 	 	<table class="table">
		 	 		<tr>
		 	 			<td align="right">Add Area:</td>
		 	 			<td><input type="text" placeholder="Name" autocomplete="off" class="form-control" name="area" required></td>
		 	 			<td><input type="number" placeholder="Pincode" autocomplete="off" class="form-control" name="pincode" required></td>
		 	 			<td>
		 	 				<select name="city_id" class="form-control">
		 	 					@foreach($cities as $city)
		 	 					<option value="{{$city->id}}">{{$city->city}}</option>
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
							<td>Area</td>
							<td>City</td>
							<td>State</td>
							<td>Pincode</td>
							<td>New Name</td>
							<td>Update</td>
							<td>Delete</td>
						</tr>
					</thead>
					<tbody>
						@if($areas->count()>0)
							@foreach($areas as $area)
							<tr>
								<td>{{$area->id}}</td>
								<td>{{$area->area}}</td>
								<form action="update_area">
									<td>
										<select class="form-control" name="city_id">
											@foreach($cities as $city)
												<option value="{{$city->id}}" @if($city->id == $area->city_id)  selected="selected"  @endif>
													{{$city->city}}
												</option>
											@endforeach
										</select>
									</td>
									<td>{{$area->state_name}}</td>
									<td><input class="form-control" value="{{$area->pincode}}" required="" autocomplete="off" type="text" name="pincode"></td>
									<td><input class="form-control" value="{{$area->area}}" required="" autocomplete="off" type="text" name="area">
										<input type="hidden" value="{{$area->id}}" name="id"></td>
									<td><button type="submit" class="btn btn-primary">Update</button></td>
								</form>
								<td><a class="btn btn-danger" href="delete_area/{{$area->id}}">Delete</a></td>
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

