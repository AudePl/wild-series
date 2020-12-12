<?php

namespace App\DataFixtures;


use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        'Walking Dead' => [
            'summary' => 'Le policier Rick Grimes se réveille après un long coma. Il découvre avec effarement que le monde, ravagé par une épidémie, est envahi par les morts-vivants.',
            'category' => 'Horreur',
            'country' => 'USA',
            'year' => '2010',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BZmFlMTA0MmUtNWVmOC00ZmE1LWFmMDYtZTJhYjJhNGVjYTU5XkEyXkFqcGdeQXVyMTAzMDM4MjM0._V1_.jpg',
        ],
        'The Haunting Of Hill House' => [
            'summary' => 'Plusieurs frères et sœurs qui, enfants, ont grandi dans la demeure qui allait devenir la maison hantée la plus célèbre des États-Unis, sont contraints de se réunir pour finalement affronter les fantômes de leur passé.',
            'category' => 'Horreur',
            'country' => 'USA',
            'year' => '2010',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BMTU4NzA4MDEwNF5BMl5BanBnXkFtZTgwMTQxODYzNjM@._V1_SY1000_CR0,0,674,1000_AL_.jpg',
        ],
        'The Mandalorian' => [
            'summary' => 'Après les histoires de Jango et Boba Fett, un autre guerrier émerge dans l\'univers de Star Wars. Le Mandalorien se situe après la chute de l\'Empire et avant l\'émergence du Premier Ordre. Nous suivons les aventures du chasseur de primes isolé dans la bordure extérieure de la galaxie, loin de l\'autorité de la Nouvelle République.',
            'category' => 'Science-fiction',
            'country' => 'USA',
            'year' => '2010',
            'poster' => 'https://koubadvd.com/wp-content/uploads/2019/12/The-Mandalorian-Season-1-DVD-Cover-670x944.jpg',
        ],
        'Game of throne' => [
            'summary' => 'Il y a très longtemps, à une époque oubliée, une force a détruit l\'équilibre des saisons. Dans un pays où l\'été peut durer plusieurs années et l\'hiver toute une vie, des forces sinistres et surnaturelles se pressent aux portes du Royaume des Sept Couronnes. La confrérie de la Garde de Nuit, protégeant le Royaume de toute créature pouvant provenir d\'au-delà du Mur protecteur, n\'a plus les ressources nécessaires pour assurer la sécurité de tous. Après un été de dix années, un hiver rigoureux s\'abat sur le Royaume avec la promesse d\'un avenir des plus sombres. Pendant ce temps, complots et rivalités se jouent sur le continent pour s\'emparer du Trône de Fer, le symbole du pouvoir absolu.',
            'category' => 'Fantastique',
            'country' => 'USA',
            'year' => '2010',
            'poster' => 'https://images-na.ssl-images-amazon.com/images/I/91DjGXn7jXL._AC_SL1500_.jpg',
        ],
        'The Big Bang Theory' => [
            'summary' => 'Que se passe-t-il quand les très intelligents colocataires Sheldon et Leonard rencontrent Penny, une beauté libre d\'esprit qui emménage la porte d\'à côté, et réalisent qu\'ils ne connaissent presque rien de la vie hors de leur laboratoire. Leur bande d\'amis est complétée par le mielleux Wolowitz, qui pense être aussi sexy que futé, et Koothrappali, qui est incapable de parler en présence de femmes.',
            'category' => 'Comédie',
            'country' => 'USA',
            'year' => '2010',
            'poster' => 'https://images-na.ssl-images-amazon.com/images/I/914vdcKgugL.jpg',
        ],
        'Lucifer' => [
            'summary' => 'Lassé et mécontent de sa position de \"Seigneur des Enfers\", Lucifer Morningstar démissionne et abandonne le trône de son royaume pour la bouillonnante et non moins impure Los Angeles. Dans la Cité des anges, l\'ex maître diabolique est le patron d\'un nightclub baptisé \"Lux\". Quand une star de la Pop est sauvagement assassinée sous ses yeux, il décide de partir à la recherche du coupable et croise sur sa route Chloe Decker, une femme flic qui résiste à ses charmes et lui met constamment des bâtons dans les roues.\r\n\r\nAlors que l\'improbable duo s\'entraide pour venir à bout de l\'enquête, l\'ange Amenadiel est envoyé à Los Angeles par Dieu pour tenter de convaincre Lucifer de regagner son royaume. L\'ancien Seigneur des Enfers cèdera-t-il aux sirènes du Mal qui l\'appellent ou se laissera-t-il tenter par le Bien, vers lequel l\'inspecteur Chloe Decker semble peu à peu l\'amener ?',
            'category' => 'Policier',
            'country' => 'USA',
            'year' => '2010',
            'poster' => 'https://media.melty.fr/article-4189644-ajust_1200/media.jpg',
        ],
    ];

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $title => $data){

            $program = new Program();
            $program->setTitle($title);
            $program->setSummary($data['summary']);
            $program->setCountry($data['country']);
            $program->setYear($data['year']);
            $program->setCategory($this->getReference($data['category']));
            $program->setPoster($data['poster']);

            $manager->persist($program);
            $this->addReference($title, $program);
        }
        $manager->flush();
    }
}
