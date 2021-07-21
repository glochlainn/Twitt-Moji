<?php

namespace App\Controller;

use App\Repository\TweetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(TweetRepository $tweetRepository): Response
    {
        $tweets = $tweetRepository->findBy([], [
            'tweeted_at' => 'DESC'
        ]);

        return $this->render('home/index.html.twig', [
            'tweets' => $tweets,
        ]);
    }
}
