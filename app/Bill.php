<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public function flat()
    {
        return $this->belongsTo('App\Flat');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
