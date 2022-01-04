<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{

    private $repo;

    public function __construct(UserRepository $userRepository)
    {
        $this->repo = $userRepository;
    }
    
    #[Route('/api/register', name: 'register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {

        $data = json_decode($request->getContent(), true);
        $email = $data['email'];
        $password = $data['password'];

        $user = new User();
        $user->setEmail($email);
        $user->setPassword(
            $passwordHasher->hashPassword($user, $password)
        );

        $this->repo->save($user);

        return new Response('User Created!' . PHP_EOL . $email);

       
    }

    #[Route('/api/list', name: 'list')]
    public function list(): Response
    {
       return new Response('you get the data');
    }
    


}
