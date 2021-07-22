<?php

namespace App\DataFixtures;

use App\Entity\Tweet;
use DateTimeImmutable;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Generator;
use Faker\Factory;

class TweetFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

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

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < UserFixtures::USERS_NUMBER; $i++) {
            $tweets = self::TWEETS[array_rand(self::TWEETS)];
            $tweet = new Tweet();
            $tweet->setContent($tweets['content']);
            $tweet->setTweetedAt(DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-3 days', 'now')));
            $tweet->setUser($this->getReference('user_' . $i));
            $manager->persist($tweet);
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