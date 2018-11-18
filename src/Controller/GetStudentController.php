<?php

namespace App\Controller;

use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class GetStudentController extends Controller
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/student/{id}", name="student_id", methods={"GET"})
     */
    public function __invoke($id)
    {
        /** @var Student $student */
        $student = $this->em->getRepository( Student::class )->find( $id );
        if ($student == null) {

            return new JsonResponse( 'User not found.', 404 );
        }

        $birthdate = new \DateTime();

        $result = [];
        $result['id'] = $student->getId();
        $result['lastname'] = $student->getLastname();
        $result['firstname'] = $student->getFirstname();
        $result['birthdate'] = $student->getBirthdate()->format('Y-m-d');

        return new JsonResponse($result);
    }
}
