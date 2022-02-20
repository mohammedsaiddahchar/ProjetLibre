<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartenershipActivity extends Model
{
    protected $fillable=[
        'Title',
        'Description',
        'Date',
        'Type',
        'partener_id'
         

    ];
    public function partener()
    {
        return $this->belongsTo(Partener::class,'partener_id');
    }
}
