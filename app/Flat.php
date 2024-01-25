<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    protected $fillable = [
        'name', 'area', 'floor_id', 'electricity_bill', 'gass_bill', 'water_bill', 'others_bill', 'rent', 'room_number',
    ];
    public function floor()
    {
        return $this->belongsTo('App\Floor');
    }
}
