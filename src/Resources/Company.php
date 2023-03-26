<?php

namespace Mafacturation\Resources;

use Mafacturation\Http\Response;
use Mafacturation\Mafacturation;

class Company extends Resource
{
    public function __construct(Mafacturation $client, int $id = null)
    {
        parent::__construct($client, $id);
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
        $base = 'companies';
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