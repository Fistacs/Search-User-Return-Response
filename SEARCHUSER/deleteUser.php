<?php 

    // Include the database configuration file and functions/models file
    require_once 'core/dbConfig.php';
    require_once 'core/models.php';

    // Check if 'applicant_id' is passed as a query parameter in the URL
    if (isset($_GET['applicant_id'])) {
        // Retrieve the 'applicant_id' from the URL
        $applicant_id = $_GET['applicant_id'];

        // Fetch the applicant's details by their ID from the database
        $getApplicantByID = getApplicantByID($pdo, $applicant_id);
    } else {
        // If 'applicant_id' is not provided, show an error message and stop the script
        echo "No owner specified for deletion.";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Applicant</title>
</head>
<body>
    <!-- Page header -->
    <h1>Imus Specialize Hospital Job Application System</h1>

    <!-- Display a confirmation message with the applicant's name -->
    <h2 style="color: red">Are you sure you want to delete applicant <?php echo $getApplicantByID['lname'] . ", " . $getApplicantByID['fname']; ?>?</h2>

    <!-- Form to confirm the deletion of the applicant -->
    <form action="core/handleForms.php" method="POST">
        <!-- Hidden field to pass the 'applicant_id' securely to the server -->
        <input type="hidden" name="applicant_id" value="<?php echo htmlspecialchars($applicant_id); ?>">

        <!-- Submit button to confirm deletion -->
        <input type="submit" value="Submit" name="deleteApplicantBtn">
    </form>
</body>
</html>
