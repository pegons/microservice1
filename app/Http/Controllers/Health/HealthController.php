<?php

namespace App\Http\Controllers\Health;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class HealthController extends Controller
{

    public function __invoke(Request $request): array
    {
        $token = $request->bearerToken();
        $tokenParts = explode(".", $token);
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);

        return ['response' => $jwtPayload];
    }
}
