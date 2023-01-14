Feature:
  In order to manage keuskupan
  As an admin
  I should able to create, read, update, and delete keuskupan data

  Background:
    Given I add Accept header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I have logged in as paroki admin
    And I have keuskupan with kode "100" and nama "Existing Keuskupan"

  Scenario: Create new Keuskupan
    Given I don't have keuskupan "New Keuskupan"
    When I send a POST request to "/keuskupan" with body:
    """
    {
      "kode": "099",
      "nama": "New Keuskupan",
      "nomor": 99,
      "namaLatin": "Nama Latin",
      "alamat": "alamat",
      "kota": "Kutai Barat",
      "telepon": "000",
      "fax": "000",
      "website": "http://example.com",
      "email": "email@example.com",
      "uskup": "Mgr. Testing"
    }
    """
    Then the response status code should be 201

  Scenario: Read existing keuskupan
    Given I send a GET request to keuskupan "Existing Keuskupan"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node kode should be equal to "100"

  Scenario: Update existing keuskupan
    Given I send a PUT request to keuskupan "Existing Keuskupan" with body:
    """
    {
      "kode": "100",
      "nama": "Existing Keuskupan",
      "alamat": "Test Alamat"
    }
    """
    Then the response status code should be 200
    And the JSON node alamat should be equal to "Test Alamat"

  Scenario: Delete existing keuskupan
    Given I send a DELETE request to keuskupan "Existing Keuskupan"
    Then the response status code should be 204