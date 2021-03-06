<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProperty extends Model
{
    use HasFactory;

    public function condominium()
    {
        return $this->hasOne(Condominium::class);
    }
}
