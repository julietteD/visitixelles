<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tags') }}
        </h2>
    </x-slot>






<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

<div class="addLine">
	<a href="{{ route('admin.deletealltags') }}" class="btn cur-p btn-success">Supprimer les tags non utilisés</a>
</div>
<table class="table-auto">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Titre</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			@foreach($tags as $tag)
				<tr>
					<th scope="row">{{ $tag->title }}</th>
					
					<td class="mainActions">
					<a class="action btn btn-info" href="{{ route('admin.tags.edit', ['id' => $tag->id ])}}">Edit</a>
					<a class="action btn btn-danger delete" onclick="return warning()" href="{{ route('admin.deletetags', [ 'id' => $tag['id']])}}">Delete</a>
					</td>
					
				</tr>
			@endforeach
		</tbody>
	</table>
	
</div>

</x-app-layout>
