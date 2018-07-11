<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
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
}
