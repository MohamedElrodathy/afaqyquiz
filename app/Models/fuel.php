<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fuel extends Model
{
    protected $table = 'fuel_entries';

    protected $fillable = ['vehicle_id', 'entry_date','volume','cost'];
    public function vehicle()
    {
        return $this->belongsTo('App\Models\vehicle');
    }
}
