<?php
include('../../dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $professorId = $_POST['professor_id'];
    $professorName = $_POST['professor_name'];
    $panelId = $_POST['panel_id'];
    $professorEmail = $_POST['professor_email'];
    $phoneNumber = $_POST['phone_number'];
    $spoc = $_POST['spoc'];

    // First condition: Check if professor_id exists in users table
    $sqlCheckUser = "SELECT * FROM users WHERE reg_id = '$professorId'";
    $resultCheckUser = mysqli_query($con, $sqlCheckUser);

    if (mysqli_num_rows($resultCheckUser) == 0) {
        $response = array("success" => false, "error" => "User not found");
        echo json_encode($response);
        exit();
    }

    // Second condition: Check if professor_id is already in panels_list table
    $sqlCheckPanel = "SELECT * FROM panels_list WHERE professor_id = '$professorId'";
    $resultCheckPanel = mysqli_query($con, $sqlCheckPanel);

    if (mysqli_num_rows($resultCheckPanel) > 0) {
        $response = array("success" => false, "error" => "Professor ID already exists in panels_list");
        echo json_encode($response);
        exit();
    }

    // Third condition: Check if panel is full (5 members)
    $sqlCheckPanelFull = "SELECT * FROM panels_list WHERE panel_id = '$panelId'";
    $resultCheckPanelFull = mysqli_query($con, $sqlCheckPanelFull);

    if (mysqli_num_rows($resultCheckPanelFull) >= 5) {
        $response = array("success" => false, "error" => "Panel is full");
        echo json_encode($response);
        exit();
    }

    // Fourth condition: Check if there is already a SPOC for the same panel ID
    $sqlCheckSpoc = "SELECT * FROM panels_list WHERE panel_id = '$panelId' AND spoc = 'Yes'";
    $resultCheckSpoc = mysqli_query($con, $sqlCheckSpoc);

    if (mysqli_num_rows($resultCheckSpoc) > 0) {
        $response = array("success" => false, "error" => "A SPOC is already allocated for this panel");
        echo json_encode($response);
        exit();
    }

    // Insert data into panels_list table
    $sqlInsert = "INSERT INTO panels_list (professor_id, professor_name, panel_id, professor_email, phone_number, spoc) VALUES ('$professorId', '$professorName', '$panelId', '$professorEmail', '$phoneNumber', '$spoc')";
    $resultInsert = mysqli_query($con, $sqlInsert);

    if ($resultInsert) {
        echo "Data inserted successfully";
        echo "<script>window.location.reload();</script>";
        $response = array("success" => true);
        echo json_encode($response);
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

mysqli_close($con);
