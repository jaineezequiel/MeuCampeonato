<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    
    public function redirectToProvider($provider) : JsonResponse
    {
        return response()->json([
            'url' => Socialite::driver($provider)
                         ->stateless()
                         ->redirect()
                         ->getTargetUrl(),
        ]);
    }
 

    public function handleProviderCallback($provider): JsonResponse
    {
        try {
            /** @var SocialiteUser $socialiteUser */
            $socialiteUser = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $e) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        /** @var User $user */
        $user = User::query()
            ->firstOrCreate(
                [
                    'email' => $socialiteUser->getEmail(),
                ],
                [
                    'name' => $socialiteUser->getName() ?? $socialiteUser->getNickname(),
                    'provider_id' =>  $socialiteUser->getId(),
                    'provider' => $provider,
                ]
            );

        return response()->json([
            'user' => $user,
            'access_token' => $user->createToken('provider-token')->plainTextToken,
            'token_type' => 'Bearer',
        ]);
    }
}
