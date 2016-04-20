<?php

namespace AppBundle\Service;

use AppBundle\Entity\Event;
use AppBundle\Entity\EventGroup;
use AppBundle\Entity\GroupGenre;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

/**
 * EventService
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class EventService
{
    /**
     * @var EntityManager $entityManager Entity manager
     */
    private $entityManager;

    /**
     * Constructor
     *
     * @param EntityManager $em Entity manager
     */
    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    /**
     * Find recommended concerts
     *
     * @param Event $event Event
     * @param User  $user  User
     *
     * @return []
     */
    public function findRecommendedConcerts(Event $event, User $user)
    {
        $eventRepository = $this->entityManager->getRepository('AppBundle:Event');
        $genreRepository = $this->entityManager->getRepository('AppBundle:Genre');
        $groupRepository = $this->entityManager->getRepository('AppBundle:Group');

        $eventGenres = [];
        $eventGroups = [];

        /** @var EventGroup $eventGroup */
        foreach ($event->getEventGroups()->getValues() as $eventGroup) {
            $groupGenres = $eventGroup->getGroup()->getGroupGenres();

            // Get groups from event
            $eventGroups[] = $eventGroup->getGroup();

            /** @var GroupGenre $groupGenre */
            foreach ($groupGenres as $groupGenre) {
                // Get genres from event
                $eventGenres[] = $groupGenre->getGenre();
            }
        }

        // Get user bookmarked genres and groups
        $userBookmarkedGenres = $genreRepository->findGenresByUser($user);
        $userBookmarkedGroups = $groupRepository->findGroupsByUser($user);

        // Combine event genres and groups with user bookmarked genres and groups
        $recommendedGenres = array_merge($userBookmarkedGenres, $eventGenres);
        $recommendedGroups = array_merge($userBookmarkedGroups, $eventGroups);

        $events = $eventRepository->findAllActiveByGenresAndGroupsWithLimit(
            $recommendedGenres,
            $recommendedGroups,
            Event::NUMBER
        );

        return $events;
    }

    /**
     * Find events by filter from request
     *
     * @param Request $request Request
     *
     * @return []
     */
    public function findEventsByFilter(Request $request)
    {
        $genre = $request->query->get('genre');
        $city  = $request->query->get('city');
        $date  = $request->query->get('date');

        return $this->entityManager->getRepository('AppBundle:Event')->findEventsByFilter($genre, $city, $date);
    }
}
