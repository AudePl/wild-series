<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODES = [
        'episod_1' => [
            'season_identifier' => 'Season_1',
            'title' => 'Au commencement',
            'number' => 1,
            'synopsis' => 'Lassé et mécontent de sa position de "Seigneur des Enfers", Lucifer Morningstar démissionne et abandonne le trône de son royaume pour la bouillonnante et non moins impure Los Angeles. Dans la Cité des anges, l\'ex maître diabolique est le patron d\'un nightclub baptisé "Lux". Quand une star de la Pop est sauvagement assassinée sous ses yeux, il décide de partir à la recherche du coupable et croise sur sa route Chloe Dancer, une femme flic qui résiste à ses charmes et lui met constamment des bâtons dans les roues.',
        ],
        'episod_2' => [
            'season_identifier' => 'Season_2' ,
            'title' => 'Maman où t\'es ?',
            'number' => 1,
            'synopsis' => 'Lucifer est distrait par l\'évasion de sa mère des Enfers alors que Chloe et lui enquêtent sur le meurtre d\'une actrice. Pendant ce temps, la confiance de Chloe en Lucifer est mise à l\'épreuve par la nouvelle médecin légiste, Ella. Enfin, Amenadiel espère pousser Lucifer du mauvais côté alors que tous deux doivent gérer l\'absence de Maze.',
        ],
        'episod_3' => [
            'season_identifier' => 'Season_3',
            'title' => 'Chapitre 1 : Le Mandalorien',
            'number' => 1,
            'synopsis' => 'Un chasseur de primes mandalorien traque un objectif pour un mystérieux et fortuné client.',
        ],
        'episod_4' => [
            'season_identifier' => 'Season_4' ,
            'title' => 'Chapitre 9 : Le Marshal',
            'number' => 1,
            'synopsis' => 'Décidé à ramener l\'Enfant à son peuple, le Mandalorien se rend dans la Bordure Extérieure, à la recherche de ses semblables...',
        ],
    ];

    private $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::EPISODES as $key => $episodeData){
            $episode = new Episode();
            $episode->setTitle($episodeData['title']);
            $episode->setNumber($episodeData['number']);
            $episode->setSynopsis($episodeData['synopsis']);
            $episode->setSeason($this->getReference($episodeData['season_identifier']));

            $slug = $this->slugify->generate($episodeData['title']);
            $episode->setSlug($slug);

            $manager->persist($episode);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }


}
