@extends("layout.default")

@section("title","Location")

@section("content")
<div class="container mt-3">
	<div class="clearfix mt-4 mb-4">
		<div class="float-left mt-3">
			<h1>Location</h1>
		</div>

		<div class="float-right">
			<button class="btn btn-primary mt-3"
				onclick="window.location='{{route('location.create')}}'"> 
				Add Location
			</button>
		</div>
	</div>

	<table class="table">
		<tr>
			<td>
				<div class="clearfix">
					<div class="float-left">
						Code
					</div>
					<div class="float-right">			
							<i class="fa fa-arrow-up" title="Desc" style="{{(request()->order_by == 'code' && request()->order == 'desc') ? 'cursor:pointer' : 'color:lightgray;cursor:pointer'}}"
							onclick="window.location='?order_by=code&order=desc'"></i>						

						<i class="fa fa-arrow-down" title="Asc" style="{{(request()->order_by == 'code' && request()->order == 'asc') ? 'cursor:pointer'  : 'color:lightgray;cursor:pointer'}}"
							onclick="window.location='?order_by=code&order=asc'"></i>			
					</div>
				</div>
			</td>
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
						Opsi
					</div>
					<div class="float-right">
						@if(isset(request()->order_by) && isset(request()->order))
							<i class="fa fa-redo" onclick="window.location='{{route('location.index')}}'"
								style="cursor:pointer"></i>
						@endif
					</div>
				</div>
			</td>
		</tr>
		@forelse($location as $item)
		<tr>
			<td>{{$item->code}}</td>
			<td>{{$item->name}}</td>
			<td>
				<button class="btn btn-success"
					onclick="window.location='{{route('location.edit',$item->id)}}'">
					Edit
				</button>
				<form action="{{route('location.destroy',$item->id)}}" method="post"
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

	{{$location->links()}}
</div>
@endSection