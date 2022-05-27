<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'name', 'email','message'
    ];

    public function message()
    {
        return $this->belongsTo('App\Models\Message');
    }
}
