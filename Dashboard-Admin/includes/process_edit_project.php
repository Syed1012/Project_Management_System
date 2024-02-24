<?php
// Include your database connection code here
include('../../dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve project details from the form
    $project_id = $_POST['project_id'];
    $projectName = $_POST['projectName'];
    $projectDescription = $_POST['projectDescription'];
    $hardwareRequirement = $_POST['hardwareRequirement'];
    $projectStatus = $_POST['projectStatus'];

    // Create a prepared statement to update the project details in the database
    $stmt = mysqli_prepare($con, "UPDATE Projects SET project_name = ?, project_description = ?, hardware_requirement = ?, project_status = ? WHERE project_id = ?");
mysqli_stmt_bind_param($stmt, "sssss", $projectName, $projectDescription, $hardwareRequirement, $projectStatus, $project_id);


    // Execute the statement to update the data
    if (mysqli_stmt_execute($stmt)) {
        // Project updated successfully
        header("Location: Edit_Projects.php");
        exit();
    } else {
        // Error occurred while updating the project, you can handle the error here
        echo "Error: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
