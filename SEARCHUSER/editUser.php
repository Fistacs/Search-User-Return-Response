<?php 

// Include necessary files for database connection, models, and form handling
require_once 'core/dbConfig.php';
require_once 'core/models.php';
require_once 'core/handleForms.php';

// Retrieve the 'applicant_id' from the URL
$applicant_id = $_GET['applicant_id'];

// Fetch the applicant's details by their ID from the database
$getApplicantByID = getApplicantByID($pdo, $applicant_id);

// Check if the applicant exists in the database
if (!$getApplicantByID) {
    // If the applicant is not found, display an error message and stop the script
    echo "Applicant not found!";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Applicant Information</title>
</head>
<body>
    <?php 
    // Display error messages if any exist in the session
    if (isset($_SESSION['message']) && $_SESSION['code'] == 400) { ?>
        <h3 style="color: red">[<?php echo $_SESSION['code']; ?>] <?php echo $_SESSION['message']; ?></h3>
    <?php }
    // Clear the session variables for message and code after displaying them
    unset($_SESSION['message']);
    unset($_SESSION['code']); ?>

    <!-- Page header -->
    <h1>Imus Specialize Hospital Job Application System</h1>
    <h2>Update Your Information:</h2>

    <!-- Form to update applicant details -->
    <form action="core/handleForms.php" method="POST">
        <!-- Hidden field to pass the 'applicant_id' securely to the server -->
        <input type="hidden" name="applicant_id" value="<?php echo htmlspecialchars($applicant_id); ?>">

        <!-- Input field for first name, prefilled with the current value -->
        <label for="fname">First Name</label>
        <input type="text" name="fname" value="<?php echo htmlspecialchars($getApplicantByID['fname']); ?>">
        <br><br>

        <!-- Input field for last name, prefilled with the current value -->
        <label for="lname">Last Name</label>
        <input type="text" name="lname" value="<?php echo htmlspecialchars($getApplicantByID['lname']); ?>">
        <br><br>

        <!-- Input field for specialization, prefilled with the current value -->
        <label for="specialization">Specialization</label>
        <input type="text" name="specialization" value="<?php echo htmlspecialchars($getApplicantByID['specialization']); ?>">
        <br><br>

        <!-- Submit button to save the updated information -->
        <input type="submit" value="Submit" name="updateApplicantBtn">
    </form>
</body>
</html>
