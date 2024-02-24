<?php
session_start();

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php"); // Redirect to the login page if not logged in
    exit();
}

// Include the database connection file
include('../../dbcon.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reg_id = $_SESSION['reg_id'];
    $group_id = $_POST['group_id'];
    $student_slot = $_POST['student_slot'];
    $new_student_name = $_POST['new_student_name']; // Added to get student name
    $new_student_id = $_POST['new_student_id'];

    // Form validation: Check if new_student_id and new_student_name are not empty
    if (empty($new_student_id) || empty($new_student_name)) {
        echo "Student ID and Student Name cannot be empty. Please enter valid values.";
        exit();
    }

    // Check if the entered user exists
    $check_user_query = "SELECT * FROM users WHERE reg_id = ?";
    $stmt = mysqli_prepare($con, $check_user_query);
    mysqli_stmt_bind_param($stmt, "s", $new_student_id);
    mysqli_stmt_execute($stmt);
    $user_result = mysqli_stmt_get_result($stmt);
    $user_exists = mysqli_num_rows($user_result) > 0;

    if ($user_exists) {
        // Check if the entered user is already in any group
        $check_group_query = "SELECT * FROM student_groups WHERE student1_id = ? OR student2_id = ? OR student3_id = ? OR student4_id = ?";
        $stmt = mysqli_prepare($con, $check_group_query);
        mysqli_stmt_bind_param($stmt, "ssss", $new_student_id, $new_student_id, $new_student_id, $new_student_id);
        mysqli_stmt_execute($stmt);
        $group_result = mysqli_stmt_get_result($stmt);
        $user_in_group = mysqli_num_rows($group_result) > 0;

        if ($user_in_group) {
            echo "The entered user is already in a group.";
        } else {
            // Determine the actual column name based on the selected slot
            $column_name = '';
            switch ($student_slot) {
                case 'student1':
                    $column_name = 'student1_id';
                    break;
                case 'student2':
                    $column_name = 'student2_id';
                    break;
                case 'student3':
                    $column_name = 'student3_id';
                    break;
                case 'student4':
                    $column_name = 'student4_id';
                    break;
                default:
                    // Handle an invalid slot if needed
                    break;
            }


            // Update the student_groups table with the new friend's information
            $column_name = $student_slot . "_id"; // Use this to determine the ID column
            $name_column_name = $student_slot . "_name"; // Use this to determine the Name column
            $update_query = "UPDATE student_groups SET $column_name = ?, $name_column_name = ? WHERE group_id = ?";
            $stmt = mysqli_prepare($con, $update_query);
            mysqli_stmt_bind_param($stmt, "sss", $new_student_id, $new_student_name, $group_id);


            if (mysqli_stmt_execute($stmt)) {
                // Friend added successfully
                header("Location: Show_group.php");
                exit();
            } else {
                echo "Error updating the database: " . mysqli_error($con);
            }

            mysqli_stmt_close($stmt);
        }
    } else {
        echo "The entered user does not exist.";
    }
} else {
    echo "Invalid request method.";
}
