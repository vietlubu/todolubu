<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class TaskTest extends TestCase
{
    private $client;
    private $createdId;
    private $currentDate;

    /**
     * Setup before test
     *
     * @return void
     */
    public function setUp()
    {
        $this->client = new Client(["base_uri" => "http://0.0.0.0:8888"]);
        $this->createdId = time();
        $this->currentDate = date("Y-m-d", time());
    }

    /**
     * Test Create task success
     *
     * @return void
     */
    public function testCreateSuccess() {
        $data = [
            "id" => $this->createdId,
            "name" => "New task",
            "starting_date" => $this->currentDate,
        ];

        $response = $this->client->post('/task/create', ["form_params" => $data]);
        $responseData = json_decode($response->getBody()->getContents());

        $this->assertEquals("success", $responseData->status);

    }

    /**
     * Test show task success
     *
     * @return void
     */
    public function testShowSuccess() {
        $response = $this->client->get('/task/show/' . $this->createdId);
        $responseData = json_decode($response->getBody()->getContents());

        $this->assertEquals($this->createdId, $responseData->id);
        $this->assertEquals("New task", $responseData->name);
        $this->assertEquals($this->currentDate, $responseData->starting_date);
        $this->assertEquals(null, $responseData->ending_date);
        $this->assertEquals(1, $responseData->status);
    }

    /**
     * Test update task success
     *
     * @return void
     */
    public function testUpdateSuccess() {
        $data = [
            "id" => $this->createdId,
            "name" => "New task update",
            "starting_date" => date("Y-m-d", time()),
        ];

        $response = $this->client->post('/task/update', ["form_params" => $data]);
        $responseData = json_decode($response->getBody()->getContents());

        $this->assertEquals("success", $responseData->status);

    }

    /**
     * Test show task list
     *
     * @return void
     */
    public function testListSuccess() {
        $response = $this->client->get('/task');
        $responseData = json_decode($response->getBody()->getContents());

        $this->assertGreaterThanOrEqual(1, count($responseData));
    }
}