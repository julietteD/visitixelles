<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Location extends Model
{
    use HasFactory;

    public $guarded = [];
    public $timestamps = false;

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function location(){
         
      return $this->BelongsTo(Location::class);
     
    }

    public function scopeFilter($query)
    {
        if(request('search')){
            $query->where('name','like','%'.request('search').'%');
        }
        $query->where('status',1);

    }

    public function saveTags(string $tags){
        $tags = array_unique(array_map(function($item){
            return trim($item);
        },explode(',', $tags)));

            $persisted_tags = Tag::whereIn('title', $tags)->get();
            $tags_to_create = array_diff($tags, $persisted_tags->pluck('title')->all());
            $tags_to_create= array_map(function($tag){
            return ['title' => $tag, 'slug'=>Str::slug($tag)];
        }, $tags_to_create);
        
            $created_tags = $this->tags()->createMany($tags_to_create);
            $persisted_tags = $persisted_tags->merge($created_tags);
            $this->tags()->sync($persisted_tags);
        }
}
   

