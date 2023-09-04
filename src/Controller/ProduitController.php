<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * préfixe
 * @Route("/admin/produit")
 */
class ProduitController extends AbstractController
{
    /*
        ProduitController contiendra toutes les routes du CRUD de l'entity Produit
        CRUD :       Create         Read       Update     Delete
        Réquêtes :   INSERT INTO    SELECT     UPDATE     DELETE
        --------------------------------

        Route : /produit/modifier
        Nom de la route : produit_modifier
        Nom de la fonction : produit_modifier()
        Vue : produit/  produit_modifier.html.twig

        héritage / block h1  et body / 
        
    */


    /**
     * c'est le R du CRUD (SELECT)
     * 
     * @Route("/afficher", name="produit_afficher")
     */
    public function produit_afficher(ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findAll();
        /*
            findAll() ==> SELECT * FROM produit
            Cette méthode retourne un tableau d'objets issus de l'entity Produit

            find($id) ==> SELECT * FROM produit WHERE id = $id
            Cette méthode retourne un objet issu de l'entity Produit ou null

            l'entity Produit est la table Produit
            les objets issus de l'entity Produit sont les données de la table Produit
        */
        return $this->render('produit/produit_afficher.html.twig', [
            'produits' => $produits
        ]);
    }




    /**
     * c'est le C du CRUD (INSERT INTO)
     * @Route("/ajouter", name="produit_ajouter")
     */
    public function produit_ajouter(Request $request, ProduitRepository $produitRepository): Response
    {
        $produit = new Produit();
        /*
            Pour créer un formulaire, on utilise la méthode createForm() provenant de la class AbstractController
            1e argument obligatoire : class contenant le $builder
            2e argument : objet issu de l'entity qui a créé également le formulaireType

            le $builder et l'objet sont tous les deux issu de l'entity donc on retrouve les mêmes termes
            dans le formulaire : élements titre prix description 
            dabs l'objet : propriétés titre prix description

            ils sont "superposés" c'est à dire que lorsque l'utilisateur va saisir le titre du produit, on pourra le retrouver à la propriété titre de l'objet

            Ce qui est généré par la méthode createForm est un objet ($form)
        */
        $form = $this->createForm(ProduitType::class, $produit);

        // traitement du formulaire 
        $form->handleRequest($request);

        // si le formulaire a été soumis (submit)
        // si le formulaire a été validé (respect des contraintes)
        if ($form->isSubmitted() and $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            /*
                si $imageFile = null alors pas d'upload
                si $imageFile retourne un objet issu de la class UploadedFile alors il faut rentrer dans la condition et faire le traitement de l'image
            */
            if ($imageFile) {
                // 1e : renommer l'image
                $nomImage = date('YmdHis') . '-' . uniqid() . '.' . $imageFile->getClientOriginalExtension();

                //dd($nomImage);

                // 2e : enregistrer l'image
                // la méthode move() prend 2 arguments :
                // 1e : emplacement
                // 2e : le nom que prendra le fichier
                $imageFile->move(
                    $this->getParameter('image'),
                    $nomImage
                );

                // 3e : enregistrer le nom de l'image dans l'objet produit
                $produit->setImage($nomImage);
            }

            $produit->setCreatedAt(new \DateTimeImmutable('now'));

            // Insertion en bdd (méthodes add() ou save() )
            $produitRepository->add($produit, true);

            // notification
            $this->addFlash('success', 'Le produit a bien été ajouté');

            // redirection (équivalent de la fonction twig path())
            return $this->redirectToRoute('produit_afficher');
        }

        return $this->render('produit/produit_ajouter.html.twig', [
            'formProduit' => $form->createView()
        ]);
    }

    /**
     * @Route("/details/{id}", name="produit_details")
     */
    public function produit_details(Produit $produit, CacheManager $imagineCacheManager): Response
    {
        return $this->render('produit/produit_details.html.twig', [
            'produit' => $produit
        ]);
    }



    /**
     * c'est le U du CRUD (UPDATE)
     * @Route("/modifier/{id}", name="produit_modifier")
     */
    public function produit_modifier(Produit $produit, Request $request, ProduitRepository $produitRepository): Response
    {
        //dd($produit);
        $form = $this->createForm(ProduitType::class, $produit);

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {

            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $nomImage = date('YmdHis') . '-' . uniqid() . '.' . $imageFile->getClientOriginalExtension();

                $imageFile->move(
                    $this->getParameter('image'),
                    $nomImage
                );

                if ($produit->getImage()) {
                    unlink($this->getParameter('image') . '/' . $produit->getImage());
                }

                $produit->setImage($nomImage);
            }

            $produit->setUpdatedAt(new \DateTime('now'));
            $produitRepository->add($produit, true);
            $this->addFlash('success', 'Le produit a bien été modifié');
            return $this->redirectToRoute('produit_afficher');
        }

        return $this->render('produit/produit_modifier.html.twig', [
            'formProduit' => $form->createView()
        ]);
    }


    /**
     * c'est le D du CRUD (DELETE)
     * @Route("/supprimer/{id}", name="produit_supprimer")
     */
    public function produit_supprimer(Produit $produit, ProduitRepository $produitRepository): Response
    {
        if ($produit->getImage()) {
            unlink($this->getParameter('image') . '/' . $produit->getImage());
        }

        $produitRepository->remove($produit, true);
        return $this->redirectToRoute('produit_afficher');
    }


    



} // FERMETURE DE LA CLASS
