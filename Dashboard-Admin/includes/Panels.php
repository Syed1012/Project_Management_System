<?php
session_start();

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php"); // Redirect to the login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ProjectManagement - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="Panels.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<?php
include('header.php');
?>

<div class="container mt-5">
    <div class="square-box">
        <!-- Item 1 -->
        <div class="mb-3">
            <a class="nav-link-project mt-3" href="Create_panels.php">
                <span class="nav-link-icon"><i class="fa-regular fa-square-plus"></i></span> Create Panel
            </a>
        </div>

        <div>
            <!-- Your second item content goes here -->
            <a class="nav-link-project mt-3" href="Show_panels.php">
                <span class="nav-link-icon"><i class="fa-solid fa-door-open"></i></span> Show Panels
            </a>
        </div>

        <!-- Your Third item content goes here -->
        <div id="editPanelContainer">
            <a id="editPanelButton" class="nav-link-project mt-3" href="#" onclick="showEditPanelForm()">
                <span class="nav-link-icon"><i class="fa-solid fa-user-pen"></i></span> Edit Panel
            </a>
            <div id="editPanelForm" style="display: none;">
                <input type="text" class="inpu" id="employeeId" placeholder="Enter Employee ID">
                <button id="goButton" class="goButton"  onclick="navigateToEditPanel()"><i class="fa-regular fa-paper-plane"></i></button>
            </div>
        </div>

    </div>
</div>

<script>
    function showEditPanelForm() {
        var editPanelButton = document.getElementById('editPanelButton');
        var editPanelForm = document.getElementById('editPanelForm');

        editPanelButton.style.display = 'none'; // Hide the button
        editPanelForm.style.display = 'block'; // Display the form
    }
    function navigateToEditPanel() {
        var professor_id = document.getElementById('employeeId').value;
        window.location.href = 'Edit_panel.php?professor_id=' + professor_id;
    }
</script>

<?php
include('scripts.php');
?>

</html>