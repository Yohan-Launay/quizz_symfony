<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
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


    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('dashboard/movie', name: 'app_movie')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $movie= new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $movie->setCreatedAt(New DateTime);
            $movie->setUpdatedAt(New DateTime);
            $entityManager->persist($movie);
            $entityManager->flush();
            return $this->redirectToRoute('app_movie');
        }

        $params['movies'] = $this->movieRepository->findAll();
        $params['movie_form'] = $form->createView();

        return $this->render('dashboard/movie/movie.html.twig', $params);
    }
}
