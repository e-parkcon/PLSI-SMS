<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TIXNUM extends Model
{
    //

    protected $connection = 'sqlsrv';
    protected $table = 'Task';
    // protected $primaryKey = 'Id';
    public $incrementing = false;
    public $timestamps = false;
}
