<?php

namespace Mafacturation\Resources;

use Mafacturation\Mafacturation;

class Resource
{
    private Mafacturation $client;
    private $action;
    private $endpoint;
    private $id;

    public function __construct(Mafacturation $client = null, int $id = null)
    {
        if ($client) {
            $this->setClient($client);
        }

        if ($id) {
            $this->setId($id);
        }
    }

    public function setClient(Mafacturation $client): self
    {
        $this->client = $client;
        return $this;
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setEndpoint(string $endpoint): void
    {
        $this->endpoint = $endpoint;
    }

    public function getEndpoint() : ?string
    {
        return $this->endpoint;
    }

    public function getClient(): Mafacturation
    {
        return $this->client;
    }

}