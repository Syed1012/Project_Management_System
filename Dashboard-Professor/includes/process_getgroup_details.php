<?php
include("../../dbcon.php"); // Database connection file

// Check if group_number is provided
if (!isset($_GET['group_number'])) {
    echo json_encode(['success' => false, 'message' => 'Group number is required']);
    exit();
}

$groupNumber = $_GET['group_number'];

// Fetch student details based on the group number
$stmt = $con->prepare("SELECT * FROM student_groups WHERE group_id = ?");
$stmt->bind_param("s", $groupNumber);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode([
        'success' => true,
        'student1_name' => $row['student1_name'],
        'student1_id' => $row['student1_id'],
        'student2_name' => $row['student2_name'],
        'student2_id' => $row['student2_id'],
        'student3_name' => $row['student3_name'],
        'student3_id' => $row['student3_id'],
        'student4_name' => $row['student4_name'],
        'student4_id' => $row['student4_id']
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'No student details found for the group number']);
}

$stmt->close();
$con->close();
?>
