<?php

namespace App\Controller;


use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DeleteStudentController extends Controller
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/student/{id}", name="delete_student", methods={"DELETE"})
     */
    public function __invoke($id)
    {
        $response = new JsonResponse();

        $student = $this->em->getRepository( Student::class )->find( $id );
         if ($student != null) {
             $student = $this->em->remove( $student );
             $this->em->flush();
         }

        else{
        $response->setContent( 'Student is not exist' );
        $response->setStatusCode( 404 );
    }

        return $response;
    }
}