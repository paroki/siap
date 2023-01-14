Feature:
  In order to login into SIAP
  As a user
  I should able to update my password

  Background:
    Given I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"

  Scenario: Update User Password
    Given I have logged in as paroki admin
    And I send a POST request to '/user/update-password' with body:
    """
    {
      "newPassword": "newpassword",
      "oldPassword": "password"
    }
    """
    Then the response status code should be 200