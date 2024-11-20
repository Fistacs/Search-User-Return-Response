<?php 

// Include necessary files for database connection, models, and form handling
require_once 'core/dbConfig.php';
require_once 'core/models.php';
require_once 'core/handleForms.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta information for character encoding and responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application System</title>
</head>
<body>
    <?php 
    // Check if there is a message set in the session and its code indicates an error (400)
    if (isset($_SESSION['message']) && $_SESSION['code'] == 400) { ?>
        <!-- Display the error message in red -->
        <h3 style="color: red">[<?php echo $_SESSION['code']; ?>] <?php echo $_SESSION['message']; ?></h3>
    <?php }
    // Clear the session variables for message and code after displaying them
    unset($_SESSION['message']);
    unset($_SESSION['code']); ?>
    
    <!-- Page header -->
    <h1>Imus Specialize Hospital Job Application System</h1>

    <!-- Form to register a new applicant -->
    <form action="core/handleForms.php" method="POST">
        <!-- Input field for the first name -->
        <label for="fname">First Name</label>
        <input type="text" name="fname">
        <br><br>

        <!-- Input field for the last name -->
        <label for="lname">Last Name</label>
        <input type="text" name="lname">
        <br><br>

        <!-- Input field for the specialization -->
        <label for="specialization">Specialization</label>
        <input type="text" name="specialization">
        <br><br>

        <!-- Submit button to send the form data -->
        <input type="submit" value="Submit" name="registerApplicantBtn">
    </form>
    <br><br>

    <!-- Reset button to clear all applicants and reset the database -->
    <button>
        <!-- Link to the reset script, styled as a button -->
        <a href="core/unset.php" style="text-decoration: none; color: black;">Reset</a>
    </button>
</body>
</html>
