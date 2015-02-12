<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\JsonResponse;

class ClientController extends Controller
{
    /**
     * @Route("/clients", methods={"GET"})
     * @View
     */
    public function listAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $clientRepository = $entityManager->getRepository('AppBundle:Client');

        return $clientRepository->findAll();
    }

    /**
     * @Route("/clients/{id}", methods={"GET"})
     * @View
     */
    public function showAction(Client $client)
    {
        return $client;
    }

    /**
     * @Route("/clients/{id}", methods={"PUT"})
     * @View
     */
    public function updateAction(Client $client)
    {


        return $client;
    }
}