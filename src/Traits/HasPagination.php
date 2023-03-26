<?php

namespace Mafacturation\MaFacturationPhpClient\Traits;

use Mafacturation\MaFacturationPhpClient\MafacturationClient;

trait HasPagination
{
    /**
     * @var int
     */
    protected $amountPerPage;

    abstract public function getClient(): ?MafacturationClient;

    abstract public function getEndpoint(): ?string;

    public function perPage(?int $amountPerPage = null): self
    {
        $this->amountPerPage = $amountPerPage;

        return $this;
    }

    public function page(int $pageNumber = 1, ?int $amountPerPage = null)
    {
        return $this->getClient()->makeAPICall(
            $this->getEndpoint() . $this->getPaginationQuery($pageNumber, $amountPerPage)
        );
    }

    protected function getPaginationQuery(int $pageNumber, ?int $amountPerPage = null): string
    {
        $path = "?page={$pageNumber}";

        if ($amountPerPage) {
            $this->perPage($amountPerPage);
        }

        if ($this->amountPerPage) {
            $path .= "&per_page={$this->amountPerPage}";
        }

        return $path;
    }
}