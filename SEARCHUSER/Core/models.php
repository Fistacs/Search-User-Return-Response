<?php

require_once 'dbConfig.php'; // Include the database configuration file

// Adds a doctor applicant to the database
function addApplicant($pdo, $fname, $lname, $specialization) {
    // Check if the applicant already exists in the database
    $checkUserSQL = "SELECT * FROM applicants WHERE fname = ? AND lname = ?";
    $statement = $pdo->prepare($checkUserSQL);
    $statement->execute([$fname, $lname]);

    // If no matching applicant is found, insert the new applicant
    if ($statement->rowCount() == 0) {
        $addUserSQL = "INSERT INTO applicants (fname, lname, specialization) VALUES (?, ?, ?)";
        $statement = $pdo->prepare($addUserSQL);
        $executeQuery = $statement->execute([$fname, $lname, $specialization]);

        // If insertion is successful, return a success message
        if ($executeQuery) {
            $_SESSION['message'] = "Applicant successfully registered!";
            $_SESSION['code'] = 200;
            return true;
        } else {
            // If insertion fails, set an error message
            $_SESSION['message'] = "Applicant registration failed!";
            $_SESSION['code'] = 400;
        }
    } else {
        // If the applicant already exists, set an appropriate error message
        $_SESSION['message'] = "User already exists!";
        $_SESSION['code'] = 400;
    }
}

// Retrieve all registered applicants from the database
function getApplicants($pdo) {
    $getQuery = "SELECT * FROM applicants"; // Query to fetch all applicants
    $statement = $pdo->prepare($getQuery);
    $executeQuery = $statement->execute();

    // Return the results as an array if the query executes successfully
    if ($executeQuery) {
        return $statement->fetchAll();
    }
}

// Retrieve a specific applicant by their ID
function getApplicantByID($pdo, $applicant_id) {
    $query = "SELECT * FROM applicants WHERE applicant_id = ?"; // Query to fetch an applicant by ID
    $statement = $pdo->prepare($query);
    $executeQuery = $statement->execute([$applicant_id]);

    // Return the result as an associative array if the query executes successfully
    if ($executeQuery) {
        return $statement->fetch();
    }
}

// Update an applicant's information in the database
function updateApplicants($pdo, $fname, $lname, $specialization, $applicant_id) {
    $query = "UPDATE applicants
              SET fname = ?,
                  lname = ?,
                  specialization = ?
              WHERE applicant_id = ?"; // Query to update applicant details

    $statement = $pdo->prepare($query);
    $executeQuery = $statement->execute([
        $fname,
        $lname,
        $specialization,
        $applicant_id
    ]);

    // Return true if the update is successful
    if ($executeQuery) {
        return true;
    }
}

// Delete an applicant from the database
function deleteApplicant($pdo, $applicant_id) {
    $query = "DELETE FROM applicants WHERE applicant_id = ?"; // Query to delete an applicant by ID
    $statement = $pdo->prepare($query);
    $executeQuery = $statement->execute([$applicant_id]);

    // Return true if the deletion is successful
    if ($executeQuery) {
        return true;
    }
}

// Search for applicants in the database based on input criteria
function searchApplicant($pdo, $search) {
    $query = "SELECT * FROM applicants WHERE fname LIKE ? OR lname LIKE ? OR specialization LIKE ?"; 
    // Query to search for applicants by name or specialization
    $statement = $pdo->prepare($query);
    $executeQuery = $statement->execute(["%$search%", "%$search%", "%$search%"]); // Use wildcards for partial matches

    // Return the search results if the query executes successfully
    if ($executeQuery) {
        $searchResults = $statement->fetchAll();
        return $searchResults;
    } else {
        // Print an error message if the query fails
        echo "Failed to search applicant";
    }
}
