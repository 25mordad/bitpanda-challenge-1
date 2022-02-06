<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getActiveAustrians()
    {
        return User::active()->withCitizenship('AUT')->get();
    }
}
