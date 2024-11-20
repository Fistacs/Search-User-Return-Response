<?php

include_once 'dbConfig.php'; // Include the database configuration file

session_start(); // Start the session to access session variables

// Query to delete all records from the `applicants` table
$deleteApplicantsQuery = "DELETE FROM applicants";

// Query to reset the `AUTO_INCREMENT` value for the `applicants` table to 1
$resetApplicantsQuery = "ALTER TABLE applicants AUTO_INCREMENT = 1";

// Prepare the query to delete all applicants
$deleteStatement = $pdo->prepare($deleteApplicantsQuery);

// Prepare the query to reset the auto-increment value
$resetStatement = $pdo->prepare($resetApplicantsQuery);

// Execute the query to delete all records
$executeQuery = $deleteStatement->execute();

// Execute the query to reset the auto-increment value
$executeQuery = $resetStatement->execute();

// Check if both queries were executed successfully
if ($executeQuery) {
    header("Location: ../index.php"); // Redirect to the homepage after successful reset
    return true; // End the script
}

// Clear all session variables
session_unset();
