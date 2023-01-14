Feature:
  In order to manage paroki
  As an admin
  I should able to create, read, update, and delete paroki data

  Background:
    Given I add Accept header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I have logged in as paroki admin
    And I have paroki with kode "999.999" and nama "Kristus Raja"

  Scenario: Create new Paroki
    Given I don't have paroki "New Paroki"
    When I send a POST request to "/api/paroki" with body:
    """
    {
      "kode": "099.001",
      "nama": "New Paroki",
      "gereja": "Kristus Raja",
      "alamat": "alamat",
      "kota": "Kutai Barat",
      "telepon": "000",
      "fax": "000",
      "website": "http://example.com",
      "email": "email@example.com",
      "pastorParoki": "P. Testing MSF",
      "wilayahKeuskupan": "Mahakam Ulu"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the JSON node id should not be null

  Scenario: Read existing paroki
    When I send a GET request to paroki "Kristus Raja"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node "kode" should be equal to "999.999"
    And the JSON node "nama" should be equal to "Kristus Raja"
    And the JSON node "gereja" should be equal to "Kristus Raja"

  Scenario: Update existing paroki
    When I send a PUT request to paroki "Kristus Raja" with body:
    """
    {
      "alamat": "alamat",
      "kota": "Kutai Barat",
      "telepon": "000",
      "fax": "000",
      "website": "http://example.com",
      "email": "email@example.com",
      "pastorParoki": "P. Testing MSF",
      "wilayahKeuskupan": "Mahakam Ulu"
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node "kode" should be equal to "999.999"
    And the JSON node "nama" should be equal to "Kristus Raja"
    And the JSON node "gereja" should be equal to "Kristus Raja"
    And the JSON node "fax" should be equal to "000"

  Scenario: Delete existing paroki
    When I send a DELETE request to paroki "Kristus Raja"
    Then the response status code should be 204