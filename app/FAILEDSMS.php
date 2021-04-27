<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FAILEDSMS extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'failedmsg';
    protected $primaryKey = 'internalKey';
    public $incrementing = false;
    public $timestamps = false;
}
