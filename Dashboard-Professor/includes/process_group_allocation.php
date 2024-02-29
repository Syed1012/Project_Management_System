<?php
session_start();

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php"); // Redirect to the login page
    exit();
}

include("../../dbcon.php"); // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $group_number = $_POST['group_number'];
    $student_name1 = $_POST['student_name1'];
    $student_id1 = $_POST['student_id1'];
    $student_name2 = $_POST['student_name2'];
    $student_id2 = $_POST['student_id2'];
    $student_name3 = $_POST['student_name3'];
    $student_id3 = $_POST['student_id3'];
    $student_name4 = $_POST['student_name4'];
    $student_id4 = $_POST['student_id4'];
    $professor_name = $_POST['professor_name'];
    $professor_email = $_POST['professor_email'];
    $professor_phone = $_POST['professor_phone'];
    $project_id = $_POST['project_id'];

    // Check if group_number already exists
    $check_sql = "SELECT * FROM allocated_groups WHERE group_number = ?";
    $check_stmt = $con->prepare($check_sql);
    $check_stmt->bind_param("s", $group_number);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo json_encode(array("success" => false, "message" => "Group number already exists."));
        exit();
    }

    // Insert data into allocated_groups table
    $insert_sql = "INSERT INTO allocated_groups (group_number, student_name1, student_id1, student_name2, student_id2, student_name3, student_id3, student_name4, student_id4, professor_name, professor_email, phone_number, project_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $insert_stmt = $con->prepare($insert_sql);
    $insert_stmt->bind_param("sssssssssssss", $group_number, $student_name1, $student_id1, $student_name2, $student_id2, $student_name3, $student_id3, $student_name4, $student_id4, $professor_name, $professor_email, $professor_phone, $project_id);
    $insert_stmt->execute();

    if ($insert_stmt->affected_rows > 0) {
        echo json_encode(array("success" => true, "message" => "Group added successfully!"));
    } else {
        echo json_encode(array("success" => false, "message" => "Failed to add group. Please try again."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
}
