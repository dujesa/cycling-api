<?php

declare(strict_types=1);

namespace App\Message;

use Doctrine\Common\Collections\ArrayCollection;

class EventsImport
{
    /**
     * @var ArrayCollection
     */
    private $events;

    public function __construct(array $events)
    {
        $this->events = new ArrayCollection($events);
    }

    /**
     * @return ArrayCollection
     */
    public function getEvents(): ArrayCollection
    {
        return $this->events;
    }
}
