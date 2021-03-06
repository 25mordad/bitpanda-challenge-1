<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;


    public function country()
    {
        return $this->belongsTo(Country::class, 'citizenship_country_id');
    }

}
