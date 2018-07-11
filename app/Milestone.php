<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;

class Milestone extends Model
{
    use PostgisTrait;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'milestone';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bornes';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'gid';

    /**
     * Postgis specific fields
     *
     * @var array
     */
    protected $postgisFields = [
        'geom'
    ];

    /**
     * Casted postgis fields
     *
     * @var array
     */
    protected $postgisTypes = [
        'geom' => [
            'geomtype' => 'geometry',
            'srid' => 3857 // 2153
        ]
    ];
}
