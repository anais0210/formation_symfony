<?php

namespace Tests\Controller;

class UpdateStudentControllerTest extends ControllerTestCase
{
		public function testUpdateStudentSuccessfully() 
	{ 
		$lastname = 'Benoit';
		$firstname = 'Shauni';
		$birthdate = '1997-04-10';
		$id = 'a4645b62-d088-11e8-a8d5-f2801f1b9fd1';

		$response = $this->client->put('/student', [ 'json' => [ 'id' => $id, 'lastname' => $lastname, 'firstname' => $firstname, 'birthdate' => $birthdate] ]);

		$this->assertEquals(200, $response->getStatusCode());
	}

	public function testUpdateStudentWhenJsonIsInvalid() 
	{
		$response = $this->client->put('/student', ['exceptions' => FALSE, 'body' => '{"JSon invalid: "paul","firstname": "string", "birthdate": "2015-04-01", "id": "a4645b62-d088-11e8-a8d5-f2801f1b9fd1"}']);
		
		$this->assertEquals(400, $response->getStatusCode());
	}

	public function testUpdateStudentNotFound()
	{	
		$response = $this->client->put('/student', ['exceptions' => FALSE, 'body' => '{"id": "a4644de8-d088-11e8-a8d5-f2801f1b9fc1", "lastname": "paul","firstname": "string", "birthdate": "2015-04-01"}']);
		
		$this->assertEquals(404, $response->getStatusCode());
	}
}