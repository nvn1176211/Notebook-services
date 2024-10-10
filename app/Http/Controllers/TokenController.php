<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTokenRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TokenController extends Controller
{
    // user1@gmail.com
    // 1|MeUMccbbAONCbO60K2SJsyHPRqzpVAolrSWHZQT59aa577b6
    public function create(CreateTokenRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $plainTextToken = self::__create($user);
        return ['token' => $plainTextToken];
    }


    /**
     * @param String $tokenName
     * @param User $user
     * @return String
     */ 
    public static function __create(User $user, $tokenName = null){
        if(empty($tokenName)) $tokenName = $user->email;
        $token = $user->createToken($tokenName);
        return $token->plainTextToken;
    }
}
