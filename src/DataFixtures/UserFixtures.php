<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Service\UserGeneratorApi;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserGeneratorApi $userGenerator;
    private UserPasswordHasherInterface $passwordHasher;

    public const USERS_NUMBER = 20;

    public function __construct(UserGeneratorApi $userGenerator, UserPasswordHasherInterface $passwordHasher)
    {
        $this->userGenerator = $userGenerator;
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $fakeUsers = $this->userGenerator->getManyUser(self::USERS_NUMBER);

        $user = new User();
        $user->setEmail('admin@twittmoji.com');
        $user->setUsername('admin');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $user->setAvatar('https://ih1.redbubble.net/image.376081801.6910/st,small,507x507-pad,600x600,f8f8f8.u2.jpg');
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('modo@twittmoji.com');
        $user->setUsername('modo');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'modo'));
        $user->setAvatar('https://res.cloudinary.com/leetchi/image/upload/c_fill,f_auto,fl_lossy,g_center,h_520,q_80,w_715/v1556055046/da6ca9ed-c6a9-4214-a32c-ac1fffbb9386.jpg');
        $user->setRoles(['ROLE_MODERATOR']);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('user@twittmoji.com');
        $user->setUsername('user');
        $user->setPassword($this->passwordHasher->hashPassword($user, '12345'));
        $manager->persist($user);

        foreach ($fakeUsers['results'] as $key => $fakeUser){
            $user = new User();
            $user->setEmail($fakeUser['email']);
            $user->setUsername($fakeUser['login']['username']);
            $user->setPassword($this->passwordHasher->hashPassword($user, '12345'));
            $user->setAvatar($fakeUser['picture']['large']);
            $manager->persist($user);
            $this->addReference('user_' . $key, $user);
        }

        $manager->flush();
    }
}
