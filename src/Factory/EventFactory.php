<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Event;
use Assert\Assertion;

class EventFactory
{
    /**
     * @param $eventName
     * @param $eventDuration
     * @param $eventLocation
     * @param $eventImportRequestTime
     * @return Event
     *
     * @throws \Exception
     */
    public function create($eventName, $eventDuration, $eventLocation, $eventImportRequestTime): Event
    {
        $eventDates = explode(' - ', $eventDuration);
        $eventStartDate = new \DateTime($eventDates[0]);
        $eventEndDate = new \DateTime($eventDates[1]);

        $importedEvent = new Event();
        $importedEvent->setName($eventName);
        $importedEvent->setStartDate($eventStartDate);
        $importedEvent->setEndDate($eventEndDate);
        $importedEvent->setLocation($eventLocation);
        $importedEvent->setImportedAt($eventImportRequestTime);

        return $importedEvent;
    }
}
