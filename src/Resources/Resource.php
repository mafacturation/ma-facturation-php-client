<?php

namespace Mafacturation\Resources;

use Mafacturation\Mafacturation;

class Resource
{
    private Mafacturation $maFacturation;
    private $action;
    private $endpoint;
    private $id;

    public function __construct(Mafacturation $client = null, int $id = null)
    {
        if ($client) {
            $this->setMafacturation($client);
        }

        if ($id) {
            $this->setId($id);
        }
    }

    public function setMafacturation(Mafacturation $client): self
    {
        $this->maFacturation = $client;
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

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function getClient(): Mafacturation
    {
        return $this->maFacturation;
    }



}