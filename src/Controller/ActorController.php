<?php


namespace App\Controller;

use App\Entity\Actor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @Route("/actors", name="actor_")
 */class ActorController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index():Response
    {
        $actors = $this->getDoctrine()
            ->getRepository(Actor::class)
            ->findAll();
        return $this->render('actor/index.html.twig', [
            'actors' => $actors
        ]);
    }

    /**
     * @Route("/{id<\d+>}", methods={"GET"}, name="show")
     */
    public function show(Actor $actor):Response
    {
        if (!$actor) {
            throw $this->createNotFoundException(
                'No actor with this id found in actor\'s table.'
            );
        }
        dump($actor);
        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
        ]);
    }

}