CalendarBundle - jQuery fullcalendar bundle.
===============

This bundle allows you to integrate the [jQuery FullCalendar](http://arshaw.com/fullcalendar/) plugin into your Symfony2 application.

Once installed, this bundle will use event listeners to load events from any bundle in your application.

Installation
------------

Before installing, please note that this bundle has a dependency on the [FOSJsRouting](https://github.com/FriendsOfSymfony/FOSJsRoutingBundle) bundle to expose the calendar AJAX event loader route.

### Through Composer (Symfony 2.1+):

Add the following lines in your `composer.json` file:

``` js
"require": {
    "adesigns/calendar-bundle": "dev-master"
}
```

Run Composer to download and install the bundle:

    $ php composer.phar update adesigns/calendar-bundle

Register the bundle in `app/AppKernel.php`:

``` php
// app/AppKernel.php

public function registerBundles()
{
    return array(
        // ...
        new ADesigns\CalendarBundle\ADesignsCalendarBundle(),
    );
}
```

Register the routing in `app/config/routing.yml`:

``` yml
# app/config/routing.yml

adesigns_calendar:
  resource: "@ADesignsCalendarBundle/Resources/config/routing.xml"    
```

Publish assets:

    $ php app/console assets:install --symlink web
    
Usage
-----

Add the required stylesheet and javascripts to your layout:

Stylesheet:    
    `<link rel="stylesheet" href="{{ asset('bundles/adesignscalendar/css/fullcalendar/fullcalendar.css') }}" />`
    
Javascript:
    `<script type="text/javascript" src="{{ asset('bundles/adesignscalendar/js/fullcalendar/jquery.fullcalendar.min.js') }}"></script>`
    `<script type="text/javascript" src="{{ asset('bundles/adesignscalendar/js/calendar-settings.js') }}"></script>`
    
Then, in the template where you wish to display the calendar, add the following twig:

    {% include 'ADesignsCalendarBundle::calendar.html.twig' %}
    

Adding Events
-------------    

The best part about this bundle is that you can add events to the calendar from any part of your application.  The calendar loads events via AJAX, and dispatches an event to load calendar events from your application.

When a request is made to load events for a given start/end time, the bundle dispatches a `calendar.load_events` event.  Adding event listeners is an easy 2 step process

Create an Event Listener class in your bundle:

	<?php
	
	namespace Acme\DemoBundle\EventListener;
	
	use ADesigns\CalendarBundle\Event\CalendarEvent;
	use ADesigns\CalendarBundle\Entity\EventEntity;
	
	class CalendarEventListener
	{
	    public function loadEvents(CalendarEvent $calendarEvent)
	    {
	       	$title = "Meeting";
	       	$startDatetime = new \DateTime('2012-01-01 22:00:00');
	       	$endDatetime = new \DateTime('2012-01-01 23:00:00');
	       	
	        $eventEntity = new EventEntity($title, $startDatetime, $endDatetime);
	        $calendarEvent->addEvent($eventEntity);
	    }
	}

Additional properties and customization of each event on the calendar can be found in the Entity/EventEntity class.
	
Then, add the listener to your services:

    <service id="acme.demobundle.calendar_listener" class="Acme\DemoBundle\EventListener\CalendarEventListener">
        <tag name="kernel.event_listener" event="calendar.load_events" method="loadEvents" />
    </service>

And that's it!  When the `ADesignsCalendarBundle::calendar.html.twig` template is rendered, any events within the current month/day/year will be pulled from your application.

    