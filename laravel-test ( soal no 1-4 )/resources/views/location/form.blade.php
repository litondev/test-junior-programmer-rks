@extends("layout.default")

@section("title",$location ? "Edit Location" : "Add Location")

@section("content")
<div class="container mt-3">
	<div class="clearfix mt-4 mb-4">
		<div class="float-left mt-3">
			@if(isset($location))
				<h1>Edit Locaiton</h1>
			@else
				<h1>Add Location</h1>
			@endif
		</div>

		<div class="float-right">
			<button class="btn btn-primary mt-3"
				onclick="window.location='{{route('location.index')}}'"> 
				Back
			</button>
		</div>
	</div>

	@if(isset($location))
		<form action="{{route('location.update',$location->id)}}" method="post">
		@method("PUT")
	@else
		<form action="{{route('location.store')}}" method="post">
	@endif
		@csrf
		<table class="table">
			<tr>
				<td>Code</td>
				<td> 
					<input type="text" name="code" class="form-control" value="{{old('code',$location ? $location->code : '')}}">
				</td>
			</tr>
			<tr>
				<td>Name</td>
				<td>
					<input type="text" name="name" class="form-control" value="{{old('name',$location ? $location->name : '')}}">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<button class="btn btn-primary">
						{{ $location ? "Edit" : "Add" }}
					</button>
				</td>
			</tr>
		</table>
	</form>
</div>
@endSection