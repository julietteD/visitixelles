<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $guarded = [];
    public $timestamps = false;
   
    public function locations(){
        return $this->belongsToMany(Location::class);
    }
}
