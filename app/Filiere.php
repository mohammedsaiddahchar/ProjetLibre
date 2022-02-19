<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Filiere extends Model
{
    protected $fillable = [
        'Nom',
        'code',
        'Description',
        'id_teacher',
        
    ];
    public function teacher(){
        return $this->hasOne(Teacher::class,'id_teacher');
    }
    public function student()
    {
        return $this->hasMany(Student::class);
    }
    public function activity(){
        return $this->hasMany(Activity::class);
    }

}