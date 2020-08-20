<?php

namespace FrontOfficeBundle\Controller;

use BackOfficeBundle\Entity\Feedback;
use BackOfficeBundle\Entity\PostLike;
use BackOfficeBundle\Entity\ProductMagasin;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface as aa;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class PanierController extends Controller
{


    public function AddtocartAction(ProductMagasin $productMagasin)
    {
        $found = false;
        $session = new Session();
        $panier = $session->get('produitsPanier');
        //$tab = [];
        $produitsPanier = [];
        $qte = 1;

        if (!isset($panier)) {
            $session->start();


            $produitsPanier[] = array($productMagasin->getId(), $qte);
            //$user_id = $request->get('user_id');
            //$session->set('panier', true);
            $session->set('produitsPanier', $produitsPanier);
        } else {


            $prodid = $productMagasin->getId();


            $produitsPanier = $session->get('produitsPanier');

            for ($i = 0; $i < count($produitsPanier); $i++) {


                if ($produitsPanier[$i][0] == $prodid) {
                    $produitsPanier[$i][1] = $produitsPanier[$i][1] + 1;
                    $found = true;
                }
            }

            if ($found == false) {
                $produitsPanier[] = array($productMagasin->getId(), $qte);

            }

            $session->set('produitsPanier', $produitsPanier);

            //$tab = $produitsPanier;
        }


        return $this->json([
            "code" => 200,
            'message' => 'produit bien ajoute',
            "produitsPanier" => $produitsPanier,
        ], 200);


        /*
               ///CLEAR ATTRIVUTES FOR TEST PURPUSE xD
               session_destroy();

                return $this->json([
                    "code"=>200,
                    'message'=>'seession deestroyed bien ajoute',
                ],200);*/
    }

    public function deletefromcartAction(ProductMagasin $productMagasin)
    {

        $session = new Session();
        //$panier = $session->get('panier');
        $produitsPanier = $session->get('produitsPanier');
        $prodid = $productMagasin->getId();


        if (isset($produitsPanier)){
            if (count($produitsPanier) != 0) {
                for ($i = 0; $i < count($produitsPanier); $i++) {
                    if ($produitsPanier[$i][0] == $prodid) {
                        unset($produitsPanier[$i]);
                        $produitsPanier = array_values($produitsPanier);
                    }
                }
            }else {
                //$session->remove('produitsPanier');
                session_destroy();
            }



            //array_values($produitsPanier);
            $session->set('produitsPanier', $produitsPanier);

            return $this->json([
                "code" => 200,
                'message' => 'produit bien supprimer',
                "produitsPanier" => $produitsPanier,
            ], 200);
        }
        else{
            return $this->json([
                "code" => 200,
                'message' => 'Panier inexistance',
                "produitsPanier" => $produitsPanier,
            ], 200);

        }

    }

    public function getSessionPanierAction()
    {
        $session = new Session();
        //$panier = $session->get('panier');
        $produitsPanier = $session->get('produitsPanier');
        //$prodid=$productMagasin->getId();
        $Produits = [];
        $qte = [];
        $repository = $this->getDoctrine()->getRepository(ProductMagasin::class);
        if (isset($produitsPanier)) {
            for ($i = 0; $i < count($produitsPanier); $i++) {
                $Produits[] = $repository->find($produitsPanier[$i][0]);
                $qte[] = $produitsPanier[$i][1];
            }
        }
        $ser = new Serializer(array(new ObjectNormalizer()));
        $data = $ser->normalize($Produits);

        return $this->json([
            "produitsPanier" => $produitsPanier,
            "prods" => $data,
            "qts" => $qte,
        ], 200);
    }

    public function SessionDEAction()
    {
        session_destroy();

        return $this->json([
            "code"=>200,
            'message'=>'seession deestroyed bien ajoute',
        ],200);
    }


}

