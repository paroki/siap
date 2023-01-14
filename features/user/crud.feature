Feature:
  In order to manage user access
  As an admin
  I should be able to create, read, update, and delete user data

  Background:
    Given I add Accept header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I have logged in as paroki admin
    And I have user with email "exist@example.com"
    And I have user with email "delete@example.com"

  Scenario: Create new user
    Given I don't have user with email "new@example.com"
    When I send a POST request to "/users" with body:
    """
    {
      "email": "new@example.com",
      "plainPassword": "password"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON

  Scenario: Read existing user
    Given I send a GET request for user "exist@example.com"
    Then the response status code should be 200