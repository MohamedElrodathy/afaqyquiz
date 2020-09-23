<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicle extends Model
{
    protected $table = 'vehicle';

    protected $fillable = ['vehicle_name', 'plate Number'];

    public function fuel()
    {
        return $this->belongsTo('App\Models\fuel');
    }
}
