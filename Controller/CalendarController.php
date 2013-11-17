<?php

namespace ADesigns\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use ADesigns\CalendarBundle\Event\CalendarEvent;

class CalendarController extends Controller
{
    /**
     * Dispatch a CalendarEvent and return a JSON Response of any events returned.
     * 
     * @param Request $request
     * @return Response
     */
    public function loadCalendarAction(Request $request)
    {
        $startDatetime = new \DateTime();
        $startDatetime->setTimestamp($request->get('start'));
        
        $endDatetime = new \DateTime();
        $endDatetime->setTimestamp($request->get('end'));
        
        $events = $this->container->get('event_dispatcher')->dispatch(CalendarEvent::CONFIGURE, new CalendarEvent($startDatetime, $endDatetime, $request))->getEvents();
        
        $response = new \Symfony\Component\HttpFoundation\Response();
        $response->headers->set('Content-Type', 'application/json');
        
        $return_events = array();
        
        foreach($events as $event) {
            $return_events[] = $event->toArray();    
        }
        
        $response->setContent(json_encode($return_events));
        
        return $response;
    }
}
