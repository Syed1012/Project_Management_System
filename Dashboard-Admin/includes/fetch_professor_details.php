<?php
include('../../dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $professorId = $_GET['professor_id'];

    // Query to fetch professor details based on professor_id
    $sql = "SELECT user_name, email, phone_number FROM users WHERE reg_id = '$professorId'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $professorDetails = array(
            'user_name' => $row['user_name'],
            'email' => $row['email'],
            'phone_number' => $row['phone_number']
        );
        echo json_encode($professorDetails);
    } else {
        echo json_encode(null); // Return null if professor not found
    }
}

mysqli_close($con);
