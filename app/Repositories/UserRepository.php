<?php

namespace App\Repositories;

use App\Exceptions\WrongPasswordException;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository
{
    /**
     * @throws WrongPasswordException
     */
    public static function update(UserUpdateRequest $request)
    {
        $user = User::find(Auth::user()->id);

        $user->name = $request->name;

        if ($request->password) {
            if (!Hash::check($request->current_password, auth()->user()->password)) {
                throw new WrongPasswordException(__('messages.wrong_password_error'));
            }
            $user->password = Hash::make($request->password);
        }

        return $user->save();
    }
}
