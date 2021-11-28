<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id' , 'id_rol');
    }
}
