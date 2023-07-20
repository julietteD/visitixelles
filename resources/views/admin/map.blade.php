<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Map') }}
        </h2>
    </x-slot>






<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

<div id="result">
	coordX : <input type="text" id="coordX" /><br/>
	coordY : <input type="text" id="coordY" />
</div>

<div id="clickme">
        <img src="/storage/image/map.svg" style="border:1px solid #ccc" />
</div>
<form id="editForm" enctype="multipart/form-data" method="POST" action="{{route('admin.map.edit.action')}}">
<label class="form-label" for="inputImage">Image: map.svg</label>
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
<script>
	document.getElementById('clickme').onclick = function(e) {
      // e = Mouse click event.
	  let width = e.target.offsetWidth;
	let height = e.target.offsetHeight;

      var rect = e.target.getBoundingClientRect();
      var x = (e.clientX - rect.left)*100 / width; //x position within the element.
      var y = (e.clientY - rect.top)*100 / height;  //y position within the element.
      console.log("Left? : " + x  + "% ; Top? : " + y + ".");
	  console.log("Width? : " + width + " ; height? : " + height + ".");
	  document.getElementById("coordX").value = x;
	  document.getElementById("coordY").value = y;

    }
</script>