Feature:
Feature for delete a student

  Scenario: Delete a Student success
    When I send a DELETE request to "/student/a4645900-d088-11e8-a8d5-f2801f1b9fd1" with body:
    """
      {"id": "a4645900-d088-11e8-a8d5-f2801f1b9fd1", "lastname": "Veronique", "firstname": "Michaud", "birthdate": "2010-09-12"}
      """
    Then the response status code should be 200
    And the response should be in JSON

  Scenario: Student is not found
    When I send a DELETE request to "/student/a4645900-d088-11e8-a8d5-f2801f1b9fc1" with body:
      """
      {"id": "a4645900-d088-11e8-a8d5-f2801f1b9fc1", "lastname": "Veronique", "firstname": "Michaud", "birthdate": "2010-09-12"}
      """
    Then the response status code should be 404
