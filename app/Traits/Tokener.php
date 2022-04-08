<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

trait Tokener
{
	public function createToken( User $user, array $scopes = [], string $name = 'Oauth Access Token' )
    {
		return $user->createToken($name, $scopes)->accessToken;
	}
}
