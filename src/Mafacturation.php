<?php

namespace Mafacturation;

use Exception;
use GuzzleHttp\Client;
use Mafacturation\Exceptions\InternalServerError;
use Mafacturation\Exceptions\NotAllowed;
use Mafacturation\Exceptions\NotFound;
use Mafacturation\Exceptions\NotValid;
use Mafacturation\Exceptions\PerformingMaintenance;
use Mafacturation\Exceptions\TooManyAttempts;
use Mafacturation\Exceptions\Unauthenticated;
use Mafacturation\Http\Response;
use Mafacturation\Resources\Customer;
use Mafacturation\Resources\Company;
use Psr\Http\Message\ResponseInterface;

class Mafacturation
{
    public Client $httpClient;
    private string $url = 'https://mafacturation.be/api/';
    private ?string $token = null;
    private ?string $tenant_id = null;

    public function __construct(?string $token = null, ?string $tenant = null)
    {
        if ($token) {
            $this->setToken($token);
        }
        if ($tenant) {
            $this->setTenant($tenant);
        }
        $this->refreshGuzzleInstance();
    }

    //set token function
    public function setToken(string $token): void
    {
        $this->token = $token;
        $this->refreshGuzzleInstance();
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setTenant(string $tenant): void
    {
        $this->tenant_id = $tenant;
        $this->refreshGuzzleInstance();
    }

    public function makeAPICall(string $url, string $method = 'get', array $options = []): Response
    {
        if (!in_array($method, ['get', 'post', 'patch', 'delete'])) {
            throw new Exception('Invalid method type');
        }

        /**
         * @var ResponseInterface $response
         */
        $response = $this->httpClient->{$method}($url, $options);

        switch ($response->getStatusCode()) {
            case 401:
                throw new Unauthenticated($response->getBody());
            case 404:
                throw new NotFound($response->getBody());
            case 405:
                throw new NotAllowed($response->getBody());
            case 422:
                throw new NotValid($response->getBody());
            case 429:
                throw new TooManyAttempts($response->getBody());
            case 500:
                throw new InternalServerError($response->getBody());
            case 503:
                throw new PerformingMaintenance($response->getBody());
        }

        return new Response($response);
    }

    public function customer(int $id = null): Customer
    {
        return new Customer($this, $id);
    }

    public function customers(int $id = null): Customer
    {
        return $this->customer($id);
    }

    //tenants
    public function tenant(int $id = null): Company
    {
        return new Company($this, $id);
    }

    public function tenants(int $id = null): Company
    {
        return $this->tenant($id);
    }

    public function login(string $email, string $password, string $deviceName): Response
    {
        return $this->makeAPICall('sanctum/token', 'post', [
            'json' => [
                'email' => $email,
                'password' => $password,
                'device_name' => $deviceName,
            ],
        ]);
    }

    private function refreshGuzzleInstance()
    {
        $headers = [
            'Accept' => 'application/json',
            'Content-Type'  => 'application/json',
        ];
        if ($this->token) {
            $headers['Authorization'] = 'Bearer ' . $this->token;
        }
        if($this->tenant_id){
            $headers['X-Tenant'] = $this->tenant_id;
        }
        $this->httpClient = new Client([
            'http_errors' => false,
            'base_uri' => $this->url,
            'headers' => $headers,
        ]);
    }


}