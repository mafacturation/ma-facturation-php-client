<?php

namespace Mafacturation\MaFacturationPhpClient\Resources;

use Mafacturation\MaFacturationPhpClient\MafacturationClient;

class Resource
{
    private MafacturationClient $maFacturation;
    private $action;
    private $endpoint;
    private $id;

    public function construct(MafacturationClient $client = null, int $id = null)
    {
        if ($client) {
            $this->setMafacturation($client);
        }

        if ($id) {
            $this->setId($id);
        }
    }

    public function setMafacturation(MafacturationClient $client): self
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

}