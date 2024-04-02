<?php
session_start();
include('../../dbcon.php');

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php");
    exit();
}
?>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Groups - Professor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <!-- <link href="groups.css" rel="stylesheet" /> -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<style>
    .nav-link-project {
        padding: 20px 15px;
        font-size: x-large;
        color: #000;
        background-color: brown;
        transition: background-color 0.3s ease, color 0.3s ease;
        text-align: center;
        border-radius: 20px;
        margin-bottom: 10px;
        display: block;
        text-decoration: none;
    }

    /* Change background color and text color on hover */
    .nav-link-project:hover {
        background-color: black;
        color: white;
    }

    /* Style for sidebar icons */
    .nav-link-icon {
        margin-right: 10px;
    }

    /* Additional styles for improved aesthetics */
    .sidebar {
        background-color: #fff;
        border-right: 1px solid #e0e0e0;
    }

    .square-box {
        position: absolute;
        top: 50%;
        left: 55%;
        transform: translate(-50%, -50%);
        width: 450px;
        height: 320px;
        padding: 20px;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    }

    .square-box:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.16), 0 4px 10px rgba(0, 0, 0, 0.23);
    }

    #editPanelForm {
        display: none;
        /* Hide the form initially */
        width: 100%;
        display: block;
        border: none;
        outline: none;
        background: none;
        font-size: 1.2rem;
        color: #000000;
        padding: 10px 15px 10px 10px;
        border-radius: 10px;
    }

    .inpu {
        width: 88%;
        margin-left: 5px;
        border-radius: 20px;
        text-align: center;
        box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
    }

    .goButton {
        background-color: brown;
        border-radius: 20px;
    }
</style>

<?php
include('header.php');
?>

<div class="container mt-5">
    <div class="square-box">
        <!-- Item 1 -->
        <div class="mb-3">
            <a class="nav-link-project mt-3" href="Show_Projects.php">
                <span class="nav-link-icon"><i class="fa-solid fa-eye"></i></span> Show Projects
            </a>
        </div>

        <div>
            <!-- Your second item content goes here -->
            <a class="nav-link-project mt-3" href="Create_Project.php">
                <span class="nav-link-icon"><i class="fa fa-square-plus"></i></span> Create Project
            </a>
        </div>

        <div>
            <!-- Your second item content goes here -->
            <a class="nav-link-project mt-3" href="Edit_Projects.php">
                <span class="nav-link-icon"><i class="fa-solid fa-user-pen"></i></span> Edit Project
            </a>
        </div>
    </div>
</div>


<?php
include('scripts.php');
?>


</html>