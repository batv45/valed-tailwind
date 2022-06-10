<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AccountUpdateRequest;
use App\Http\Requests\User\PasswordUpdateRequest;

class AccountController extends Controller
{
    public function show()
    {
        return inertia('Account/Index');
    }

    public function update(AccountUpdateRequest $request)
    {

        $user = $request->user();

        $user->fill($request->validated());

        if($user->isDirty()){
            if( $user->isDirty('email') )
            {
                $user->email_verified_at = null;
                $user->sendEmailVerificationNotification();
            }
            $user->save();
        }

        flash('Hesap bilgileri güncellendi.')->success();
        return back();
    }

    public function password(PasswordUpdateRequest $request)
    {
        $user = $request->user();

        $user->update([
            'password' => bcrypt($request->input('password'))
        ]);

        flash('Hesap şifresi güncellendi.')->success();
        return back();

    }

    public function settings()
    {
        return inertia('Account/Settings');
    }
}
