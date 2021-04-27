<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OTHERSMS extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'othmsg';
    protected $primaryKey = 'internalKey';
    public $incrementing = false;
    public $timestamps = false;
}
