<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable=[
     'filiere_id',
     'Title',
     'Description',
     'Details',

    ];
    public function filiere()
    {
        return $this->hasOne(Filiere::class,'filiere_id');
    }
     

}
