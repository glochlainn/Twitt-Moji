<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\UserFixtures;
use App\Entity\Follow;
use App\Repository\UserRepository;

class FollowFixtures extends Fixture implements DependentFixtureInterface
{
    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function load(ObjectManager $manager)
    {
        $users = $this->userRepo->findAll();

        foreach ($users as $user) {
            $followsCount = rand(1, UserFixtures::USERS_NUMBER);

            for ($i = 0; $i < $followsCount; $i++) {
                if ($users[$i] !== $user) {
                    $follow = new Follow();
                    $follow->setFollower($user);
                    $follow->setFollowed($users[$i]);
                    
                    $manager->persist($follow);
                }
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
