<?php

namespace App\Controller;

use App\Entity\Follow;
use App\Entity\User;
use App\Repository\FollowRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Flex\Path;

class FollowController extends AbstractController
{
    /**
     * @Route("/{user}/follow", name="follow")
     */
    public function switchFollow(User $user, FollowRepository $followRepository, EntityManagerInterface $em): Response
    {
        $follower = $this->getUser();

        $follow = $followRepository->findOneBy([
            'follower' => $follower,
            'followed' => $user
        ]);

        if ($follow == null) {
            $follow = new Follow();
            $follow->setFollower($follower);
            $follow->setFollowed($user);
            $em->persist($follow);
        } else {
            $follower->removeFollow($follow);
            $em->remove($follow);
        }

        $em->flush();

        return $this->redirectToRoute('profile', ['username' => $user->getUsername()]);
    }
}
