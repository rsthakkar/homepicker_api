
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
 		<div class="row" style="padding: 30px">
 			<div class="container-fluid" style="background-color: white; padding: 20px;">
 				<div class="col-md-12" style="margin-bottom: 15px">
 					<div class="col-md-3">
	 					Name:
	 				</div>
					<div class="col-md-3">
						{{$ads->org_name}}
					</div>
 				</div>
 				<div class="col-md-12" style="margin-bottom: 15px">
 					<div class="col-md-3">
	 					Description:
	 				</div>
					<div class="col-md-3">
						{{$ads->description}}
					</div>
 				</div>
 				<div class="col-md-12" style="margin-bottom: 15px">
 					<div class="col-md-3">
	 					City:
	 				</div>
					<div class="col-md-3">
						{{$ads->city}}
					</div>
 				</div>
 				<div class="col-md-12" style="margin-bottom: 15px">
 					<div class="col-md-3">
	 					Address:
	 				</div>
					<div class="col-md-3">
						{{$ads->address}}
					</div>
 				</div>
 				<div class="col-md-12" style="margin-bottom: 15px">
 					<div class="col-md-12">
	 					Images:
	 				</div>
					<div class="col-md-3">
						<img src="images/{{$ads->img_name1}}" style="max-height: 70px; max-width: 70px;">
					</div>
					<div class="col-md-3">
						<img src="images/{{$ads->img_name2}}" style="max-height: 70px; max-width: 70px;">
					</div>
					<div class="col-md-3">
						<img src="images/{{$ads->img_name3}}" style="max-height: 70px; max-width: 70px;">
					</div>
					<div class="col-md-3">
						<img src="images/{{$ads->img_name4}}" style="max-height: 70px; max-width: 70px;">
					</div>
 				</div>
 				<div class="col-md-12" style="margin-bottom: 15px">
 					<div class="col-md-3">
	 					Contact Number:
	 				</div>
					<div class="col-md-3">
						{{$ads->contact_no}}
					</div>
 				</div>
 				<div class="col-md-12" style="margin-bottom: 15px">
 					<div class="col-md-3">
	 					Fees:
	 				</div>
					<div class="col-md-3">
						{{$ads->fees}}
					</div>
 				</div>
 				<div class="col-md-12" style="margin-bottom: 15px">
 					<div class="col-md-3">
	 					Owner Name:
	 				</div>
					<div class="col-md-3">
						{{$ads->firstname}} {{$ads->lastname}}
					</div>
 				</div>
 				<div class="col-md-12" style="margin-bottom: 15px">
 					<div class="col-md-3">
	 					Payment status:
	 				</div>
					<div class="col-md-3">
						@if($ads->paymentStatus)
							Paid
						@else
							Not Paid
						@endif
					</div>
 				</div>
 			</div>
 		</div>
	</div>
	
	<!--//faq-->
		<!---->

	</div>
</div>
		<div class="clearfix"> </div>
       </div>
 @endsection

