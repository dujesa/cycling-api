<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private $events = [];

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given there are :quantity events
     */
    public function thereAreEvents($quantity)
    {
        if ($quantity <= 0) {
            return;
        }

        while ($quantity > 0) {
            $this->events[] = 'event'.$quantity;
            $quantity--;
        }
    }

    /**
     * @Then I should see :quantity events
     */
    public function iShouldSeeEvents($quantity)
    {
        if (count($this->events) != $quantity) {
            throw new Exception('There are '.count($this->events).' events, but '.$quantity.' events were expected.');
        }
    }

    /**
     * @When I click :button
     */
    public function iClick($button)
    {
        throw new PendingException();
    }

    /**
     * @When I fill :arg1 with :arg2
     */
    public function iFillWith($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then I should see :name
     */
    public function iShouldSee($name)
    {
        throw new PendingException();
    }
}
