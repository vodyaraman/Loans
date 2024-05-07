<?php

use PHPUnit\Framework\TestCase;

class LoansControllerTest extends TestCase
{
    protected $client;

    protected function setUp(): void
    {
        // Создание клиента для тестирования
        $this->client = new GuzzleHttp\Client(['base_uri' => 'http://localhost:8000']);
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
        $this->assertArrayHasKey('id', $data);
        $this->assertEquals(1000.00, $data['amount']);
        $this->assertEquals(12, $data['term']);
        $this->assertEquals(5.5, $data['interest_rate']);
        $this->assertEquals('2023-01-01', $data['start_date']);
        $this->assertEquals('2023-12-31', $data['end_date']);
    }

    /*public function testGetLoan()
    {
        $loanId = 1; // Предположим, что займ с ID 1 существует
        $response = $this->client->request('GET', "/loans/{$loanId}");

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertEquals($loanId, $data['id']);
        $this->assertEquals(1000.00, $data['amount']);
        $this->assertEquals(12, $data['term']);
    }

    public function testUpdateLoan()
    {
        $loanId = 1;
        $response = $this->client->request('PUT', "/loans/{$loanId}", [
            'json' => ['amount' => 1500.00]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertEquals(1500.00, $data['amount']);
    }

    public function testGetLoans()
    {
        $response = $this->client->request('GET', '/loans');

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
    }
    
    public function testDeleteLoan()
    {
        $loanId = 1; // Предположим, что займ с ID 1 существует
        $response = $this->client->request('DELETE', "/loans/{$loanId}");

        $this->assertEquals(204, $response->getStatusCode()); 
    } */

    protected function tearDown(): void
    {
        $this->client = null;
    }
}


