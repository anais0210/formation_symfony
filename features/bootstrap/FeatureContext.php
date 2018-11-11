<?php

use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Testwork\Hook\Scope\BeforeSuiteScope;
use Tests\DatabaseTest;

/**
 * This context class contains the definitions of the steps used by the demo
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 *
 * @see http://behat.org/en/latest/quick_start.html
 */
class FeatureContext implements Context
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var Response|null
     */
    private $response;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @BeforeScenario
     */
    public function prepare()
    {
        $this->buildSchema();
    }

    protected function buildSchema()
    {
        $metadata = $this->getMetaData();

        if (!empty($metadata)) {
            $tool  = new \Doctrine\ORM\Tools\SchemaTool($this->getEntityManager());
            $tool->dropDatabase($metadata);
            $tool->createSchema($metadata);
            $this->loadFixture();
        }
    }

    protected function getMetadata(){
        return $this->getEntityManager()->getMetadataFactory()->getAllMetadata();
    }

    protected function getEntityManager(){
        return $this->kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

    protected function loadFixture()
    {
        $databaseTest = new DatabaseTest($this->getEntityManager());
        $databaseTest->insertData();
    }
}


