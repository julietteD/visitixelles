<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Locations') }}
        </h2>
    </x-slot>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

<div class="bgc-white p-20 bd">

<div class="mT-30">
<form id="editForm" enctype="multipart/form-data" method="POST" action="{{route('admin.locations.edit.action')}}">



<fieldset>
<div class="form-group">
<label>Titre</label>
<input type="text" required class="form-control" name="name" value="@if(!empty($location->name)){{$location->name}}@endif" >
</div>




</fieldset>

<fieldset>
    <div class="form-group">
        <label>Coord X</label>
        <input type="text"  class="form-control" name="coordX" value="@if(!empty($location->coordX)){{$location->coordX}}@endif" >
    </div>
    <div class="form-group">
        <label>Coord Y</label>
        <input type="text"  class="form-control" name="coordY" value="@if(!empty($location->coordY)){{$location->coordY}}@endif" >
    </div>
</fieldset>

<fieldset>

    <div class="form-group">
        <label>Rebond</label>
        <select name="location_id">
        <option value="0" @if($location && $location->location_id==0)  selected @endif>
               Pas de rebond
            </option>
        @foreach($locations as $rebond)
            <option value="{{ $rebond->id }}" @if($location && $location->location_id==$rebond->id)  selected @endif>
                {{ $rebond->name }}
            </option>
        @endforeach
        </select>
    </div>

</fieldset>

<fieldset>
    <div class="form-group">
        <label>Status</label>
        <select name="status">
            <option value="0" @if($location && $location->status==0) selected @endif>Draft</option>
            <option value="1" @if($location && $location->status==1) selected @endif>Publié</option>
        </select>
    </div>
</fieldset>

<div class="mb-3">
<label class="form-label" for="inputImage">Image:</label>


<input
type="file"
name="image"
id="inputImage"
class="form-control @error('image') is-invalid @enderror">
@if(!empty($location->path))<img style="width:40px; border: 1px solid #ccc; margin-top: 10px" src="/storage/{{ $location->path }}">@endif
@error('image')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>
<div class="form-group">
<label>tags</label>

@foreach($tags as $tag)
<input type="checkbox" class="tagcb" value="{{ $tag->title }}"><label>{{ $tag->title }}</label>

@endforeach


<input type="text"  class="tags" name="tags"  id="tags" value="@if(!empty($location->tags)) @foreach($location -> tags as $tag){{ $tag->title }}, @endforeach @endif" >
</div>

<fieldset>
    <div class="form-group">
        <label>Contenu</label>
        <textarea class="summernote form-control" name="description">
        @if(!empty($location->description)){{$location->description}}@endif
        </textarea>
    </div>


</fieldset>

<!--<div class="form-group featured-image-form">
<label>Image (800x600px)</label>
@if(!empty($location->thumb))
<div><img class="loadedPicture" src="{{ asset('img/news') }}/{{$location->thumb}}" /></div>
@endif
<input type="file" class="form-control" name="thumb" >
<small>Only .jpg,  .png or .jpeg images</small>
</div>

<div class="form-group featured-image-form">
<label>Banner (800x600px)</label>
@if(!empty($location->banner))
<div><img class="loadedPicture" src="{{ asset('img/banners') }}/{{$location->banner}}" /></div>
@endif
<input type="file" class="form-control" name="banner" >
<small>Only .jpg, .png or .jpeg images</small>

<div class="line"><input type="checkbox" name="deletepict" value="oui">
<label>Supprimer l'image</label>
</div>
</div>-->



@csrf

<input type="hidden" name="id" value="@if(!empty($location->id)){{$location->id}}@endif"/>
<button type="submit" class="btn btn-primary">Envoyer</button>
</form>
</div>
</div>


</div>
</x-app-layout>


<script>
    var inputcb = document.getElementsByClassName('tagcb');
    for (var i = 0 ; i < inputcb.length; i++) {
          inputcb[i].addEventListener('click', function() {
            var elem = document.querySelector('.tags');
            var old  = elem.value.trim(); 
            if(!this.checked){
                elem.value = old.replace(this.value, "");
            }
            else{
                elem.value = old + ',' + this.value;
            }
        }, false ) ; }
</script>