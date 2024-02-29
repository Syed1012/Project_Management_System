<?php
session_start();

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php"); // Redirect to the login page
    exit();
}

include("../../dbcon.php") // Database connection file
?>

<?php
// Assuming the session contains 'reg_id'
$reg_id = $_SESSION['reg_id'];

// Fetch the professor details from the 'users' table
$sql = "SELECT user_name, email, phone_number FROM users WHERE reg_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $reg_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $professor_name = $row['user_name'];
    $professor_email = $row['email'];
    $professor_phone = $row['phone_number'];
} else {
    // Handle case when professor details are not found
    $professor_name = 'Profesor name is null. Please type it';
    $professor_email = 'Profesor email is null. Please type it';
    $professor_phone = 'Profesor phone is null. Please type it';
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Groups - Professor</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="allocated_group.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>


<?php include('header.php'); ?>

<div class="container" style="margin-left: 30px; margin-right: 100px; width: 95%;">
    <!-- open container -->
    <div class="row">
        <!--  open row -->
        <div id="form-header" class="col-12" style="margin-top:30px;">
            <h1 id="title">Group Formation Enlistment</h1>
        </div>
    </div>
    <!--  close row -->

    <div class="row">
        <!--  open row -->
        <div id="form-tagline" class="col-md-4">
            <div class="form-tagline">
                <img class="form-img" src="./groups.png" alt="img" />
            </div>
        </div>

        <div id="form-content" class="col-md-8">
            <form id="survey-form">

                <!-- --------- Group Number -------------- -->
                <div class="row form-group">
                    <div class="col-sm-3">
                        <label id="group-number-label" class="control-label" for="group_number">Group No:</label>
                    </div>

                    <div class="input-group col-sm-9">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon-group-number"><i class="fa fa-people-group"></i></span>
                        </div>
                        <input id="group_number" type="text" class="form-control" placeholder="Please Enter group number" name="group_number" required onchange="fetchGroupDetails()" />
                    </div>
                </div>

                <!-- --------- student's Name & ID's -------------- -->
                <div class="row form-group">
                    <div class="input-group col-sm-4">
                        <label id="student-name-id-label" class="control-label" for="student_name_id">Student Names & Reg ID:</label>
                    </div>

                    <div class="col-sm-4">
                        <input id="student_name1" type="text" class="form-control" placeholder="Student 1 Name" name="student_name1" required />
                        <br>
                        <input id="student_name2" type="text" class="form-control" placeholder="Student 2 Name" name="student_name2" required />
                        <br>
                        <input id="student_name3" type="text" class="form-control" placeholder="Student 3 Name" name="student_name3" required />
                        <br>
                        <input id="student_name4" type="text" class="form-control" placeholder="Student 4 Name" name="student_name4" required />
                    </div>

                    <div class="col-sm-4">
                        <input id="student_id1" type="text" class="form-control" placeholder="Student 1 ID" name="student_id1" required />
                        <br>
                        <input id="student_id2" type="text" class="form-control" placeholder="Student 2 ID" name="student_id2" required />
                        <br>
                        <input id="student_id3" type="text" class="form-control" placeholder="Student 3 ID" name="student_id3" required />
                        <br>
                        <input id="student_id4" type="text" class="form-control" placeholder="Student 4 ID" name="student_id4" required />
                    </div>
                </div>

                <!-- --------- Professor Name -------------- -->
                <div class="row form-group">
                    <div class="col-sm-3">
                        <label id="professor-name-label" class="control-label" for="professor_name">Professor Name:</label>
                    </div>

                    <div class="input-group col-sm-9">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon-professor-name"><i class="fa fa-user"></i></span>
                        </div>
                        <input id="professor_name" type="text" class="form-control" placeholder="Professor Name" name="professor_name" value="<?php echo htmlspecialchars($professor_name); ?>" required />
                    </div>
                </div>

                <!-- --------- Professor Email -------------- -->
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label id="professor-email-label" class="control-label" for="professor_email">Professor Email:</label>
                    </div>

                    <div class="input-group col-sm-9">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon-professor-email"><i class="fa fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" id="professor_email" placeholder="Professor Email" name="professor_email" value="<?php echo htmlspecialchars($professor_email); ?>" required />
                    </div>
                </div>

                <!-- --------- Professor Phone -------------- -->
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label id="professor-phone-label" class="control-label" for="phone_number">Phone Number:</label>
                    </div>

                    <div class="input-group col-sm-9">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon-professor-phone"><i class="fa fa-phone"></i></span>
                        </div>
                        <input type="number" class="form-control" id="phone_number" placeholder="Professor Phone Number" name="phone_number" value="<?php echo htmlspecialchars($professor_phone); ?>" required />
                    </div>
                </div>

                <!-- --------- Project Id -------------- -->
                <div class="row form-group">
                    <div class="col-sm-3">
                        <label id="project-id-label" class="control-label" for="project_id">Project Id:</label>
                    </div>

                    <div class="input-group col-sm-9">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon-project-id"><i class="fa fa-door-open"></i></span>
                        </div>
                        <select name="project_id" id="project_id" class="form-control" required>
                            <option value="select">Select Project Id</option>
                            <?php
                            include("../../dbcon.php");

                            // Fetch only project_id where record_status is 1
                            $sql_projects = "SELECT project_id FROM projects WHERE project_status = 1";
                            $result_projects = $con->query($sql_projects);

                            if ($result_projects->num_rows > 0) {
                                while ($row_projects = $result_projects->fetch_assoc()) {
                                    echo '<option value="' . $row_projects['project_id'] . '">Project ' . $row_projects['project_id'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- -------------- Submit Button ------------------- -->
                <div class="form-group row">
                    <div class="col-sm-12 submit-button">
                        <button type="submit" id="submit" class="btn" aria-pressed="true" onclick="handleSubmit()">
                            Add
                        </button>
                    </div>
                </div>

            </form>
            <!-- close form -->

            <!-- -------------- Error Message Container ------------------- -->
            <div id="error-container" style="display: none;">
                <p id="error-message"></p>
            </div>

            <!-- -------------- Success Message Container ------------------- -->
            <div id="success-container" style="display: none;">
                <p id="success-message">Group added successfully!</p>
            </div>
            <!-- END -->
        </div>
        <!-- close form content div -->
    </div>
    <!-- close row -->
</div>

<!-- Add this code inside the head tag -->
<script>
    function fetchGroupDetails() {
        var groupNumber = document.getElementById('group_number').value;

        // Make an AJAX request
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response.success) {
                    document.getElementById('student_name1').value = response.student1_name;
                    document.getElementById('student_name2').value = response.student2_name;
                    document.getElementById('student_name3').value = response.student3_name;
                    document.getElementById('student_name4').value = response.student4_name;

                    document.getElementById('student_id1').value = response.student1_id;
                    document.getElementById('student_id2').value = response.student2_id;
                    document.getElementById('student_id3').value = response.student3_id;
                    document.getElementById('student_id4').value = response.student4_id;
                } else {
                    // Handle error (e.g., display an error message)
                    console.error(response.message);
                }
            }
        };
        xhr.open('GET', 'process_getgroup_details.php?group_number=' + groupNumber, true);
        xhr.send();
    }

    function handleSubmit() {
        // Gather all the input values
        var groupNumber = document.getElementById('group_number').value;
        var studentName1 = document.getElementById('student_name1').value;
        var studentId1 = document.getElementById('student_id1').value;
        var studentName2 = document.getElementById('student_name2').value;
        var studentId2 = document.getElementById('student_id2').value;
        var studentName3 = document.getElementById('student_name3').value;
        var studentId3 = document.getElementById('student_id3').value;
        var studentName4 = document.getElementById('student_name4').value;
        var studentId4 = document.getElementById('student_id4').value;
        var professorName = document.getElementById('professor_name').value;
        var professorEmail = document.getElementById('professor_email').value;
        var professorPhone = document.getElementById('phone_number').value;
        var projectId = document.getElementById('project_id').value;

        // Make an AJAX request to process_group_allocation.php
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response.success) {
                    // Display success message or redirect to another page
                    alert("Group added successfully!");
                } else {
                    // Display error message
                    alert("Failed to add group. Please try again.");
                }
            }
        };
        xhr.open('POST', 'process_group_allocation.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('group_number=' + groupNumber +
            '&student_name1=' + studentName1 +
            '&student_id1=' + studentId1 +
            '&student_name2=' + studentName2 +
            '&student_id2=' + studentId2 +
            '&student_name3=' + studentName3 +
            '&student_id3=' + studentId3 +
            '&student_name4=' + studentName4 +
            '&student_id4=' + studentId4 +
            '&professor_name=' + professorName +
            '&professor_email=' + professorEmail +
            '&professor_phone=' + professorPhone +
            '&project_id=' + projectId);
    }
</script>

<?php include('scripts.php'); ?>