<?php

use App\Models\User;
use Firebase\JWT\JWT;

/**
 * @throws Exception
 */
function getJWTRequest($authenticationHeader)
{
    if (is_null($authenticationHeader)) throw new Exception('Missing or invalid JWT request');

    return explode(' ', $authenticationHeader)[1];
}

/**
 * @throws Exception
 */
function validateJWTRequest($encodeToken)
{
    $key = getenv('JWT_SECRET_KEY');
    $decodeToken = JWT::decode($encodeToken, $key, ['HS256']);
    $authModel = new User();
    $authModel->findUserByUsername($decodeToken->username);
}

function createJWT($username): string
{
    $key = getenv('JWT_SECRET_KEY');
    $time = time();
    $timeToLive = getenv('JWT_TIME_TO_LIVE');
    $tokenExpiration = $time + $timeToLive;
    $payload = [
        'username' => $username,
        'iat' => $time,
        'exp' => $tokenExpiration
    ];

    return JWT::encode($payload, $key);
}