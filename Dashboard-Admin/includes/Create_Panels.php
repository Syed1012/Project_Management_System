<?php
session_start();

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php"); // Redirect to the login page
    exit();
}

include('../../dbcon.php');
?>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ProjectManagement - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="createpanel.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
</head>

<?php
include('header.php');
?>

<div class="container" style="margin-left: 30px; margin-right: 100px; width: 95%;">
    <!-- open container -->
    <div class="row">
        <!--  open row -->
        <div id="form-header" class="col-12" style="margin-top:30px;">
            <h1 id="title">Panel Form</h1>
        </div>
    </div>
    <!--  close row -->

    <div class="row">
        <!--  open row -->
        <div id="form-tagline" class="col-md-4">
            <div class="form-tagline">
                <img class="form-img" src="./panel-img.png" alt="img" />
            </div>
        </div>

        <div id="form-content" class="col-md-8">
            <form id="survey-form" onsubmit="return false;">

                <!-- --------- Professor ID -------------- -->
                <div class="row form-group">
                    <div class="col-sm-3">
                        <label id="professor-id-label" class="control-label" for="professor_id">Professor ID:</label>
                    </div>

                    <div class="input-group col-sm-9">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon-professor-id"><i class="fa fa-id-badge"></i></span>
                        </div>
                        <input id="professor_id" type="text" class="form-control" placeholder="Please Enter ID" name="professor_id" required onchange="fetchProfessorDetails()" />
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
                        <input id="professor_name" type="text" class="form-control" placeholder="Professor Name" name="professor_name" required />
                    </div>
                </div>

                <!-- --------- Panel Id -------------- -->
                <div class="row form-group">
                    <div class="col-sm-3">
                        <label id="panel-id-label" class="control-label" for="panel_id">Panel Id:</label>
                    </div>

                    <div class="input-group col-sm-9">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon-panel-id"><i class="fa fa-door-open"></i></span>
                        </div>
                        <select name="panel_id" id="panel_id" class="form-control" required>
                            <option value="select">Select Panel Id</option>
                            <?php
                            for ($i = 0; $i <= 20; $i++) {
                                echo '<option value="panel' . $i . '">Panel ' . $i . '</option>';
                            }
                            ?>
                        </select>
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
                        <input type="email" class="form-control" id="professor_email" placeholder="Professor Email" name="professor_email" required />
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
                        <input type="number" class="form-control" id="phone_number" placeholder="Phone Number" name="phone_number" required />
                    </div>
                </div>

                <!-- ---------------- SPOC ------------------- -->
                <div class="form-group row mt-4">
                    <div class="col-sm-3">
                        <label class="control-label" for="spoc">SPOC:</label>
                    </div>

                    <div class="col-sm-9" style="font-weight: bold;">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="spoc" id="spoc_yes" value="Yes" />
                            <label class="form-check-label" for="spoc_yes">Yes</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="spoc" id="spoc_no" value="No" />
                            <label class="form-check-label" for="spoc_no">No</label>
                        </div>
                    </div>
                </div>

                <!-- -------------- Submit Button ------------------- -->
                <div class="form-group row">
                    <div class="col-sm-12 submit-button">
                        <button type="button" id="submit" class="btn" aria-pressed="true" onclick="submitForm()">
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
                <p id="success-message">Panel added successfully!</p>
            </div>
            <!-- END -->

            <!-- END -->
        </div>
        <!-- close form content div -->
    </div>
    <!-- close row -->
</div>
<!--  close container -->

<script>
    function fetchProfessorDetails() {
        var professorId = document.getElementById('professor_id').value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var professorData = JSON.parse(this.responseText);
                if (professorData) {
                    document.getElementById('professor_name').value = professorData.user_name;
                    document.getElementById('professor_email').value = professorData.email;
                    document.getElementById('phone_number').value = professorData.phone_number;
                }
            }
        };
        xhttp.open("GET", "fetch_professor_details.php?professor_id=" + professorId, true);
        xhttp.send();
    }

    function submitForm() {
        var professorId = document.getElementById('professor_id').value;
        var professorName = document.getElementById('professor_name').value;
        var panelId = document.getElementById('panel_id').value;
        var professorEmail = document.getElementById('professor_email').value;
        var phoneNumber = document.getElementById('phone_number').value;
        var spoc = document.querySelector('input[name="spoc"]:checked').value;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response.success) {
                    resetForm(); // Reset form fields
                    // Show success message
                    var successMessage = document.getElementById('success-message');
                    successMessage.innerText = "Panel added successfully!";
                    document.getElementById('success-container').style.display = 'block';
                    // Hide success message after 3 seconds
                    setTimeout(hideMessages, 2000);
                    // Redirect or show a success message here
                    console.log("Data inserted successfully");
                } else {
                    // Display error message
                    var errorMessage = document.getElementById('error-message');
                    errorMessage.innerText = response.error;
                    document.getElementById('error-container').style.display = 'block';
                    // Hide error message after 3 seconds
                    setTimeout(hideMessages, 2000);
                }
            }
        };
        xhttp.open("POST", "store_panel_details.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("professor_id=" + professorId + "&professor_name=" + professorName + "&panel_id=" + panelId + "&professor_email=" + professorEmail + "&phone_number=" + phoneNumber + "&spoc=" + spoc);
    }

    function resetForm() {
        document.getElementById('survey-form').reset();
    }

    function hideMessages() {
        document.getElementById('error-container').style.display = 'none';
        document.getElementById('success-container').style.display = 'none';
    }
</script>

<?php
include('scripts.php');
?>