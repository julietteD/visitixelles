<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Tags') }}
        </h2>
    </x-slot>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

<div class="bgc-white p-20 bd">

<div class="mT-30">
<form id="editForm" enctype="multipart/form-data" method="POST" action="{{route('admin.tags.edit.action')}}">



<fieldset>
<div class="form-group">
<label>Titre</label>
<input type="text" required class="form-control" name="title" value="@if(!empty($tag->title)){{$tag->title}}@endif" >
</div>




</fieldset>



@csrf

<input type="hidden" name="id" value="@if(!empty($tag->id)){{$tag->id}}@endif"/>
<button type="submit" class="btn btn-primary">Envoyer</button>
</form>
</div>
</div>


</div>
</x-app-layout>

