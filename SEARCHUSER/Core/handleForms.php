<?php

// Include necessary files for database configuration, model functions, and input validation
require_once 'dbConfig.php';
require_once 'models.php';
require_once 'validate.php';

// Handle the form submission to register a doctor applicant
if (isset($_POST['registerApplicantBtn'])) {
    // Sanitize user inputs to prevent security vulnerabilities
    $fname = sanitizeInput($_POST['fname']);          // First name of the applicant
    $lname = sanitizeInput($_POST['lname']);          // Last name of the applicant
    $specialization = sanitizeInput($_POST['specialization']); // Specialization of the applicant

    // Check if all required fields are filled
    if (!empty($fname) && !empty($lname) && !empty($specialization)) {
        // Call the function to add the applicant to the database
        $addUserQuery = addApplicant($pdo, $fname, $lname, $specialization);

        // Redirect based on the success of the operation
        if ($addUserQuery) {
            header("Location: ../viewUser.php"); // Redirect to view applicants if successful
        } else {
            header("Location: ../index.php"); // Redirect to index page if failed
        }
    } else {
        // If fields are empty, set an error message and redirect back to the form
        $_SESSION['message'] = "Please don't leave out empty fields in the form!";
        $_SESSION['code'] = 400;
        header("Location: ../index.php");
    }
}

// Handle the form submission to update applicant information
if (isset($_POST['updateApplicantBtn'])) {
    // Call the function to update the applicant details
    $query = updateApplicants($pdo, $_POST['fname'], $_POST['lname'], $_POST['specialization'], $_POST['applicant_id']);

    // Set a session message based on the update operation's success
    if ($query) {
        $_SESSION['message'] = "Applicant information successfully updated!";
        $_SESSION['code'] = 200;
        header("Location: ../viewUser.php"); // Redirect to view applicants
    } else {
        $_SESSION['message'] = "Applicant information failed to update!";
        $_SESSION['code'] = 400;
    }

    exit(); // End the script to prevent further execution
}

// Handle the form submission to delete an applicant
if (isset($_POST['deleteApplicantBtn'])) {
    $applicant_id = $_POST['applicant_id']; // Get the applicant's ID to delete

    // Call the function to delete the applicant from the database
    $query = deleteApplicant($pdo, $applicant_id);

    // Set a session message based on the deletion operation's success
    if ($query) {
        $_SESSION['message'] = "Applicant successfully deleted!";
        $_SESSION['code'] = 200;
        header("Location: ../viewUser.php"); // Redirect to view applicants
    } else {
        $_SESSION['message'] = "Applicant unsuccessfully deleted!";
        $_SESSION['code'] = 400;
    }

    exit(); // End the script to prevent further execution
}

// Handle the form submission to search for an applicant
if (isset($_POST['searchQueryBtn'])) {
    $search = $_POST['search']; // Get the search query from the form

    // Call the function to search for applicants based on the query
    $searchResults = searchApplicant($pdo, $search);

    // Store the search results in the session to display them later
    $_SESSION['searchResults'] = $searchResults;

    header("Location: ../viewUser.php"); // Redirect to the view applicants page
    exit(); // End the script to prevent further execution
}
?>
