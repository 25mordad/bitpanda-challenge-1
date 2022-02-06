<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Http\Requests\UpdateDetailsRequest;
use App\Http\Requests\DeleteUserRequest;

class UserController extends Controller
{
    public function getActiveAustrians()
    {
        return User::active()->withCitizenship('AUT')->get();
    }

    public function updateDetails(UpdateDetailsRequest $request, User $user)
    {
        $user->userDetail->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'citizenship_country_id' => Country::where('iso3', $request->country_iso3)->first()->id
        ]);
        return back();
    }

    public function destroy(DeleteUserRequest $request, User $user)
    {
        $user->delete();
        return back();
    }
}
