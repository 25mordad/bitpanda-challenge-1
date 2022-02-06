<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeWithCitizenship($query, $iso3)
    {
        return $query->whereHas('userDetail.country', function ($q) use ($iso3) {
            $q->where('iso3', $iso3);
        });
    }
}
