Feature:
  In order to use SIAP
  As a user
  I should able to login into application
  Background:
    Given I add "Accept" header equal to "application/json"
    And I have user with email "test@example.com" and password "password"

  Scenario: User Login
    When I am sign in with email "test@example.com" and password "password"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node token should exist
    And the JSON node token should not be null

  Scenario: Login with invalid password
    When I am sign in with email "test@example.com" and password "invalid"
    Then the response status code should be 401
    And the response should be in JSON
    And the JSON nodes should contain:
    | code    | 401                  |
    | message | Invalid credentials. |

  Scenario: Login with invalid username
    When I am sign in with email "foo@example.com" and password "password"
    Then the response status code should be 401
    And the response should be in JSON
    And the JSON nodes should contain:
      | code    | 401                  |
      | message | Invalid credentials. |

