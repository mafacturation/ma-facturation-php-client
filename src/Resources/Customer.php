<?php

namespace Mafacturation\Resources;

use Mafacturation\Http\Response;
use Mafacturation\Mafacturation;
use Mafacturation\Traits\HasPagination;

class Customer extends Resource
{
    private $endpoint = 'customers';

    use HasPagination;

    public function construct(Mafacturation $client = null, int $id = null)
    {
        parent::construct($client, $id);

        $this->setEndpoint($this->endpoint);
    }

    public function buildEndpoint(?string $path = null): string
    {
        $base = $this->endpoint;
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

    public function get(int $id = null): Response
    {
        if ($id) {
            $this->setId($id);
        }

        return (is_null($this->getId()))
            ? $this->page()
            : $this->callApi();
    }

    public function callApi(string $path = null, string $method = 'get', array $options = []): Response
    {
        return $this->getClient()
            ->makeAPICall($this->buildEndpoint($path), $method, $options);
    }

}