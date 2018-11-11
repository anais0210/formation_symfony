Feature:
Feature for create a student

  Scenario: Create a Student success
    When I send a POST request to "/student" with body:
    """
      {"lastname": "Anais", "firstname": "Cambon", "birthdate": "1887-12-12"}
      """
    Then the response status code should be 201
    And the response should be in JSON


  Scenario: Create student is failed besause lastName is missing
    When I send a POST request to "/student" with body:
      """
      {"firstname": "Cambon", "birthdate": "1987-12-12"}
      """
    Then the response status code should be 400
    And the response should be in JSON

  Scenario: Create student Json is inValid
    When I send a POST request to "/student" with body:
      """
      {"lastname: "Anais", "firstname": "Cambon", ""birthdate": "1987-12-12"}
      """
    Then the response status code should be 400