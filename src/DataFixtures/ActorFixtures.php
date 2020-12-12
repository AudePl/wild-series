<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use  Faker;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    const ACTORS = [
        'name1' => [
            'Lucifer',
        ],
        'name2' => [
            'Game of throne',
            'The Mandalorian',
        ],
        'name3' => [
            'The Big Bang Theory',
            'The Haunting Of Hill House',
        ],
        'name4' => [
            'Walking Dead',
            'The Haunting Of Hill House',
            'The Mandalorian',
            'Game of throne',
            'The Big Bang Theory',
            'Lucifer',
        ],
        'name5' => [
            'The Big Bang Theory',
            'Lucifer',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::ACTORS as $name => $actorData) {
            $faker = Faker\Factory::create('en_US');
            $name = $faker->name;
            $actor = new Actor();
            $actor->setName($name);
            foreach ($actorData as $actorPrograms) {
                $actor->addProgram($this->getReference($actorPrograms));
            }
            $manager->persist($actor);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }
}
