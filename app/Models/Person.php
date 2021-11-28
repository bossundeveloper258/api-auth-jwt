<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = ['name','nuip','lastname', 'email', 'phone', 'status', 'id_city'];

    public function cities()
    {
        return $this->belongsTo(City::class);
    }

    public function type_person()
    {
        return $this->belongsTo(TypePerson::class,'id_type_person' , 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function condominiums()
    {
        return $this->belongsToMany(Condominium::class, 'person_condominia');
    }

}
