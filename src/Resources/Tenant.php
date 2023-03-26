<?php

namespace Mafacturation\Resources;

use Mafacturation\Http\Response;

class Tenant extends Resource
{
    public function __construct($client)
    {
        parent::__construct($client);
    }

    public function get(int $id = null)
    {
        if (is_null($id)) {
            return $this->callApi();
        }
        $this->setId($id);
        return $this->callApi();
    }

    public function callApi(string $path = null, string $method = 'get', array $options = []): Response
    {
        return $this->getClient()
            ->makeAPICall($this->buildEndpoint($path), $method, $options);
    }

    public function buildEndpoint($path)
    {
        $base = 'tenants';
        if ($this->getId()) {
            $base = "$base/{$this->getId()}";
        }
        if (!$path) {
            return $base;
        }
        if (str_starts_with($path, '/')) {
            return $base . $path;
        }
        return "{$base}/{$path}";
    }

}