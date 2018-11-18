<?php

namespace App\Controller;

use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CreateStudentController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/student", name="create-student", methods={"POST"})
     */
    public function __invoke()
    {
        $response = new JsonResponse();
        $errors = [];

        $json = file_get_contents( 'php://input' );
        $data = json_decode( $json, true );

        if (json_last_error() !== 0) {
            $response->setContent( 'Erreur dans ton JSON' );
            $response->setStatusCode( 400 );

            return $response;
        }

        if (!array_key_exists( 'lastname', $data )) {
            $errors[] = 'missing lastname';
        }

        if (!array_key_exists( 'firstname', $data )) {
            $errors[] = 'missing firstname';
        }
        if (!array_key_exists( 'birthdate', $data )) {
            $errors[] = 'missing birthdate';
        }

        if (!empty( $errors )) {
            return new JsonResponse( $errors, 400 );
        }

        $student = new Student();

        $birthdate = new \DateTime( $data['birthdate'] );

        $student->setLastname( $data['lastname'] );
        $student->setFirstname( $data['firstname'] );
        $student->setBirthdate( $birthdate );

        $this->em->persist( $student );
        $this->em->flush();

        $response->setStatusCode( 201 );

        return $response;
    }
}
