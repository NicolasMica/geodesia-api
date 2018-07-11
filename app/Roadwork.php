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
        'name', 'description', 'geometry', 'referent', 'department', 'user_id'
    ];
    
    /**
     * Relation to markers
     */
    public function markers()
    {
        return $this->hasMany(Marker::class);
    }
}
