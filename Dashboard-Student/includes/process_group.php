<?php
session_start();

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php"); // Redirect to the login page if not logged in
    exit();
}

include('../../dbcon.php');

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Retrieve group ID from the form
    $group_id = $_POST['group_id'];

    // Check if the group exists in the groups table
    $check_group_query = "SELECT * FROM groups WHERE group_id = '$group_id'";
    $check_group_result = mysqli_query($con, $check_group_query);

    if (mysqli_num_rows($check_group_result) == 0) {
        // The group does not exist, so insert it into the groups table
        $group_id = mysqli_real_escape_string($con, $group_id);
        $insert_group_query = "INSERT INTO groups (group_id, group_name) VALUES ('$group_id', 'Group Name')";

        if (!mysqli_query($con, $insert_group_query)) {
            // Handle the case where the insertion fails
            echo "Error: " . mysqli_error($con);
            exit();
        }
    }

    // Initialize an array to store the student data
    $student_data = array();

    // Loop through each student (assuming you have 4 students)
    for ($i = 1; $i <= 4; $i++) {
        $student_name = $_POST['student_name_' . $i];
        $student_id = $_POST['student_id_' . $i];

        // Check if the student is not already in the table
        $check_query = "SELECT * FROM student_groups WHERE group_id_fk = '$group_id' AND (name_1 = '$student_name' OR name_2 = '$student_name' OR name_3 = '$student_name' OR name_4 = '$student_name' OR reg_id_1 = '$student_id' OR reg_id_2 = '$student_id' OR reg_id_3 = '$student_id' OR reg_id_4 = '$student_id')";
        
        $check_result = mysqli_query($con, $check_query);
        
        if (mysqli_num_rows($check_result) == 0) {
            // If no matching rows found, the student is not in the table
            // Add the student data to the $student_data array
            $student_data[] = array(
                'group_id' => $group_id,
                'name' => $student_name,
                'id' => $student_id
            );
        }
    }

    // Insert the student data into the student_groups table
    foreach ($student_data as $student) {
        $group_id_fk = mysqli_real_escape_string($con, $student['group_id']);
        $name = mysqli_real_escape_string($con, $student['name']);
        $id = mysqli_real_escape_string($con, $student['id']);

        $insert_query = "INSERT INTO student_groups (group_id_fk, name_1, reg_id_1) VALUES ('$group_id_fk', '$name', '$id')";

        if (mysqli_query($con, $insert_query)) {
            // Insertion was successful
        } else {
            // Handle the case where the insertion fails
            echo "Error: " . mysqli_error($con);
        }
    }

    // Close the database connection
    mysqli_close($con);

    // Redirect to index.php after successful insertion
    header("Location: index.php");
    exit();
}
?>
