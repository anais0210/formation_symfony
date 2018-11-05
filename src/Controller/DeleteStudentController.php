<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository;

class DeleteStudentController extends Controller
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/student/{id}", name="delete")
     */
    public function __invoke()
    {
        $response = new JsonResponse();

        try {
            $this->em->getRepository( Student::class )->find( $this->getParameters( ['id'] ) );
        } catch ( \Exception $e ) {
            $response->setContent( $e->getMessage() );
            $response->setStatusCode( 404 );
        }

        return $response;
    }
}
