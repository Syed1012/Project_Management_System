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

<?php
include('header.php');
include('../../dbcon.php'); // Include your database connection code

// Check if the project_id is provided in the URL
if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];

    // Fetch the project details from the database based on the project_id
    $sql = "SELECT * FROM projects WHERE project_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $project_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        // Project found, fetch its details
        $row = mysqli_fetch_assoc($result);
        $projectName = $row['project_name'];
        $projectDescription = $row['project_description'];
        $hardwareRequirement = $row['hardware_requirement'];
        $projectStatus = $row['project_status'];
    } else {
        // Project not found, handle the error (e.g., redirect to an error page)
        echo "Project not found";
        exit();
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}
?>

<!-- Create a form to edit the project details -->
<div class="container-fluid">
    <h1 id="create-project-heading">Edit Project</h1>
    <br>

    <form method="POST" action="process_edit_project.php">
        <!-- Include the project_id as a hidden input field to identify the project to edit -->
        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">

        <div class="mb-3">
            <label for="projectName" class="form-label">Project Name</label>
            <input type="text" class="form-control" id="projectName" name="projectName" value="<?php echo $projectName; ?>" required>
        </div>
        <br>
        <div class="mb-3">
            <label for="projectDescription" class="form-label">Project Description</label>
            <textarea class="form-control" id="projectDescription" name="projectDescription" rows="4"><?php echo $projectDescription; ?></textarea>
        </div>
        <br>
        <div class="mb-3">
            <label for="hardwareRequirement" class="form-label">Hardware Requirement</label>
            <textarea class="form-control" id="hardwareRequirement" name="hardwareRequirement" rows="4"><?php echo $hardwareRequirement; ?></textarea>
        </div>
        <br>
        <div class="mb-3">
            <label for="projectStatus" class="form-label">Project Status</label>
            <select class="form-control" id="projectStatus" name="projectStatus">
                <option value="1" <?php if ($projectStatus == 1) echo "selected"; ?>>Not yet Assigned</option>
                <option value="0" <?php if ($projectStatus == 0) echo "selected"; ?>>Assigned</option>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Update Project</button>
    </form>
</div>

<?php include('scripts.php'); ?>