<?php
namespace ADesigns\CalendarBundle\Tests\Fixtures\EventListener;

use ADesigns\CalendarBundle\Entity\EventEntity;
use ADesigns\CalendarBundle\Event\CalendarEvent;

/**
 * Loads a fake event for testing purposes.
 *
 * @package ADesigns\CalendarBundle\Tests\Fixtures\EventListener
 */
class CalendarEventListener
{
    const TEST_START_TIME = "2016-01-15 13:00";
    const TEST_END_TIME = "2016-01-15 14:00";
    public function loadEvents(CalendarEvent $calendarEvent)
    {
        // these
        $startTime = new \DateTime(self::TEST_START_TIME);
        $endTime = new \DateTime(self::TEST_END_TIME);

        if ($calendarEvent->getStartDatetime()->getTimestamp() === $startTime->getTimestamp()
            && $calendarEvent->getEndDatetime()->getTimestamp() === $endTime->getTimestamp()) {
            $event = new EventEntity("Fake Event Title", new \DateTime(), null, true);
            $calendarEvent->addEvent($event);
        }

    }
}