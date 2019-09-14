<?php

namespace App\Controller;

use App\Message\EventsImport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class ImportController extends AbstractController
{
    /**
     * @Route("/import-events", name="import-events")
     *
     * @param MessageBusInterface $bus
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function importEvents(MessageBusInterface $bus)
    {
        $importUrl = 'https://www.adriabike.hr/eventi/';

        $bus->dispatch(new EventsImport($importUrl, new \DateTime()));

        return $this->render('import/events.html.twig', [
            'controller_name' => 'EventControllerOld',
            'message' => 'Import of events from ' . $importUrl . ' has been started.',
        ]);
    }
}
