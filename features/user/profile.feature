Feature:
  In order to use SIAP
  As a user
  I should able to update my profile

  Background:
    Given I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I have logged in with email "user@example.com" and password "password"

  Scenario: Update profile
    Given I send a POST request to "/profile" with body:
    """
    {
      "nama": "Test User",
      "telpon": "008"
    }
    """
    Then the response status code should be 200