<?php

namespace App\Controller;

use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ListStudentController extends Controller
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/student", name="list", methods={"GET"})
     */
    public function __invoke()
    {
        $students = $this->em->getRepository(
            Student::class
        )->findAll();

        $result = [];

        if (!empty($students)) {
            foreach ($students as $student) {
                $result[] = [
                    'id' => $student->getId(),
                    'lastname' => $student->getLastname(),
                    'firstname' => $student->getFirstname(),
                    'birthdate' => $student->getBirthdate()->format('Y-m-d'),
                ];
            }
        }

        return new JsonResponse($result);
    }
}
