<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Entity\Event;
use App\Factory\EventFactory;
use App\Message\EventsImport;
use Doctrine\ORM\EntityManagerInterface;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriverBy;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Panther\Client;

class EventsImportHandler implements MessageHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var EventFactory
     */
    private $eventFactory;

    public function __construct(EntityManagerInterface $entityManager, EventFactory $eventFactory)
    {
        $this->entityManager = $entityManager;
        $this->eventFactory = $eventFactory;
    }

    /**
     * @param EventsImport $message
     *
     * @throws \Exception
     */
    public function __invoke(EventsImport $message)
    {
        $client = Client::createChromeClient();
        $crawler = $client->request('GET', $message->getImportUrl());

        $eventArticles = $crawler->filter('article');

        /** @var RemoteWebElement $eventArticle */
        foreach ($eventArticles as $eventArticle) {
            $eventName = $eventArticle->findElement(WebDriverBy::className('title'))->getText();
            $eventDuration = $eventArticle->findElement(WebDriverBy::className('date'))->getText();
            $eventLocation = $eventArticle->findElement(WebDriverBy::className('location'))->getText();

            /** @var Event $importedEvent */
            $importedEvent = $this->eventFactory->create(
                $eventName,
                $eventDuration,
                $eventLocation,
                $message->getImportRequestTime()
            );

            $this->entityManager->persist($importedEvent);
        }

        $this->entityManager->flush();
    }
}
