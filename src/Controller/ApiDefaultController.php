<?php

namespace Pog\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiDefaultController extends Controller
{
    /**
     * @Route("/api")
     */
    public function indexAction()
    {
        return new JsonResponse([
            'status' => 'OK',
        ], JsonResponse::HTTP_OK);
    }
}
