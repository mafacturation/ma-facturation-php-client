<?php

namespace Mafacturation\Services;

use Mafacturation\Mafacturation;

class AuthService
{
    private Mafacturation $client;

    public function __construct(Mafacturation $client)
    {
        $this->client = $client;
    }

    public function generateToken(string $email, string $password, string $deviceName): array
    {
        return $this->client->post('/sanctum/token', [
            'email' => $email,
            'password' => $password,
            'device_name' => $deviceName,
        ]);
    }
}