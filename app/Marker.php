<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{

    /**
     * @var array - Fillable fields
     */
    protected $fillable = [
        'name', 'description', 'latitude', 'longitude', 'user_id', 'roadwork_id'
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
