
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
	 		<form action="add_rule">
		 	 	<table class="table">
		 	 		<tr>
		 	 			<td align="right">Add Rule:</td>
		 	 			<td><input type="text" placeholder="Rule" autocomplete="off" class="form-control" name="rule_description" required></td>
		 	 			
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
							<td>Rule</td>
							<td>Update Rule</td>
							<td>Update</td>
							<td>Delete</td>
						</tr>
					</thead>
					<tbody>
						@if($rules->count()>0)
							@foreach($rules as $rule)
							<tr>
								<td>{{$rule->id}}</td>
								<td>{{$rule->rule_description}}</td>
							
								<form action="update_rule">
								<td><input class="form-control" value="{{$rule->rule_description}}" required="" autocomplete="off" type="text" name="rule_description">
									<input type="hidden" value="{{$rule->id}}" name="id"></td>
								<td><button type="submit" class="btn btn-primary">Update</button></td>
								</form>
								<td><a class="btn btn-danger" href="delete_rule/{{$rule->id}}">Delete</a></td>
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

