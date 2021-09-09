@extends("layout.default")

@section("title",$employee ? "Edit Employee" : "Add Employee")

@section("content")
<div class="container mt-3">
	<div class="clearfix mt-4 mb-4">
		<div class="float-left mt-3">
			@if(isset($employee))
				<h1>Edit Employee</h1>
			@else
				<h1>Add Employee</h1>
			@endif
		</div>

		<div class="float-right">
			<button class="btn btn-primary mt-3"
				onclick="window.location='{{route('employee.index')}}'"> 
				Back
			</button>
		</div>
	</div>

	@if(isset($employee))
		<form action="{{route('employee.update',$employee->id)}}" method="post">
		@method("PUT")
	@else
		<form action="{{route('employee.store')}}" method="post">
	@endif
		@csrf
		<table class="table">
			<tr>
				<td>Name</td>
				<td>
					<input type="text" name="name" class="form-control" value="{{old('name',$employee ? $employee->name : '')}}">
				</td>
			</tr>

			<tr>
				<td>Location</td>
				<td> 
					<select name="location_code" class="form-control">
						@foreach($employeeCode as $itemEmployeeCode)

							<option value="{{$itemEmployeeCode->code}}" {{$employee ? ($employee->location_code == $itemEmployeeCode->code ? 'selected' : '') : ''}}>
								{{$itemEmployeeCode->name}}
							</option>
						@endforeach
					</selct>
				</td>
			</tr>

			<tr>
				<td>Birth Date</td>
				<td>
					<input type="date" class="form-control" name="birth_date" value="{{old('birth_date',$employee ? $employee->birth_date : '')}}">
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<button class="btn btn-primary">
						{{ $employee ? "Edit" : "Add" }}
					</button>
				</td>
			</tr>
		</table>
	</form>
</div>
@endSection