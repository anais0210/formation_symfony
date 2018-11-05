<?php

namespace App\Controller;

use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class UpdateStudentController extends Controller
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/student", name="update-student")
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
        $this->em->getRepository( Student::class )->find($data['id']);

        if ($student == null) {
            return $this->redirectionErreur404();
        }
        $student = new Student();
        $birthdate = new \DateTime( $data['birthdate'] );
        $student = setId($id);
        $student = setLastname($lastname);
        $student = setFirstname($firstname);
        $student = setBirthdate($birthdate);
        $em->persist( $student );
        $em->flush();
    }

    public function redirectionErreur404()
    {
        header( "HTTP/1.0 404 Not Found" );
        $response->setStatusCode( 404 );
    }
}
