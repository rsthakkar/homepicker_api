
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
		 	 	
	 	 	</form>
	 	</div>
	

		<div class="blank-page">
			<table class="table">
				<thead>
					<tr>
						<td>ID</td>
						<td>Firstname</td>
						<td>Lastname</td>
						<td>Gender</td>
						<td>DOB</td>
						<td>E-mail</td>
						<td>Address</td>
						<td>Category</td>
						<td>City</td>
						<td>Org Name</td>
					</tr>
				</thead>
				<tbody>
					@if($members->count()>0)
					@foreach($members as $member)
					<tr>
						<td>{{$member->id}}</td>
						<td>{{$member->firstname}}</td>
						<td>{{$member->lastname}}</td>
						<td>{{$member->gender}}</td>
						<td>{{$member->date_of_birth}}</td>
						<td>{{$member->email}}</td>
						<td>{{$member->address}}</td>
						<td>{{$member->category_id}}</td>
						<td>{{$member->city_id}}</td>
						<td>{{$member->org_name}}</td>
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

