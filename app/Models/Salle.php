<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'system_id', 'max_user', 'actual_user'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_salle', 'salle_id', 'user_id');
    }
}
