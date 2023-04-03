<?php
namespace App\Traits;

use Illuminate\Support\Facades\Hash;
use App\Services\ {
    AuthService,
};
use App\Models\User;

trait AuthTrait
{
    public static function __authenticate($request)
    {
        $credentials = AuthService::checkIdentity($request);
        if ($credentials->has('email')) {
			$user = User::query()
				->where('email', $request->email)
				->first();
				
            if (Hash::check($request->password, $user->password)) {
                if (auth()->loginUsingId($user->id ?? null, $request->remember ?? false)) {
                    return auth()
                        ->user()
                        ->createToken(config('auth.password_grant'))
                        ->accessToken;
                }
            }

            return false;
		}

        if (auth()->attempt($credentials->except('identity'), $request->remember ?? false)) {
            return auth()
                ->user()
                ->createToken(config('auth.password_grant'))
                ->accessToken;
        }
        return false;
    }
}