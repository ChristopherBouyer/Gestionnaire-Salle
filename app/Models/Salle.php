<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'system_id', 'max_user', 'actual_user', 'is_reserved'];

    protected $casts = [
        'is_reserved' => 'boolean',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_salle', 'salle_id', 'student_id');
    }
}
