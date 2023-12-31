<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Locations') }}
        </h2>
    </x-slot>






<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

<div class="addLine">
	<a href="{{route('admin.locations.new')}}" class="btn cur-p btn-success">Nouveau</a>
</div>
	
	<table class="table-auto">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Titre</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			@foreach($locations as $location)
				<tr>
					<th scope="row">{{ $location->name }}</th>
					<td>{{ $location->status == 1 ? 'visible' : 'caché' }}</td>
					<td>@if(!empty($location->path))<img style="width:40px; border: 1px solid #ccc; margin-top: 10px" src="/storage/{{ $location->path }}">@endif</td>
					<td class="mainActions">
						<a class="action btn btn-info" href="{{ route('admin.locations.edit', ['id' => $location->id ])}}">Edit</a>
						<a class="action btn btn-danger delete" onclick="return warning()" href="{{ route('admin.locations.delete', [ 'id' => $location['id']])}}">Delete</a>
					</td>
					
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

</x-app-layout>
