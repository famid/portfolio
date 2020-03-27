<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable=['title','company','started_at','ended_at','city','country','company_description','achievement','still_working'];
}
