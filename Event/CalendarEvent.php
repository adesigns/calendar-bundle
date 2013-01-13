<?php

namespace ADesigns\CalendarBundle\Event;

use Symfony\Component\EventDispatcher\Event;

use ADesigns\CalendarBundle\Entity\EventEntity;

class CalendarEvent extends Event
{
    const CONFIGURE = 'calendar.load_events';

    private $startDatetime;
    
    private $endDatetime;
    
    private $events;
    
    public function __construct(\DateTime $start, \DateTime $end)
    {
        $this->startDatetime = $start;
        $this->endDatetime = $end;
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getEvents()
    {
        return $this->events;
    }
    
    public function addEvent(EventEntity $event)
    {
        //if (!$this->events->contains($event)) {
            $this->events[] = $event;
        //}
        
        return $this;
    }
    
    public function getStartDatetime()
    {
        return $this->startDatetime;
    }

    public function getEndDatetime()
    {
        return $this->endDatetime;
    }

}