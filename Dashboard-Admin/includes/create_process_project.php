<?php
// Include your database connection code here
include('../../dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve project details from the form
    $projectId = $_POST['projectId'];
    $projectName = $_POST['projectName'];
    $projectDescription = $_POST['projectDescription'];
    $hardwareRequirement = $_POST['hardwareRequirement'];
    $projectStatus = $_POST['projectStatus'];

    // Check if the project ID is unique
    $checkStmt = mysqli_prepare($con, "SELECT project_id FROM projects WHERE project_id = ?");
    mysqli_stmt_bind_param($checkStmt, "s", $projectId); // Use "s" for VARCHAR
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);

    if (mysqli_stmt_num_rows($checkStmt) > 0) {
        // Project ID is not unique
        $_SESSION['error_message'] = "Project ID is already in use. Please choose a different ID.";
        header("Location: Create_Project.php");
        exit();
    }

    // Create a prepared statement to insert the project details into the database
    $stmt = mysqli_prepare($con, "INSERT INTO projects (project_id, project_name, project_description, hardware_requirement, project_status) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $projectId, $projectName, $projectDescription, $hardwareRequirement, $projectStatus);


    // Execute the statement to insert the data
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success_message'] = "Project created successfully";
        header("Location: Create_Project.php");
        exit();
    } else {
        // Error occurred while adding the project, you can handle the error here
        echo "Error: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
