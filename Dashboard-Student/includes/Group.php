<?php
session_start();

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php"); // Redirect to the login page
    exit();
}
?>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ProjectManagement - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>



<style>
    /* Add custom CSS to adjust the left margin of the sidebar */
    #sidebar {
        margin-left: 20px;
        /* You can adjust the value as needed */
    }

    /* Style for sidebar links */
    .nav-link-project {
        padding: 20px 15px;
        /* Increase padding for a wider button */
        font-size: x-large;
        color: #000;
        /* Set text color to black */
        background-color: brown;
        /* Set background color to brown */
        transition: background-color 0.3s ease, color 0.3s ease;
        /* Add a smooth transition effect */
        text-align: center;
        /* Center text horizontally */
        border-radius: 20px;
        /* Add rounded corners */
        margin-bottom: 10px;
        /* Add space between links */
        display: block;
        /* Ensure each link takes up a full block */
        text-decoration: none;
    }

    /* Change background color and text color on hover */
    .nav-link-project:hover {
        background-color: black;
        /* Change background color to black on hover */
        color: white;
        /* Change text color to white on hover */
    }

    /* Style for sidebar icons */
    .nav-link-icon {
        margin-right: 10px;
        /* Add space between icon and text */
    }

    /* Additional styles for improved aesthetics */
    .sidebar {
        background-color: #fff;
        /* Set sidebar background color to white */
        border-right: 1px solid #e0e0e0;
        /* Add a light border on the right */
    }

    /* Style for the disabled button */
    .disabled-button {
        background-color: #ccc;
        /* Gray background color */
        color: #888;
        /* Gray text color */
        cursor: not-allowed;
        /* Change cursor to 'not-allowed' */
    }
</style>


<?php
include('header.php');
?>



<div class="container mt-5">
    <!-- Centered Content -->
    <div class="d-flex justify-content-center align-items-center flex-column" style="margin-top: 150px;">
        <!-- Item 1 -->
        <div class="mb-3">
            <a class="nav-link-project mt-3" href="create_group.php">
                <span class="nav-link-icon"><i class="fa-regular fa-square-plus"></i></span> Create Group
            </a>
        </div>

        <div>
            <!-- Your second item content goes here -->
            <a class="nav-link-project mt-3" href="Show_group.php">
                <span class="nav-link-icon"><i class="fa-solid fa-door-open"></i></span> Show Group
            </a>
        </div>
    </div>
</div>



<?php
include('scripts.php');
?>