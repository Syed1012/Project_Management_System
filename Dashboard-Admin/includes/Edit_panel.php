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
    <link href="Edit_panel.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
</head>

<?php
include('header.php');
include('../../dbcon.php');

if (isset($_GET['professor_id'])) {
    $professorId = $_GET['professor_id'];
    $sql = "SELECT * FROM panels_list WHERE professor_id = '$professorId'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        // Data found, pre-fill the form
        $professorName = $row['professor_name'];
        $panelId = $row['panel_id'];
        $professorEmail = $row['professor_email'];
        $phoneNumber = $row['phone_number'];
        $spoc = $row['spoc'];
    } else {
        echo "User not found in panels_list table";
    }
}
?>

<div class="container" style="margin-left: 30px; margin-right: 100px; width: 95%;">
    <div class="row">
        <div id="form-header" class="col-12" style="margin-top:30px;">
            <h1 id="title">Panel Form</h1>
        </div>
    </div>

    <div class="row">
        <div id="form-tagline" class="col-md-4">
            <div class="form-tagline">
                <img class="form-img" src="./panel-img.png" alt="img" />
            </div>
        </div>

        <div id="form-content" class="col-md-8">
            <form id="update-form" method="POST">

                <div class="row form-group">
                    <div class="col-sm-3">
                        <label id="professor-id-label" class="control-label" for="professor_id">Professor ID:</label>
                    </div>
                    <div class="input-group col-sm-9">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon-professor-id"><i class="fa fa-id-badge"></i></span>
                        </div>
                        <input id="professor_id" type="text" class="form-control" placeholder="Please Enter ID" name="professor_id" value="<?php echo $professorId; ?>" required readonly />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-sm-3">
                        <label id="professor-name-label" class="control-label" for="professor_name">Professor Name:</label>
                    </div>
                    <div class="input-group col-sm-9">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon-professor-name"><i class="fa fa-user"></i></span>
                        </div>
                        <input id="professor_name" type="text" class="form-control" placeholder="Professor Name" name="professor_name" value="<?php echo $professorName; ?>" required />
                    </div>
                </div>

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
                                $selected = ($panelId == "panel$i") ? "selected" : "";
                                echo "<option value='panel$i' $selected>Panel $i</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-3">
                        <label id="professor-email-label" class="control-label" for="professor_email">Professor Email:</label>
                    </div>
                    <div class="input-group col-sm-9">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon-professor-email"><i class="fa fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" id="professor_email" placeholder="Professor Email" name="professor_email" value="<?php echo $professorEmail; ?>" required />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-3">
                        <label id="professor-phone-label" class="control-label" for="phone_number">Phone Number:</label>
                    </div>
                    <div class="input-group col-sm-9">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon-professor-phone"><i class="fa fa-phone"></i></span>
                        </div>
                        <input type="number" class="form-control" id="phone_number" placeholder="Phone Number" name="phone_number" value="<?php echo $phoneNumber; ?>" required />
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col-sm-3">
                        <label class="control-label" for="spoc">SPOC:</label>
                    </div>
                    <div class="col-sm-9" style="font-weight: bold;">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="spoc" id="spoc_yes" value="Yes" <?php if ($spoc == "Yes") echo "checked"; ?>>
                            <label class="form-check-label" for="spoc_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="spoc" id="spoc_no" value="No" <?php if ($spoc == "No") echo "checked"; ?>>
                            <label class="form-check-label" for="spoc_no">No</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 submit-button">
                        <button type="button" id="submit" class="btn" aria-pressed="true">
                            Add
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


<script>
    document.getElementById("submit").addEventListener("click", function() {
        var form = document.getElementById("update-form");
        var formData = new FormData(form);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "process_edit_panel.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Handle successful update
                    alert("Details updated successfully please go to Dashboard!");
                } else {
                    // Handle error
                    alert("Failed to update details. Please try again.");
                }
            }
        };
        xhr.send(formData);
    });
</script>


<?php
include('scripts.php');
?>

</html>