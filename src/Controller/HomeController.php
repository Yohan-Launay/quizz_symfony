<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{

    /**
     * @var MovieRepository
     */
    private MovieRepository $movieRepository;

    /**
     * @param MovieRepository $movieRepository
     */
    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    #[Route('/', name: 'app_login')]
    public function index(Request $request, EntityManagerInterface $manager, AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_dashboard');
        }

        // get the login error if there is one
        $params['error'] = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $params['last_username'] = $authenticationUtils->getLastUsername();
        $params['movies'] = $this->movieRepository->findAll();
        return $this->render('common/index.html.twig', $params);


//        return $this->render('common/index.html.twig', $params);
    }
}
