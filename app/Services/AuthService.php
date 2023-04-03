<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\ {
    User,
    EmployeeCode, // old
    AccountRequest,
	StaffCode, // new
};
use DB;

class AuthService
{
    public static function checkIdentity($request)
    {
        $field = filter_var($request->identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->merge([$field => $request->identity]);
        return $request; 
    }

    public static function checkFieldType($identity)
    {
        $field = filter_var($identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        return $field; 
    }

    public static function identifyEmployee($request)
    {
        if ($code = EmployeeCode::query()
                ->with('employee')
                ->where('code', $request->password)
                ->first()) {
        
            return $code->employee;
        }
        return false;
    }

    public static function validateCode($request)
    {
		$code = StaffCode::query()
			->with(['staff'])
			->where('code', $request->code)
			->where('password', $request->password);

        if ($code->exists()) {
            return $code->first()->staff;
        }

        return false;
    }

    public static function checkUserIfExist($data = "", $field = "email")
    {
        return User::query()
            ->where($field, $data)
            ->exists();
    }
}