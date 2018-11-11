Feature:
Feature for update a student

  Scenario: Update a Student success
    When I send a PUT request to "/student" with body:
    """
      {"id": "a4645900-d088-11e8-a8d5-f2801f1b9fd1", "lastname": "Veronique", "firstname": "Michaud", "birthdate": "2010-09-12"}
      """
    Then the response status code should be 200
    And the response should be in JSON

  Scenario: Student is not found
    When I send a PUT request to "/student" with body:
      """
      {"id": "a4644de8-d088-11e8-a8d5-f2801f1b9fc1", "lastname": "Anais", "firstname": "Cambon", "birthdate": "1987-12-12"}
      """
    Then the response status code should be 404
    And the response should be in JSON

  Scenario: Json is inValid
    When I send a PUT request to "/student" with body:
      """
      {"id": "a4644de8-d088-11e8-a8d5-f2801f1b9fc1", "lastname: "Anais", "firstname": "Cambon", ""birthdate": "1987-12-12"}
      """
    Then the response status code should be 400