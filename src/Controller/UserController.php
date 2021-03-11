<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private UserRepository $userRepository ;
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository ;
    }

    /**
     * @Route ("/" , name="app_home" )
     * @return Response
     */
    public function index() : Response {
        $user = $this->userRepository->findAll() ;
       return  $this->render('user/home.html.twig', [
            'user' => $user
        ]) ;
    }

    /**
     * @Route("/user/{id}", name="user_profile" , methods={"GET","POST"}, requirements={"id"="\d+"})
     * @ParamConverter("id", class="App\Entity\User", options={"id": "id"})
     * @param User $user
     * @return Response
     */
    public function profile(User $user): Response
    {

        return $this->render('user/profile.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/user/{id}/contacter" , name="user_contacter" )
     */
    public function contacter() {


        return $this->render('user/contacter.html.twig');
    }
}
