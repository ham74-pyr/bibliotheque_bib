<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profil")
 */
class ProfilController extends AbstractController
{
    /**
     * @Route("", name="app_profil")
     */
    public function index(): Response
    {
        $user = $this->getUser(); // utilisateur connecté
        
        //dd($user);
        return $this->render('profil/index.html.twig', []);
    }
}
