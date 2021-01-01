<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    const USERS = [
        'User_1' => [
            'mail' => 'contributor1@monsite.com',
            'role' => ['ROLE_CONTRIBUTOR'],
        'password' => 'contributor1password',
        ],
        'User_2' => [
            'mail' => 'admin1@monsite.com',
            'role' => ['ROLE_ADMIN'],
            'password' => 'admin1password',
        ],
        'User_3' => [
            'mail' => 'contributor2@monsite.com',
            'role' => ['ROLE_CONTRIBUTOR'],
            'password' => 'contributor2password',
        ],
        'User_4' => [
            'mail' => 'admin2@monsite.com',
            'role' => ['ROLE_ADMIN'],
            'password' => 'admin2password',
        ],
    ];

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::USERS as $userKey => $userData){
            $user = new User();
            $user->setEmail($userData['mail']);
            $user->setRoles($userData['role']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $userData['password']
            ));

            $manager->persist($user);
            $this->addReference($userKey, $user);
        }
        $manager->flush();
    }
}
