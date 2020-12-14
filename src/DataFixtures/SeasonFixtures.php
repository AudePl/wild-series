<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SEASONS = [
        'Season_1' => [
            'program' => 'Lucifer',
            'number' => 1,
            'year' => 2016,
            'description' => 'Lucifer, seigneur des enfers, a quitté le royaume des ténèbres pour la Terre, et détient désormais un night-club à Los Angeles. Après le meurtre d\'une chanteuse devant son établissement, il décide de trouver le coupable. Dans sa quête, il fait la rencontre de Chloe Decker, une policière insensible à son pouvoir lui permettant de contraindre les gens à révéler leurs désirs les plus profonds. Alors qu’ils s’associent pour trouver le meurtrier, Dieu envoie l’ange Amenadiel sur Terre pour convaincre Lucifer de regagner son royaume. Lucifer retournera-t-il en Enfer ou continuera-t-il à faire le bien au côté de l’inspecteur Chloe Decker ?',
        ],
        'Season_2' => [
            'program' => 'Lucifer',
            'number' => 2,
            'year' => 2016,
            'description' => 'Persuadé que sa mère est revenue sur Terre pour le tuer, Lucifer fait abstraction de ses différends avec son frère pour qu’il l’aide à découvrir ce qu’elle complote et la renvoyer en Enfer. Pendant ce temps, Chloe commence à douter des véritables origines de Lucifer, tandis qu’Amenadiel perd peu à peu ses pouvoirs angéliques. En parallèle, Chloe, Dan et Lucifer sont confrontés à des tueurs en série qui empoisonnent des jeunes femmes et assassinent des stars.'
        ],
        'Season_3' => [
            'program' => 'The Mandalorian',
            'number' => 1,
            'year' => 2019,
            'description' => 'Après les aventures de Jango et Boba Fett, un nouveau héros émerge dans l\'univers Star Wars. L\'intrigue, située entre la chute de l\'Empire et l\'émergence du Premier Ordre, suit les voyages ...',
        ],
        'Season_4' => [
            'program' => 'The Mandalorian',
            'number' => 2,
            'year' => 2020,
            'description' => 'Le Mandalorien et l’Enfant poursuivent leur voyage, affrontant maints ennemis et rejoignant leurs alliés. Ils se frayent un chemin à travers une galaxie dangereuse, dans la tumultueuse période ...',
        ],
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::SEASONS as $key => $seasonData) {

            $season = new Season();
            $season->setProgram($this->getReference($seasonData['program']));
            $season->setNumber($seasonData['number']);
            $season->setYear($seasonData['year']);
            $season->setDescription($seasonData['description']);

            $manager->persist($season);
            $this->addReference($key, $season);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
            ];
    }


}
