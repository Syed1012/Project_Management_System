<?php
session_start();
include('../../dbcon.php'); // Include the database connection

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php"); // Redirect to the login page
    exit();
}

if (isset($_POST['student_id']) && isset($_POST['percentage'])) {
    // Get the student ID and percentage from the AJAX request
    $student_id = $_POST['student_id'];
    $percentage = $_POST['percentage'];

    // Update the project_status_percentage in the groups table
    $update_query = "UPDATE groups SET project_status_percentage = :percentage WHERE student_id = :student_id";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bindParam(':percentage', $percentage, PDO::PARAM_INT);
    $update_stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);

    if ($update_stmt->execute()) {
        // The progress was updated successfully
        echo "Progress updated successfully.";
    } else {
        // Failed to update the progress
        echo "Failed to update progress.";
    }
} else {
    // Invalid POST data
    echo "Invalid request.";
}
?>
