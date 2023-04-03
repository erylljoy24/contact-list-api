<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\AuthTrait;
use Illuminate\Http\Response;
use App\Models\User;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{

    use AuthTrait;
    
    public function login(LoginRequest $request)
    {
        if ($token = $this->__authenticate($request)) {
            $user = User::query()
                ->where('id', auth()->id())
                ->first();
            
            return response()->json([
                'token' => $token,
                'user' => $user,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'errors' => [
                'password' => ['Incorrect credentials.']
            ]
        ], Response::HTTP_UNAUTHORIZED);


    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
