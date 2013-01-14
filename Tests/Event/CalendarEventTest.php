<?php

namespace ADesigns\CalendarBundle\Tests\Event;

class CalendarEventTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $beginDatetime = new \DateTime('2012-01-01 00:00:00');
        $endDatetime = new \DateTime('2012-05-01 00:00:00');
        
        $calendarEvent = $this->getMockBuilder('ADesigns\CalendarBundle\Event\CalendarEvent')
            ->setConstructorArgs(array($beginDatetime, $endDatetime))
            ->setMethods(null)
            ->getMock();
            
        $this->assertEquals($calendarEvent->getStartDatetime()->format('Y-m-d H:i:s'), "2012-01-01 00:00:00");
        $this->assertEquals($calendarEvent->getEndDatetime()->format('Y-m-d H:i:s'), "2012-05-01 00:00:00");
            
    }
    
    public function testAddEvent()
    {
        $beginDatetime = new \DateTime('2012-01-01 00:00:00');
        $endDatetime = new \DateTime('2012-05-01 00:00:00');
        
        $eventTitle = "Test Title 1";
        
        $eventEntityMock = $this->getMockBuilder('ADesigns\CalendarBundle\Entity\EventEntity')
            ->setConstructorArgs(array($eventTitle, $beginDatetime, $endDatetime))
            ->setMethods(null)
            ->getMock();   
            
        $calendarEventMock = $this->getMockBuilder('ADesigns\CalendarBundle\Event\CalendarEvent')
            ->setConstructorArgs(array($beginDatetime, $endDatetime))
            ->setMethods(null)
            ->getMock();
            
        $calendarEventMock->addEvent($eventEntityMock);
         
        $this->assertCount(1, $calendarEventMock->getEvents());
        
        //test no duplicates
        $calendarEventMock->addEvent($eventEntityMock);        
        $this->assertCount(1, $calendarEventMock->getEvents());            
    }
}
