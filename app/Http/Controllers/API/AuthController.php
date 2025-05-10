<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\RegisterRequest;
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return Symfony\Component\HttpFoundation\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return self::error("unauthorized ! ",401);
        }

        return $this->respondWithToken($token);
    }

    public function register(RegisterRequest $request)
    {
        $user=User::create($request->only(['name','email']+['password'=>\Hash::make($request->password)]));
 
        return $this->respondWithToken($user->createToken());
        
    }

    /**
     * Get the authenticated User.
     *
     * @return Symfony\Component\HttpFoundation\JsonResponse
     */
    public function me()
    {
        return self::success(data:auth()->user(),code:Response::HTTP_OK);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return Symfony\Component\HttpFoundation\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return self::success(data:true,message:"Successfully logged out");
    }

    /**
     * Refresh a token.
     *
     * @return Symfony\Component\HttpFoundation\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return Symfony\Component\HttpFoundation\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return self::success(data:[
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ],code:Response::HTTP_OK);
    }
}
