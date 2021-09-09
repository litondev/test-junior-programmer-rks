@extends("layout.default")

@section("title","Employee")

@section("content")
<div class="container mt-3">
	<div class="clearfix mt-4 mb-4">
		<div class="float-left mt-3">
			<h1>Employee</h1>
		</div>

		<div class="float-right">
			<button class="btn btn-success mt-3"
				onclick="onSearch()">
				Search
			</button>
			<button class="btn btn-primary mt-3"
				onclick="window.location='{{route('employee.create')}}'"> 
				Add Employee
			</button>
		</div>
	</div>

	<table class="table">
		<tr>
			<td>
				<div class="clearfix">
					<div class="float-left">
						Name
					</div>
					<div class="float-right">									
						<i class="fa fa-arrow-up" title="Desc" style="{{(request()->order_by == 'name' && request()->order == 'desc') ? 'cursor:pointer' : 'color:lightgray;cursor:pointer'}}"
							onclick="window.location='?order_by=name&order=desc'"></i>						

						<i class="fa fa-arrow-down" title="Asc" style="{{(request()->order_by == 'name' && request()->order == 'asc') ? 'cursor:pointer'  : 'color:lightgray;cursor:pointer'}}"
							onclick="window.location='?order_by=name&order=asc'"></i>		
					</div>
				</div>
			</td>
			<td>
				<div class="clearfix">
					<div class="float-left">
						Location
					</div>
					<div class="float-right">			
							<i class="fa fa-arrow-up" title="Desc" style="{{(request()->order_by == 'location_code' && request()->order == 'desc') ? 'cursor:pointer' : 'color:lightgray;cursor:pointer'}}"
							onclick="window.location='?order_by=location_code&order=desc'"></i>						

						<i class="fa fa-arrow-down" title="Asc" style="{{(request()->order_by == 'location_code' && request()->order == 'asc') ? 'cursor:pointer'  : 'color:lightgray;cursor:pointer'}}"
							onclick="window.location='?order_by=location_code&order=asc'"></i>			
					</div>
				</div>
			</td>
			<td>
				<div class="clearfix">
					<div class="float-left">
						Birth Date
					</div>
					<div class="float-right">			
							<i class="fa fa-arrow-up" title="Desc" style="{{(request()->order_by == 'birth_date' && request()->order == 'desc') ? 'cursor:pointer' : 'color:lightgray;cursor:pointer'}}"
							onclick="window.location='?order_by=birth_date&order=desc'"></i>						

						<i class="fa fa-arrow-down" title="Asc" style="{{(request()->order_by == 'birth_date' && request()->order == 'asc') ? 'cursor:pointer'  : 'color:lightgray;cursor:pointer'}}"
							onclick="window.location='?order_by=birth_date&order=asc'"></i>			
					</div>
				</div>
			</td>
			<td>
				<div class="clearfix">
					<div class="float-left">
						Opsi
					</div>
					<div class="float-right">
						@if(isset(request()->order_by) || isset(request()->order) || isset(request()->location) || isset(request()->birth_date_start) || isset(request()->birth_date_end))
							<i class="fa fa-redo" onclick="window.location='{{route('employee.index')}}'"
								style="cursor:pointer"></i>
						@endif
					</div>
				</div>
			</td>
		</tr>
		@forelse($employee as $item)
		<tr>
			<td>{{$item->name}}</td>
			<td>{{$item->location_code}}</td>
			<td>{{now()->parse($item->birth_date)->format("d M Y")}}</td>
			<td>
				<button class="btn btn-success"
					onclick="window.location='{{route('employee.edit',$item->id)}}'">
					Edit
				</button>
				<form action="{{route('employee.destroy',$item->id)}}" method="post"
					class="d-inline" id="delete-{{$item->id}}">
					@csrf
					@method("DELETE")								
				</form>

				<button class="btn btn-danger" onclick="confirm('Are You') ? document.getElementById('delete-{{$item->id}}').submit() : ''">
					Delete					
				</button>
			</td>
		</tr>
		@empty
		<tr>
			<td colspan="3" class="text-center">
				Data tidak ditemukan
			</td>
		</tr>
		@endforelse
	</table>

	{{$employee->links()}}
</div>

<div style="position:fixed;height:100vh;top:0;bottom:0;left:0;right:0;z-indez:10001;display:none"
	id="search-menu">
	<form method="get">
		<div class="row m-0">
			<div class="col-8"
				style="opacity:0.3;background:black;height:100vh">
				
			</div>
			<div class="col-4 p-3"
				style="background:white;height:100vh">
				<div class="clearfix">
					<div class="float-right">
						<i class="fa fa-times fa-2x"
							style="cursor:pointer"
							onclick="onSearch()"></i>
					</div>
				</div>

				<b>Location : </b>
				<input type="text" name="location" class="form-control mt-4" value="{{request()->location ?? ''}}">

				<b>Birth Date Start :</b>
				<input type="date" name="birth_date_start" class="form-control mt-4" value="{{request()->birth_date_start ?? ''}}">

				<b>Birth Date End : </b>
				<input type="date" name="birth_date_end" class="form-control mt-4" value="{{request()->birth_date_end ?? ''}}">

				<button class="btn btn-primary mt-4">
					Search
				</button>
			</div>
		</div>
	</form>
</div>
@endSection

@section("sc_footer")
<script>
function onSearch(){
	if(document.getElementById("search-menu").style.display == "none"){
		document.getElementById("search-menu").style.display = "block";
	}else{
		document.getElementById("search-menu").style.display = "none";
	}
}
</script>
@endSection