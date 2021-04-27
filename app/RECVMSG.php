<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RECVMSG extends Model
{
    //

    protected $connection = 'mysql';
    protected $table = 'recvmsg';
    protected $primaryKey = 'internalKey';
    public $incrementing = false;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'internalkey', 'txndate', 'txntime', 'remarks', 'userid', 'status'
    ];

}
