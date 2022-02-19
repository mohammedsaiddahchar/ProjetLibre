<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partener extends Model
{
    protected $fillable=[
        
        'Nom',
        'presentation',
        'partnership_type',
        'partnership_status',
        'partner_type',
        'is_partenerOfYear',
    ];

    public function partenershipactivity()
    {
        return $this->hasMany(PartenershipActivity::class);
    }
}
