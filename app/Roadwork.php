<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roadwork extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'referent', 'department', 'user_id', 'from_lat', 'from_long', 'to_long', 'to_lat'
    ];

    /**
     * Relation to markers
     */
    public function markers()
    {
        return $this->hasMany(Marker::class);
    }
}
