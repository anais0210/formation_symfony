<?php

namespace App\Controller;

use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CreateStudentController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/", name="create-student")
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
        $student = setLastname($lastname);
        $student = setFirstname($firstname);
        $student = setBirthdate($birthdate);
        $em->persist( $student );
        $em->flush();

        $response->setStatusCode( 201 );

        return $response;
    }
}
