<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/categorie")
 */
class CategorieController extends AbstractController
{
    /**
     * @Route("/afficher", name="app_categorie_index", methods={"GET"})
     */
  public function index(CategorieRepository $categorieRepository): Response
    {
        
        return $this->render('categorie/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }

/*
    public function index(CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll();

        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }
*/


    /**
     * @Route("/ajouter", name="app_categorie_new", methods={"GET", "POST"})
     */
    public function new(Request $request,CategorieRepository $categorieRepository): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorieRepository->add($categorie, true);

            return $this->redirectToRoute('app_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie/new.html.twig', [
            'categorie' => $categorie,
            'form' => $form,
        ]);
    }

    
    #[Route('/{id}', name: 'app_categorie_show')]
    public function showByCategory(Categorie $categorie, ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findBy(['categorie' => $categorie]);

        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
            'produits' => $produits,
        ]);
    }

    #[Route('/{nom}', name: 'app_categorie_show_by_name')]
    public function showByCategoryName($nom, CategorieRepository $categorieRepository, ProduitRepository $produitRepository): Response
    {
        $categorie = $categorieRepository->findOneByNom($nom);

        if (!$categorie) {
            throw $this->createNotFoundException('Category not found');
        }

        $produits = $produitRepository->findBy(['categorie' => $categorie]);

        return $this->render('categorie/show_cnom.html.twig', [
            'categorie' => $categorie,
            'produits' => $produits,
        ]);
    }






    /**
     * @Route("/modifier/{id}", name="app_categorie_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Categorie $categorie, CategorieRepository $categorieRepository): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorieRepository->add($categorie, true);

            return $this->redirectToRoute('app_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie/edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_categorie_delete", methods={"POST"})
     */
    public function delete(Request $request, Categorie $categorie, CategorieRepository $categorieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorie->getId(), $request->request->get('_token'))) {
            $categorieRepository->remove($categorie, true);
        }

        return $this->redirectToRoute('app_categorie_index', [], Response::HTTP_SEE_OTHER);
    }

    //---------------------------------------------------------------------

    /**
     * @Route("/{id}", name="produit_par_categorie", methods={"GET"})
     */

    public function produit_par_categorie(Categorie $categorie, ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findBy(['categorie' => $categorie]);
        return $this->render('categorie/produit_par_categorie.html', [
            'categorie' => $categorie,
            'produits' => $produits,
        ]);
    }

    /**
     * @Route("/{id}/liste-par-categorie/{categorie}/", name="liste-par-categorie", methods={"GET"})
     */
    public function listByGenre(CategorieRepository $livreRepository, $genre): Response
    {
        $livres =  $livreRepository->findByGenre($genre);

        return $this->render('livre/chercher.html.twig', [
            'livres' => $livres,
        ]);
    }
  
}
