<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condominium extends Model
{
    use HasFactory;

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function TypeProperty()
    {
        return $this->belongsTo(TypeProperty::class);
    }

    public function persons()
    {
        return $this->belongsToMany(Person::class, 'person_condominia');
    }

    public function admins()
    {
        return $this->belongsToMany(Person::class, 'admin_condominia');
    }
}
