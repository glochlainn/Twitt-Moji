<?php

namespace App\DataFixtures;

use App\Entity\Tweet;
use DateTimeImmutable;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TweetFixtures extends Fixture implements DependentFixtureInterface
{
    private const TWEETS = [
        [
            'content' => '😀♾️🧨🎍🥽'
        ],
        [
            'content' => '🥼🚩'
        ],
        [
            'content' => '🗣️👨‍🦰🐐🤡'
        ],
        [
            'content' => '😎♿🐑'
        ],
        [
            'content' => '🥶🤦‍♂️🥥🥟🏖️🦧'
        ],
    ];

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < UserFixtures::USERS_NUMBER; $i++) {
            $tweets = self::TWEETS[array_rand(self::TWEETS)];
            $help = new Tweet();
            $help->setContent($tweets['content']);
            $help->setTweetedAt(new DateTimeImmutable());
            $help->setUser($this->getReference('user_' . $i));
            $manager->persist($help);
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