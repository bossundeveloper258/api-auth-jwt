<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function departament()
    {
        return $this->hasOne(Department::class, 'id' , 'id_department');
    }

    public function person()
    {
        return $this->hasOne(Person::class);
    }

    public function condominium()
    {
        return $this->hasOne(Condominium::class);
    }

}
