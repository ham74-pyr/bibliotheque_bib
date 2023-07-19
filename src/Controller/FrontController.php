<?php

namespace App\Controller; // App = src

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController // héritage
{

    /**
     * commentaire
     * 127.0.0.1:8000 en local
     * www.nomdedomaine.fr en ligne
     * 
     * Annotation :
     * 
     * @Route("/testing", name="testName")
     * @IsGranted("ROLE_ADMIN", message="interdit")
     * 
     * Attribut : (uniquement SF6)
     * 
     * #[Route('', name:'')]
     * 
     * 1e argument : Route (URL)
     * 2e argument : Nom de la route (Redirection)
     * 
     * Différence entre annotation et attribut
     * annotation ==> "" et =
     * attribut   ==> '' et : 
     */
    public function test(): Response
    {
        /*
            La méthode render() provenant de la class AbstractController permet de relier une route à une vue

            1e argument obligatoire (str) : nom du template (fichier html.twig) avec son emplacement
            la méthode render() se positionne à la racine du dossier templates

            2e argulent facultatif (array) : tableau des données à véhiculer sur le template
        */
        return $this->render('front/test.html.twig', []);
    }


    /** 
     * Page principale du site 
     * 
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('front/home.html.twig');
    }
} // RIEN EN DESSOUS
