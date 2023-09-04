<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogueController extends AbstractController
{
    #[Route('/catalogue', name: 'app_catalogue')]
    public function index(ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findAll();

        return $this->render('catalogue/index.html.twig', [
            
            'produits' => $produits
        ]);
    }


    #[Route('/catalogue/catalogue1', name: 'app_catalogue1')]
    public function index1(ProduitRepository $produitRepository): Response
    {
        $categorieNom = 'categorie.nom'; // Replace with the actual category name
        $produits = $produitRepository->findBy(['categorie' => $categorieNom]);

        return $this->render('catalogue/index.html.twig', [
            'produits' => $produits
        ]);
    }

    



    #[Route('/catalogue/catalogue_show/{id}', name: 'catalogue_show')]
    public function show(ProduitRepository $produitRepository, $id): Response
    {
        $produit = $produitRepository->find($id);
        return $this->render('catalogue/catalogue_show.html.twig', [
            
            'produit' => $produit
        ]);
    }

    



}
