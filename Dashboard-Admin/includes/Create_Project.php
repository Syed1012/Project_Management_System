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
    /* Container styling */
    .custom-container {
        max-width: 800px;
        /* Increase the width */
        margin: 20px auto;
        /* Adjust margin */
        padding: 20px;
        background-color: #ecf0f3;
        border-radius: 15px;
        box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
    }

    /* Heading styling */
    #create-project-heading {
        font-weight: 600;
        font-weight: bolder;
        font-size: 24px;
        letter-spacing: 1.3px;
        color: black;
        padding-top: 20px;
        text-align: center;
        margin-bottom: 20px;
        /* Add margin bottom */
    }

    /* Form field styling */
    .mb-3 label {
        font-weight: bold;
        color: black;
    }

    .mb-3 input,
    .mb-3 select,
    .mb-3 textarea {
        width: 100%;
        padding: 10px;
        background: none;
        font-size: 1.2rem;
        color: black;
        border: 0.5px solid black;
        border-radius: 5px;
    }

    /* Button styling */

    .btn-primar {
        background-color: brown;
        color: black;
        font-weight: bolder;
        border-radius: 25px;
        box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
        letter-spacing: 1.3px;
        margin-top: 20px;

    }

    .btn-primar:hover {
        background-color: black;
        color: white;
    }
</style>

<?php
include('header.php');
?>

<div class="custom-container">
    <h1 id="create-project-heading">CREATE PROJECT</h1>

    <form method="POST" action="create_process_project.php">
        <div class="mb-3">
            <label for="projectId" class="form-label">Project ID</label>
            <input type="text" class="form-control" id="projectId" name="projectId" required>
        </div>
        <div class="mb-3">
            <label for="projectName" class="form-label">Project Name</label>
            <input type="text" class="form-control" id="projectName" name="projectName" required>
        </div>
        <div class="mb-3">
            <label for="projectDescription" class="form-label">Project Description</label>
            <textarea class="form-control" id="projectDescription" name="projectDescription" rows="4"></textarea>
        </div>
        <div class="mb-3">
            <label for="hardwareRequirement" class="form-label">Hardware Requirement</label>
            <textarea class="form-control" id="hardwareRequirement" name="hardwareRequirement" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label for="projectStatus" class="form-label">Project Status</label>
            <select class="form-control" id="projectStatus" name="projectStatus">
                <option value="Available">Available</option>
                <option value="Not Available">Not Available</option>
            </select>
        </div>


        <div class="text-center">
            <button type="submit" class="bt btn-primar">Create Project</button>

        </div>

    </form>
</div>

<?php
include('footer.php');
include('scripts.php');
?>