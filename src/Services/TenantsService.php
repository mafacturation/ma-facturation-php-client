<?php

namespace Mafacturation\PhpClient\Services;

use Mafacturation\PhpClient\MafacturationClient;

class TenantsService
{
    private MafacturationClient $client;

    public function __construct(MafacturationClient $client)
    {
        $this->client = $client;
    }

    public function getTenants(): array
    {
        return $this->client->get('/tenants');
    }
}