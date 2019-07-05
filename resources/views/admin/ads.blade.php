
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
	 	<div style="display: none;">
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
						<td>Org name</td>
						<td>Address</td>
						<td>Start Date</td>
						<td>End Date</td>
						<td>Contact No.</td>
						<td>Fees</td>
						<td>Payment</td>
						<td>Image1</td>
						<td>Image2</td>
						<td>Image3</td>
						<td>Image4</td>
					</tr>
				</thead>
				<tbody>
					@if($ads->count()>0)
					@foreach($ads as $ad)
					<tr>
						<td>{{$ad->id}}</td>
						<td>
							<a href="ad{{$ad->id}}">{{$ad->org_name}}</a>
						</td>
						<td>{{$ad->address}}</td>
						<td>{{$ad->start_date}}</td>
						<td>{{$ad->end_date}}</td>
						<td>{{$ad->contact_no}}</td>
						<td>{{$ad->fees}}</td>
						<td>{{$ad->paymentStatus}}</td>
						<td>
							@if(isset($ad->img_name1))
							<a target="__blank" href="/images/{{$ad->img_name1}}">
								<img style="max-width: 50px" src="/images/{{$ad->img_name1}}"/>
							</a>
							@else
							No Image
							@endif
						</td>
						<td>
							@if(isset($ad->img_name2))
							<a target="__blank" href="/images/{{$ad->img_name2}}">
								<img style="max-width: 50px" src="/images/{{$ad->img_name2}}"/>
							</a>
							@else
							No Image
							@endif
						</td>
						<td>
							@if(isset($ad->img_name3))
							<a target="__blank" href="/images/{{$ad->img_name3}}">
								<img style="max-width: 50px" src="/images/{{$ad->img_name3}}"/>
							</a>
							@else
							No Image
							@endif
						</td>
						<td>
							@if(isset($ad->img_name4))
							<a target="__blank" href="/images/{{$ad->img_name4}}">
								<img style="max-width: 50px" src="/images/{{$ad->img_name4}}"/>
							</a>
							@else
							No Image
							@endif
						</td>
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

