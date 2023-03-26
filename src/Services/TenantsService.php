<?php

namespace Mafacturation\Services;

use Mafacturation\Mafacturation;

class TenantsService
{
    private Mafacturation $client;

    public function __construct(Mafacturation $client)
    {
        $this->client = $client;
    }

    public function getTenants(): array
    {
        return $this->client->get('/tenants');
    }
}