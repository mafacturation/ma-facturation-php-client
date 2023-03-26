<?php

namespace Mafacturation\MaFacturationPhpClient\Services;

use Mafacturation\MaFacturationPhpClient\MafacturationClient;

class AuthService
{
    private MafacturationClient $client;

    public function __construct(MafacturationClient $client)
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