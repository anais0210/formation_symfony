<?php

namespace App\Controller;

use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class UpdateStudentController extends Controller
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/student", name="update-student", methods={"PUT"})
     */
    public function __invoke()
    {
        $response = new JsonResponse();

        $json = file_get_contents( 'php://input' );
        $data = json_decode( $json, true );

        if (json_last_error() !== 0) {

            $response->setContent( 'Erreur dans ton JSON' );
            $response->setStatusCode( 400 );
            return $response;
        }

        if (!array_key_exists( 'id', $data )) {
            $response->setContent( 'Missing Id' );
            $response->setStatusCode( 400 );
            return $response;
        }

        if (!array_key_exists( 'lastname', $data )) {

            $response->setContent( 'Missing lastname' );
            $response->setStatusCode( 400 );
            return $response;
        }

        if (!array_key_exists( 'firstname', $data )) {
            $response->setContent( 'Missing firstname' );
            $response->setStatusCode( 400 );
            return $response;
        }

        if (!array_key_exists( 'birthdate', $data )) {
            $response->setContent( 'Missing birthdate' );
            $response->setStatusCode( 400 );
            return $response;
        }

        $birthdate = new \DateTime( $data['birthdate'] );
        $student = $this->em->getRepository( Student::class )->find($data['id']);

        if ($student == null) {
            return new JsonResponse( 'User not found.', 404 );
        }

        $birthdate = new \DateTime( $data['birthdate'] );

        $student->setLastname( $data['lastname'] );
        $student->setFirstname( $data['firstname'] );
        $student->setBirthdate( $birthdate );

        $this->em->flush();

        return new JsonResponse();
    }
}
