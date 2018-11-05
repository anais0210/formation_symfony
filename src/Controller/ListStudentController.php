<?php

namespace App\Controller;

use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ListStudentController extends Controller
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/student", name="list")
     */
    public function __invoke()
    {
        $result = $this->em->getRepository(
            Student::class
        )->findAll();
        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
