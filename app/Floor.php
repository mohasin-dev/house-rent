<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $fillable = [
        'name', 'house_id', 'area', 'flat_number',
    ];
    public function house()
    {
        return $this->belongsTo('App\House');
    }
}
