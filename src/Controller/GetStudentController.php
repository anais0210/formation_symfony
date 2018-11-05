<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetStudentController extends Controller
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @Route("/student/{id}", name="get")
     */
    public function __invoke()
    {
        $this->em->getRepository( Student::class )->find($this->getParameters(['id']));
        if ($result == null) {

            return new JsonResponse('User not found.', 404);
        }

        return new JsonResponse($result);
    }
}
