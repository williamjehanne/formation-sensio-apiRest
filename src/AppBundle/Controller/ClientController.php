<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use AppBundle\Form\Type\ClientFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
    public function updateAction(Client $client,Request $request)
    {

        // Creation d'un formulaire de type clientform
        $form = $this->createForm(new ClientFormType(),$client,["method"=>"PUT"]); //si on ne met pas l'objet $client c'est un ajout sinon modification
        $form->handleRequest($request);// on parse les données du formulaire

        if ($form->isValid())//check des infos du formulaire
        {
            $client = $form->getData();//on enregistre les infos du form dans l'objet client

            $entityManager = $this->getDoctrine()->getManager(); // recup du manager doctrine
            $entityManager->persist($client); // enregistrement des donnes en transaction
            $entityManager->flush(); // commit de la transaction

            return $client; // on renvoi le client modifié


        }

        return $form;// fosrest va refaire une validation du form et si pas valid => renvoi des erreurs formatées
    }
}