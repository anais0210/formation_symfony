<?php

namespace Tests\Controller;


class CreateStudentControllerTest extends ControllerTestCase
{

	public function testCreateStudentSuccessfully() 
	{ 
		$lastname = 'Anais';
		$firstname = 'Cambon';
		$birthdate = '1887-12-12';

		$response = $this->client->post('/student', [ 'exceptions' => FALSE, 'json' => [ 'lastname' => $lastname, 'firstname' => $firstname, 'birthdate' => $birthdate] ]);

		$this->assertEquals(201, $response->getStatusCode());
	}
 
 	public function testCreateStudentWhenJsonIsInvalid() 
	{
		$response = $this->client->post('/student', ['exceptions' => FALSE, 'body' => '{ "lastname: "paul","firstname": "string", "birthdate": "2015-04-01"}']);

		$this->assertEquals(400, $response->getStatusCode());
	}

	public function testCreateJsonIsValidAndLastNameIsMissing()
    {
        $firstname = 'Cambon';
        $birthdate = '1887-12-12';
        $response = $this->client->post('/student', ['exceptions' => FALSE, 'json' => [ 'firstname' => $firstname, 'birthdate' => $birthdate]]);


        $this->assertEquals(400, $response->getStatusCode());
    }
}