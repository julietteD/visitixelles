<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Str;
use Response;
use Cache;
use DB;

class AdminController extends Controller
{
  /* LOCATIONS */
  public function locations()
  {
      $locations = Location::paginate(15);
      return view('admin.locations', ['locations' => $locations]);
  }

  public function jsonlocations()
  {
    $locations = Location::where('status', 1)->get();
    return $locations->toJson();
   }

    public function jsonlocation($id = null)
    {
        $location = Location::where('id', $id )->first();
        return $location->toJson();
      }

      public function jsontags()
      {
          $tags = Tag::all();
          return $tags->toJson();
      }

    public function editLocation($id = null)
  {
      $locations = Location::all();
      $tags = Tag::all();
      $location = Location::where('id', $id )->first();

      return view('admin.locations.edit', ['location' => $location, 'locations' => $locations, 'tags' => $tags]);


  }
  
  public function deleteLocation( $id = null)
  {
      $location = Location::where('id', $id )->first();

      if ($location) {
          $location->delete();
      }
     
      Cache::flush();
      return redirect()->route('admin.locations');
  }

  public function deleteTags( $id = null)
  {
      $tag = Tag::where('id', $id )->first();

      if ($tag && $tag->locations->count()==0) {
         $tag->delete();
         Cache::flush();
         return 'ok';
      }
      else{
        return 'not ok';
      }
     
     
  }

  public function deleteAllTags( )
  {
    $tags = Tag::all();
    foreach($tags as $tag){
    

      if ($tag && $tag->locations->count()==0) {
         $tag->delete();
         Cache::flush();
        
      }
    
    }
    return 'done'; 
     
  }
  
  public function editLocationAction(Request $request)
  {
      
      $newId = $request->input('id');
      $location = false;
      if ($newId) {
          $location = Location::where('id', $newId)->first();
      }
      if (!$location) {
          $location = new Location();
      }
      
      $validatedData = $request->validate([
        'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
       ]);
      
      if($request->file('image') ){  $path = $request->file('image')->store('image', 'public');

       $location->path = $path;}
      
      $location->name = $request->input('name'); 
      if($location->location_id!=0){
      $location->location_id = $request->input('location_id'); 
       }
      $location->status = $request->input('status'); 
      $location->description = $request->input('description');    
      if($request->input('tags')){  $location->saveTags($request->input('tags'));}
      $location->slug = Str::slug($request->input('name'));
      $location->coordX = $request->input('coordX'); 
      $location->coordY = $request->input('coordY'); 
      $location->save();
      Cache::flush();
      return redirect()->route('admin.locations');
  }

  public function editMapAction(Request $request)
  {
      
    
      
      $validatedData = $request->validate([
        'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
       ]);
      
      if($request->file('image') ){  $path = $request->file('image')->storeAs('image', 'map.svg', 'public');

     }
      
    
      return redirect()->route('admin.map');
  }
  


  public function tags()
  {
      $tags = Tag::all();
      return view('admin.tags', ['tags' => $tags]);
  }

  public function map()
  {
      return view('admin.map');
  }


  public function editTag($id = null)
  {
      $tag = Tag::where('id', $id )->first();
      return view('admin.tags.edit', ['tag' => $tag]);

  }

  public function editTagAction(Request $request)
  {
      
      $newId = $request->input('id');
      $tag = false;

      if ($newId) {
          $tag = Tag::where('id', $newId)->first();
      }
      if (!$tag) {
          $tag = new Tag();
      }
      
      $tag->title = $request->input('title'); 
     
      $tag->save();
      Cache::flush();
      return redirect()->route('admin.tags');
  }

  public function gif()
  {
      return view('admin.editgif');
  }


  public function editGifAction(Request $request)
  {
      
    
      
      $validatedData = $request->validate([
        'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
       ]);
      
      if($request->file('image') ){  $path = $request->file('image')->storeAs('image', 'coffee.gif', 'public');

     }
      
    
      return redirect()->route('admin.editgif');
  }
  
}



