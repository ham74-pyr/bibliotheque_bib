<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/cart', name: 'cart_')]
class CartController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    
    public function index(SessionInterface $session, ProduitRepository $produitRepository): Response
    {
        $panier = $session->get('panier', []);

        //on "fabrique" les données
        $dataPanier = [];
        $total = 0;

        foreach ($panier as $id => $quantite) {
            $produit = $produitRepository->find($id);
            $dataPanier[] = [
                "produit" => $produit,
                "quantite" => $quantite
            ];
            $total += $produit->getPrix() * $quantite;
        }
        return $this->render('cart/index.html.twig', compact("dataPanier","total"));
    }

    /**
     * @Route("/add/{id}", name="add")
     */
    public function add($id, Produit $produit, SessionInterface $session)
    {
        $panier = $session->get('panier', []);
        $id = $produit->getId();

        if (!is_array($panier)) {
            $panier = []; // Initialize an empty array if $panier is not already an array
        }
        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }
        $session->set("panier", $panier);
        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove($id, Produit $produit, SessionInterface $session)
    {
        $panier = $session->get('panier', []);
        $id = $produit->getId();

        if (!is_array($panier)) {
            $panier = []; // Initialize an empty array if $panier is not already an array
        }

        if (!empty($panier[$id])) { 
                if ($panier[$id] > 1) {
                    $panier[$id]--;
                } else {     
                unset($panier[$id]);
            }       
        }
        $session->set("panier", $panier);
        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete($id, Produit $produit, SessionInterface $session)
    {
        // On récupère le panier actuel
        $panier = $session->get('panier', []);
        $id = $produit->getId();

        
        if (!is_array($panier)) {
            $panier = []; // Initialize an empty array if $panier is not already an array
        }
        if (!empty($panier[$id])) {
            unset($panier[$id]);
            }
        //On savegarde dans la session
        $session->set("panier", $panier);
        return $this->redirectToRoute("cart_index");
        }

    

    /**
     * @Route("/delete", name="delete_all")
     */
    public function deleteAll(SessionInterface $session)
    {
        $panier = $session->get('panier', []);
        
            $session->remove("panier");
            return $this->redirectToRoute("cart_index");
    }   

}
