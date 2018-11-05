<?php

namespace Tests\Controller;


use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Test\DatabaseTest;

class ControllerTestCase extends KernelTestCase
{
    protected $client;

	protected function setUp()
    {
        $kernel = static::bootKernel();
           $em =  $kernel->getContainer()->get('doctrine.orm.entity_manager');
            $databaseTest = new DatabaseTest($em);

        $databaseTest->deleteDatabase();
        $databaseTest->insertData();

        $this->client = new Client([
            'base_uri' => 'http://nginx'
        ]);
    }
}