Feature: Event API administration
    In order to check available cycling events
    As an API user
    I need to be able to GET JSON collection of all available events

    Scenario: List available events
        Given there are 6 events
        And I am on "/event"
        Then I should see 6 events

#    Scenario: Add a new event
#        Given I am on "/event"
#        When I click "Add new"
#        And I fill "Event name" with "Promaja trail"
#        And I click "Save"
#        Then I should see "Added new product"

