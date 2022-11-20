<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'area',
        'date',
        'country_image',
        'pilot_id',
        'plane_id',
    ];

    public function pilot()
    {
        return $this->belongsTo(Pilot::class);
    }

    public function plane()
    {
        return $this->belongsTo(Plane::class);
    }

}
