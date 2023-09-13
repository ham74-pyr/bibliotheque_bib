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

    #[Route('/catalogue/catalogue_show/{id}', name: 'catalogue_show')]
    public function show(ProduitRepository $produitRepository, $id): Response
    {
        $produit = $produitRepository->find($id);
        return $this->render('catalogue/catalogue_show.html.twig', [
            
            'produit' => $produit
        ]);
    }

        #[Route('/catalogue/catalogue1', name: 'app_catalogue1')]
    public function index1(ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findAll();
        return $this->render('catalogue/index1.html.twig', [
            'produits' => $produits
 
        ]);
    }

            #[Route('/catalogue/catalogue2', name: 'app_catalogue2')]
    public function index2(ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findAll();
        return $this->render('catalogue/index2.html.twig', [
            'produits' => $produits
 
        ]);
    }
    
    #[Route('/catalogue/catalogue3', name: 'app_catalogue3')]
    public function index3(ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findAll();
        return $this->render('catalogue/index3.html.twig', [
            'produits' => $produits
 
        ]);
    }

    #[Route('/catalogue/catalogue4', name: 'app_catalogue4')]
    public function index4(ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findAll();
        return $this->render('catalogue/index4.html.twig', [
            'produits' => $produits
 
        ]);
    }

    #[Route('/catalogue/catalogue5', name: 'app_catalogue5')]
    public function index5(ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findAll();
        return $this->render('catalogue/index5.html.twig', [
            'produits' => $produits
 
        ]);
    }

    #[Route('/catalogue/catalogue6', name: 'app_catalogue6')]
    public function index6(ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findAll();
        return $this->render('catalogue/index6.html.twig', [
            'produits' => $produits
 
        ]);
    }
    


}
