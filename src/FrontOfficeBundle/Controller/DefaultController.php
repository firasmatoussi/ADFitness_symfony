<?php

namespace FrontOfficeBundle\Controller;

use BackOfficeBundle\Entity\Feedback;
use BackOfficeBundle\Entity\Feedbacka;
use BackOfficeBundle\Entity\PostLike;
use BackOfficeBundle\Entity\Postlikea;
use BackOfficeBundle\Entity\ProductMagasin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface as aa;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class DefaultController extends Controller
{




    //public function __construct()
   // {



       // $eventDispatcher = $this->get('event_dispatcher');
        //$formFactory = $this->get('fos_user.registration.form.factory');
        //$userManager = $this->get('fos_user.user_manager');
        //parent::__construct($eventDispatcher, $formFactory, $userManager, \Symfony\Component\Security\Core\Authentication\Token\TokenInterface);

    //}

    public function indexAction()
    {

        $session = new Session();
        $panier = $session->get('panier');
        $produitsPanier = $session->get('produitsPanier');
        //$prodid=$productMagasin->getId();
        $Produits=[];
        $qte=[];
        $repository = $this->getDoctrine()->getRepository(ProductMagasin::class);
        if (isset($panier)) {
            for ($i = 0; $i < count($produitsPanier); $i++) {
                $Produits[] = $repository->find($produitsPanier[$i][0]);
                $qte[] = $produitsPanier[$i][1];
            }
        }



        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        //parent::registerAction($request);

        return $this->render('@FrontOffice/Default/Home.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
            'produitPanier' => $produitsPanier,
            'produits' => $Produits,
            'qte' => $qte,
        ));
    }

    public function getTokenAction()
    {
        return new Response($this->get('security.csrf.token_manager')->getToken('authenticate')->getValue());
    }

    public function coursAction()
    {
        $session = new Session();
        $panier = $session->get('panier');
        $produitsPanier = $session->get('produitsPanier');
        //$prodid=$productMagasin->getId();
        $Produits=[];
        $qte=[];
        $repository = $this->getDoctrine()->getRepository(ProductMagasin::class);
        if (isset($panier)) {
            for ($i = 0; $i < count($produitsPanier); $i++) {
                $Produits[] = $repository->find($produitsPanier[$i][0]);
                $qte[] = $produitsPanier[$i][1];
            }
        }


        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('@FrontOffice/AD-fitness/Cours.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
            'produitPanier' => $produitsPanier,
            'produits' => $Produits,
            'qte' => $qte,
        ));
    }
    public function eventAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('@FrontOffice/AD-fitness/Evenements.html.twig', array(
        'last_username' => $lastUsername,
        'error' => $error,
    ));
    }
    public function produitsAction()
    {
        $session = new Session();
        $panier = $session->get('panier');
        $produitsPanier = $session->get('produitsPanier');
        //$prodid=$productMagasin->getId();
        $Produits=[];
        $qte=[];
        $repository = $this->getDoctrine()->getRepository(ProductMagasin::class);
        if (isset($panier)) {
            for ($i = 0; $i < count($produitsPanier); $i++) {
                $Produits[] = $repository->find($produitsPanier[$i][0]);
                $qte[] = $produitsPanier[$i][1];
            }
        }

        $Produitss = $repository->findAll();
        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();



        $em = $this->getDoctrine()->getManager();

        $productMagasin = $em->getRepository('BackOfficeBundle:ProductMagasin')->findAll();

        return $this->render('@FrontOffice/AD-fitness/Produits.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
            'productMagasin' => $productMagasin,
            'produits' => $Produits,
            'qte' => $qte,
            'Produitss'=> $Produitss,
        ));
    }
    public function contactAction()
    {
        $session = new Session();
        $panier = $session->get('panier');
        $produitsPanier = $session->get('produitsPanier');
        //$prodid=$productMagasin->getId();
        $Produits=[];
        $qte=[];
        $repository = $this->getDoctrine()->getRepository(ProductMagasin::class);
        if (isset($panier)) {
            for ($i = 0; $i < count($produitsPanier); $i++) {
                $Produits[] = $repository->find($produitsPanier[$i][0]);
                $qte[] = $produitsPanier[$i][1];
            }
        }



        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('@FrontOffice/AD-fitness/Contact.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
            'produits' => $Produits,
            'qte' => $qte,
        ));
    }
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('@FrontOffice/AD-fitness/Login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }

    public function ProductListAction()
    {







        $session = new Session();
        $panier = $session->get('panier');
        $produitsPanier = $session->get('produitsPanier');
        //$prodid=$productMagasin->getId();
        $Produits=[];
        $qte=[];
        $repository = $this->getDoctrine()->getRepository(ProductMagasin::class);
        if (isset($panier)) {
            for ($i = 0; $i < count($produitsPanier); $i++) {
                $Produits[] = $repository->find($produitsPanier[$i][0]);
                $qte[] = $produitsPanier[$i][1];
            }
        }
        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        $em = $this->getDoctrine()->getManager();

        $productMagasins = $em->getRepository('BackOfficeBundle:ProductMagasin')->findAll();

        return $this->render('@FrontOffice/AD-fitness/ProduitsList.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
            'productMagasins' => $productMagasins,
            'produits' => $Produits,
            'qte' => $qte,
        ));
    }

    public function CartAction()
    {
        $session = new Session();
        $panier = $session->get('panier');
        $produitsPanier = $session->get('produitsPanier');
        //$prodid=$productMagasin->getId();
        $Produits=[];
        $qte=[];
        $repository = $this->getDoctrine()->getRepository(ProductMagasin::class);
        if (isset($panier)) {
            for ($i = 0; $i < count($produitsPanier); $i++) {
                $Produits[] = $repository->find($produitsPanier[$i][0]);
                $qte[] = $produitsPanier[$i][1];
            }
        }

        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('@FrontOffice/AD-fitness/Cart.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
            'produitPanier' => $produitsPanier,
            'produits' => $Produits,
            'qte' => $qte,
        ));

    }

    public function quickAction(ProductMagasin $productMagasin)
    {
        $session = new Session();
        $panier = $session->get('panier');
        $produitsPanier = $session->get('produitsPanier');
        //$prodid=$productMagasin->getId();
        $Produits=[];
        $qte=[];
        $repository = $this->getDoctrine()->getRepository(ProductMagasin::class);
        if (isset($panier)) {
            for ($i = 0; $i < count($produitsPanier); $i++) {
                $Produits[] = $repository->find($produitsPanier[$i][0]);
                $qte[] = $produitsPanier[$i][1];
            }
        }

        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $repository = $this->getDoctrine()->getRepository(Feedback::class);
        $repository1 = $this->getDoctrine()->getRepository(PostLike::class);
        //$Feedbacks = $repository->findAll();
        //$Feedbacks = $repository->findBy(
        // ['product' => '$productMagasin.']
        //);
        $prodid=$productMagasin->getId();
        $Feedbacks = $repository->findBy(
            ['product' => $prodid]
        );

        $likes = $repository1->findBy(
            ['product' => $prodid]
        );

        return $this->render('@FrontOffice/AD-fitness/quickview.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
            'productMagasin' => $productMagasin,
            'Feedbacks' => $Feedbacks,
            'likes' => $likes,
            'produits' => $Produits,
            'qte' => $qte,
        ));
    }

    public function feedAction(Request $request,ProductMagasin $productMagasin)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        if ($request->getMethod() == 'POST') {
            $review = $request->request->get('_review');
            $rating = $request->request->get('rating');
            $feedback=new Feedback();

            $user = $this->get('security.token_storage')->getToken()->getUser();
            $feedback->setRating($rating);
            $feedback->setFeedback($review);
            $feedback->setUser($user);
            $feedback->setProduct($productMagasin);

            $em = $this->getDoctrine()->getManager();
            $em->persist($feedback);
            $em->flush();
        }

        return $this->redirectToRoute('quick', array('id' => $productMagasin->getId(),'last_username' => $lastUsername,'error' => $error));

    }




    public function likeAction(Request $request,ProductMagasin $productMagasin)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $prodid=$productMagasin->getId();
        $repository1 = $this->getDoctrine()->getRepository(PostLike::class);
        $userid=$this->get('security.token_storage')->getToken()->getUser()->getId();
        $likes = $repository1->findOneBy(
            array('user' => $userid,'product' => $prodid)

        );
        $like123 = $repository1->findBy(
            ['product' => $prodid]
        );
        if ( empty($likes) ){

            $like=new PostLike();
            $like->setProduct($productMagasin);
            $like->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($like);
            $em->flush();
            return $this->json([
                "code"=>200,
                'message'=>'Like bien ajoute',
                "likes" => count($like123)
            ],200);

        }
        else  {
            $userid = $this->get('security.token_storage')->getToken()->getUser()->getId();
            $prodid=$productMagasin->getId();
            $repository1 = $this->getDoctrine()->getRepository(PostLike::class);
            $like = $repository1->findOneBy(
                array('product' => $prodid,'user' => $userid)
            );
            $em = $this->getDoctrine()->getManager();
            $em->remove($like);
            $em->flush();
            return $this->json([
                'code' =>"200",
                "message" => "like bien supprime",
                "likes" => count($like123)
            ],200);


        }

    }

    public function PaymntAction(){
        $stripeClient = $this->get('flosch.stripe.client');
        //$chargeAmount=$request->get('data-amount');
        $chargeAmount=$_POST['aaa'];
        //return $chargeAmount;
        $token = $_POST['stripeToken'];
        $stripeClient->createCharge($chargeAmount, "eur", $token, null, 0, "");
        //session_destroy();
        return $this->redirectToRoute('Cart');
    }

    public function ShowProductMAction(){

        $repository1 = $this->getDoctrine()->getRepository(ProductMagasin::class);
        $prods= $repository1->findAll();
        $ser = new Serializer(array(new ObjectNormalizer()));
        $data = $ser->normalize($prods);
        //dump($data);
        return $this->json(["prods" => $data],200);
    }

    public function AddProductMAction($name, $price, $quantity, $fabricationDate, $expirationDate, $amount, $cathegory, $storeid, $image, $description, $solde){
        $entityManager = $this->getDoctrine()->getManager();
        $product = new ProductMagasin($name, $price, $quantity, $fabricationDate, $expirationDate, $amount, $cathegory, $storeid, $image, $description, $solde,date("Y/m/d"));
        $entityManager->persist($product);
        $entityManager->flush();

        $ser = new Serializer(array(new ObjectNormalizer()));
        $data = $ser->normalize($product);
        //dump($data);
        return $this->json(["prods" => $data],200);
    }

    public function DeleteProductMAction($id){
        $repository1 = $this->getDoctrine()->getRepository(ProductMagasin::class);
        $prods= $repository1->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($prods);
        $em->flush();
        return $this->redirectToRoute('ShowProductsM');
    }

    public function UpdateProductMAction($id,$name, $price, $quantity, $fabricationDate, $expirationDate, $amount, $cathegory, $storeid, $image, $description, $solde){
        $repository1 = $this->getDoctrine()->getRepository(ProductMagasin::class);
        $prods= $repository1->find($id);
        $prods->setName($name);
        $prods->setPrice($price);
        $prods->setQuantity($quantity);
        $prods->setFabricationDate($fabricationDate);
        $prods->setExpirationDate($expirationDate);
        $prods->setAmount($amount);
        $prods->setCathegory($cathegory);
        $prods->setStoreid($storeid);
        $prods->setImage($image);
        $prods->setDescription($description);
        $prods->setSolde($solde);
        $prods->setDatAjout($prods->getDatAjout());
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('ShowProductsM');

    }


    public function likeaAction($idp,$idu)
    {

        $repository1 = $this->getDoctrine()->getRepository(PostLikea::class);
        $likes = $repository1->findOneBy(
            array('idu' => $idu,'idp' => $idp)
        );
        $like123 = $repository1->findBy(
            ['idp' => $idp]
        );
        if ( empty($likes) ){

            $like=new PostLikea();
            $like->setIdp($idp);
            $like->setIdu($idu);
            $em = $this->getDoctrine()->getManager();
            $em->persist($like);
            $em->flush();
            return $this->json([
                'message'=>'Like bien ajoute  ',
                "likes" => count($like123)+1
            ],200);

        }
        else  {

            $repository1 = $this->getDoctrine()->getRepository(PostLikea::class);
            $like = $repository1->findOneBy(
                array('idp' => $idp,'idu' => $idu)
            );
            $em = $this->getDoctrine()->getManager();
            $em->remove($like);
            $em->flush();
            return $this->json([
                "message" => "like bien supprime",
                "likes" => count($like123)-1
            ],200);


        }

    }

    public function feedaAction($idp,$idu,$rating,$feedback)
    {
        $feedback1=new FeedBacka();

        $feedback1->setIdp($idp);
        $feedback1->setIdu($idu);
        $feedback1->setRating($rating);
        $feedback1->setFeedback($feedback);

        $em = $this->getDoctrine()->getManager();
        $em->persist($feedback1);
        $em->flush();
        $ser = new Serializer(array(new ObjectNormalizer()));
        $data = $ser->normalize($feedback1);

        return $this->json([
            "feeds" => $data
        ],200);

    }

    /*public function feednumber($idp,$idu,$rating,$feedback){
        $repository1 = $this->getDoctrine()->getRepository(PostLikea::class);

        $feeds = $repository1->findOneBy(
            array('idu' => $idu,'idp' => $idp)
        );
        if ($feeds.
    }*/

}

