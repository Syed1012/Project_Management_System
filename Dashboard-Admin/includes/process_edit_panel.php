<?php
session_start();

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php"); // Redirect to the login page
    exit();
}

include('../../dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $professorId = $_POST['professor_id'];
    $professorName = $_POST['professor_name'];
    $panelId = $_POST['panel_id'];
    $professorEmail = $_POST['professor_email'];
    $phoneNumber = $_POST['phone_number'];
    $spoc = $_POST['spoc'];

    // First condition: Check if panel is full (5 members)
    $sqlCheckPanelFull = "SELECT * FROM panels_list WHERE panel_id = '$panelId'";
    $resultCheckPanelFull = mysqli_query($con, $sqlCheckPanelFull);

    if (mysqli_num_rows($resultCheckPanelFull) >= 5) {
        $response = array("success" => false, "error" => "Panel is full");
        echo json_encode($response);
        exit();
    }

    // Second condition: Check if there is already a SPOC for the same panel ID
    $sqlCheckSpoc = "SELECT * FROM panels_list WHERE panel_id = '$panelId' AND spoc = 'Yes'";
    $resultCheckSpoc = mysqli_query($con, $sqlCheckSpoc);

    if (mysqli_num_rows($resultCheckSpoc) > 0 && $spoc == 'Yes') {
        $response = array("success" => false, "error" => "A SPOC is already allocated for this panel");
        echo json_encode($response);
        exit();
    }

    // Update the data
    $sql = "UPDATE panels_list SET professor_name = ?, panel_id = ?, professor_email = ?, phone_number = ?, spoc = ? WHERE professor_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $professorName, $panelId, $professorEmail, $phoneNumber, $spoc, $professorId);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "error" => "Failed to update details. Please try again."));
    }

    mysqli_stmt_close($stmt);
}
?>
