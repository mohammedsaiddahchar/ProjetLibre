<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'subject_code',
        'teacher_id',
        'level',
        'description'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
