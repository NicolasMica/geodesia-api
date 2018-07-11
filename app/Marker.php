<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
