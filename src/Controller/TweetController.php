<?php

namespace App\Controller;

use App\Entity\Tweet;
use App\Form\TweetType;
use App\Repository\TweetRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tweet")
 */
class TweetController extends AbstractController
{
    /**
     * @Route("/nouveau", name="tweet_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tweet = new Tweet();
        $form = $this->createForm(TweetType::class, $tweet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $tweet->setUser($this->getUser());
            $tweet->setTweetedAt(new DateTimeImmutable());
            $entityManager->persist($tweet);
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tweet/new.html.twig', [
            'tweet' => $tweet,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="tweet_show", methods={"GET"})
     */
    public function show(Tweet $tweet): Response
    {
        return $this->render('tweet/show.html.twig', [
            'tweet' => $tweet,
        ]);
    }

    /**
     * @Route("/{id}", name="tweet_delete", methods={"POST"})
     */
    public function delete(Request $request, Tweet $tweet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tweet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tweet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }
}
