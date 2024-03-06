<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'badge'];

    public function salles()
    {
        return $this->belongsToMany(Salle::class, 'user_salle', 'user_id', 'salle_id');
    }
}
