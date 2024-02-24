<?php
include('../../dbcon.php'); // Include your database connection code

// Check if the project_id is provided in the URL
if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];

    // Create a DELETE SQL query to remove the project with the specific project_id
    $sql = "DELETE FROM projects WHERE project_id = ?";

    // Prepare the SQL statement
    $stmt = mysqli_prepare($con, $sql);

    // Bind the project_id parameter
    mysqli_stmt_bind_param($stmt, "s", $project_id); // Use "s" for VARCHAR

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Project removed successfully
        header("Location: Edit_Projects.php"); // Redirect back to the same page
        exit();
    } else {
        // Error occurred while removing the project
        echo "Error: " . mysqli_error($con);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($con);
?>
