<?php

namespace Tests\Controller;


use PHPUnit\Framework\TestCase;

class ListStudentControllerTest extends ControllerTestCase
{
	public function testListStudentSuccessFull()
	{
		$response = $this->client->get('/student', ['exceptions' => FALSE]);

		$this->assertEquals(200, $response->getStatusCode());
	}

	public function testListStudentContentTypeJsonIsValid()
	{
		$response = $this->client->get('/student');

        $contentType = $response->getHeaderLine('Content-Type');

        $this->assertEquals('application/json', $contentType);
		$this->assertEquals(200, $response->getStatusCode());
	}
}