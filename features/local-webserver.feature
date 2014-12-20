Feature: Local webserver runs automatically
  In order to test and develop more quickly
  As a developer
  I should not have to remember to run my local webserver when executing tests

  Scenario: Running the server locally
    When my context connects to the local webserver
    Then I should receive some content