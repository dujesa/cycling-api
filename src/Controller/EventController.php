<?php

namespace App\Controller;

use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriverBy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Panther\Client;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /**
     * @Route("/event", name="event")
     */
    public function index()
    {
        $client = Client::createChromeClient();
        $crawler = $client->request('GET', 'https://www.adriabike.hr/eventi/');

        $eventArticles = $crawler->filter('article');

        $events = [];
        /** @var RemoteWebElement $eventArticle */
        foreach ($eventArticles as $eventArticle) {
            $events[] = $eventArticle->findElement(WebDriverBy::className('title'))->getText();
        }

        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
            'events' => $events,
        ]);
    }
}
