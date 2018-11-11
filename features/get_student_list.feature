Feature:
  Feature for get list of student sucessfully

  Scenario: Get list of students
    When I send a GET request to "/student"
    # And print response
    Then the response status code should be 200