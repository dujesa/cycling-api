<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\EventsImport;
use Doctrine\ORM\EntityManager;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriverBy;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Panther\Client;

class EventsImportHandler implements MessageHandlerInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(EventsImport $message)
    {
        $client = Client::createChromeClient();
        $crawler = $client->request('GET', 'https://www.adriabike.hr/eventi/');

        $eventArticles = $crawler->filter('article');

        $events = [];
        /** @var RemoteWebElement $eventArticle */
        foreach ($eventArticles as $eventArticle) {
            $events[] = $eventArticle->findElement(WebDriverBy::className('title'))->getText();
        }

    }
}
