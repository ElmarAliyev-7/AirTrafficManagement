<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilot extends Model
{
    use HasFactory;

    protected $fillable = [
      'fullname',
      'about',
      'image',
    ];

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
