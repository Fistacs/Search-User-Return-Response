<?php 

// Include the necessary files for database configuration, models, and form handling
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
    <!-- Link to the external CSS file for styling the page -->
    <link rel="stylesheet" href="css/styles.css">
    <title>View Applicants</title>
</head>
<body>
    <?php 
    // Check if there are search results stored in the session and assign to $searchResults
    $searchResults = isset($_SESSION['searchResults']) ? $_SESSION['searchResults'] : [];

    // If no search results, fetch all applicants from the database
    $applicants = empty($searchResults) ? getApplicants($pdo) : $searchResults;

    ?>

    <!-- Page header -->
    <h1>Imus Specialize Hospital Job Application System</h1>
    <h2>View Registered Applicants List</h2>

    <!-- Form to search for applicants by name or specialization -->
    <form action="core/handleForms.php" method="POST">
        <!-- Input field for search query -->
        <input type="text" name="search" placeholder="Search for applicant:">
        <!-- Submit button to trigger search action -->
        <input type="submit" value="Search" name="searchQueryBtn">
    </form>

    <br><br>

    <!-- Table to display the list of applicants -->
    <table class="applicantsTable">
        <!-- Table headers for each applicant's information -->
        <tr>
            <th style="border: 2px solid black; padding: 5px;">Last Name</th>
            <th style="border: 2px solid black; padding: 5px;">First Name</th>
            <th style="border: 2px solid black; padding: 5px;">Specialization</th>
            <th style="border: 2px solid black; padding: 5px;">Date Added</th>
            <th style="border: 2px solid black; padding: 5px;">Actions</th>
        </tr>

        <!-- Loop through the applicants and display each one in a table row -->
        <?php foreach ($applicants as $applicant): ?>
            <tr class="applicantsTable">
                <!-- Display applicant's last name -->
                <td style="border: 2px solid black; padding: 5px;"><?php echo $applicant['lname']; ?></td>
                <!-- Display applicant's first name -->
                <td style="border: 2px solid black; padding: 5px;"><?php echo $applicant['fname']; ?></td>
                <!-- Display applicant's specialization -->
                <td style="border: 2px solid black; padding: 5px;"><?php echo $applicant['specialization']; ?></td>
                <!-- Display the date when the applicant was added -->
                <td style="border: 2px solid black; padding: 5px;"><?php echo $applicant['date_added']; ?></td> 
                <td style="border: 2px solid black; padding: 5px;">
                    <!-- Link to edit the applicant's information -->
                    <button><a href="editUser.php?applicant_id=<?php echo $applicant['applicant_id']; ?>" style="text-decoration: none; color: black;">Update</a></button>
                    <!-- Link to delete the applicant -->
                    <button><a href="deleteUser.php?applicant_id=<?php echo $applicant['applicant_id']; ?>" style="text-decoration: none; color: black;">Delete</a></button>
                </td> 
            </tr>
        <?php endforeach; ?>

    </table>

    <br><br>
    <!-- Button to return to the main index page -->
    <button><a href="index.php" style="text-decoration: none; color: black;">Return To Index</a></button>
</body>
</html>
