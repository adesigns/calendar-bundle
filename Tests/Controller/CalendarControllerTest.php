<?php
namespace ADesigns\CalendarBundle\Tests\Controller;

use ADesigns\CalendarBundle\Tests\Fixtures\EventListener\CalendarEventListener;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalendarControllerTest extends WebTestCase
{
    private $startTime;
    private $endTime;

    public function setUp() {
        parent::setUp();

        $this->startTime =  new \DateTime(CalendarEventListener::TEST_START_TIME);
        $this->endTime =  new \DateTime(CalendarEventListener::TEST_END_TIME);
    }

    public function testLoadCalendarEmptyAction()
    {
        $client = static::createClient();

        $client->request('GET', '/fc-load-events', array(
            'start' => $this->startTime->getTimestamp(),
            'end' => $this->startTime->getTimestamp()
        ));

        $this->assertEquals('[]', $client->getResponse()->getContent());
    }



    public function testLoadCalendarNotEmptyAction()
    {
        $client = static::createClient();

        $client->request('GET', '/fc-load-events', array(
            'start' => $this->startTime->getTimestamp(),
            'end' => $this->endTime->getTimestamp()
        ));

        $response = json_decode($client->getResponse()->getContent());

        $this->assertCount(1, $response);
        $this->assertNotEmpty($response[0]->title);
    }
}