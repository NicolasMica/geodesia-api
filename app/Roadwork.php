<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roadwork extends Model
{
    
    public function markers()
    {
        return $this->hasMany(Marker::class);
    }


}
