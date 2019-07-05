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
	 		<form action="add_category">
		 	 	<table class="table">
		 	 		<tr>
		 	 			<td align="right">Add Category:</td>
		 	 			<td><input type="text" autocomplete="off" class="form-control" name="cat_name" required></td>
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
							<td>Category</td>
							<td>New Name</td>
							<td>Update</td>
							<td>Delete</td>
						</tr>
					</thead>
					<tbody>
						@if($cats->count()>0)
						@foreach($cats as $cat)
							<tr>
								<td>{{$cat->id}}</td>
								<td>{{$cat->cat_name}}</td>
								<form action="update_category">
								<td><input class="form-control" value="{{$cat->cat_name}}" required="" autocomplete="off" type="text" name="cat_name">
									<input type="hidden" value="{{$cat->id}}" name="id"></td>
								<td><button type="submit" class="btn btn-primary">Update</button></td>
								</form>
								<td><a class="btn btn-danger" href="delete_category/{{$cat->id}}">Delete</a></td>
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