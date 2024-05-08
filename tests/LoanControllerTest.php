<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class LoansControllerTest extends TestCase
{
    protected $client;

    protected function setUp(): void
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8000']);
    }

    public function testCreateLoan()
    {
        $response = $this->client->request('POST', '/loans', [
            'json' => [
                'amount' => 1000.00,
                'term' => 12,
                'interest_rate' => 5.0,
                'start_date' => '2023-01-01',
                'end_date' => '2023-12-31'
            ],
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        $this->assertEquals(201, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('loan_id', $data);

        return $data['loan_id'];
    }

    /**
     * @depends testCreateLoan
     */
    public function testGetLoan($loanId)
    {
        $response = $this->client->request('GET', "/loans/{$loanId}");

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertEquals($loanId, $data['id']);
        $this->assertEquals(1000.00, $data['amount']);
        $this->assertEquals(12, $data['term']);
    }

    /**
     * @depends testCreateLoan
     */
    public function testUpdateLoan($loanId)
    {
        $response = $this->client->request('PUT', "/loans/{$loanId}", [
            'json' => ['amount' => 1500.00]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertEquals("Loan updated", $data['message']);
    }

    /**
     * @depends testCreateLoan
     */
    public function testGetLoans($loanId)
    {
        $response = $this->client->request('GET', '/loans');

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
    }

    /**
     * @depends testCreateLoan
     */
    public function testDeleteLoan($loanId)
    {
        $response = $this->client->request('DELETE', "/loans/{$loanId}");

        $this->assertEquals(204, $response->getStatusCode());
    }

    protected function tearDown(): void
    {
        $this->client = null;
    }
}
