<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Coffee') }}
        </h2>
    </x-slot>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


<form id="editForm" enctype="multipart/form-data" method="POST" action="{{route('admin.gif.edit.action')}}">
<label class="form-label" for="inputImage">Image: coffee.gif</label>
<input
type="file"
name="image"
id="inputImage"
class="form-control @error('image') is-invalid @enderror">
@csrf
<button type="submit" class="btn btn-primary">Envoyer</button>

</form>
<div class="form">
</div>

</x-app-layout>
