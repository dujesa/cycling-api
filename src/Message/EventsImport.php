<?php

declare(strict_types=1);

namespace App\Message;

use Doctrine\Common\Collections\ArrayCollection;

class EventsImport
{

    /**
     * @var string
     */
    private $importUrl;

    /**
     * @var \DateTime
     */
    private $importRequestTime;

    public function __construct(string $importUrl, \DateTime $importRequestTime)
    {
        $this->importUrl = $importUrl;
        $this->importRequestTime = $importRequestTime;
    }

    /**
     * @return string
     */
    public function getImportUrl(): string
    {
        return $this->importUrl;
    }

    /**
     * @return \DateTime
     */
    public function getImportRequestTime(): \DateTime
    {
        return $this->importRequestTime;
    }
}
