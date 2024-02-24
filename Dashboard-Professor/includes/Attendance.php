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
?>

<style>
    /* --------------student form -------------- */

    table,
    td,
    th {
        border: 1px solid #ddd;
        text-align: left;

    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin: auto;
        margin-top: 50px;


    }

    th,
    td {
        padding: 15px;
        text-align: center;
    }

    tr>th {
        background-color: teal;
        color: white;
    }

    .studentData {
        width: 100%;
        background-color: green;
        padding: 15px;

    }

    #form1 {
        margin: auto;
        width: 80%;

    }

    #form1 input {
        padding: 10px;
        margin-right: 15px;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        border-radius: 5px;
    }

    #form1 input:focus {
        outline: none;
    }

    .td6 {
        display: flex;
        align-items: center;
        justify-content: center;


    }

    .td6>button {
        margin-right: 10px;
        color: white;
        border-radius: 5px;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
    }

    .td6>button:nth-child(1) {
        background-color: green;
    }

    .td6>button:nth-child(2) {
        background-color: red;
    }

    #absent {
        background-color: red;
    }
</style>

<!-- <div class="studentData mt-5">
    <form action="" id="form1">
        <input type="text" placeholder="Name" id="name" required>
        <input type="number" placeholder="Number" id="number" required>
        <input type="text" placeholder="City" id="city" required>
        <input type="number" placeholder="Roll No" id="rollNo" required>
        <input type="submit" class="btn btn-warning">
    </form>
</div> -->

<table class="tab" style="width: 90%;">
    <thead>
        <tr>
            <!-- <th>#</th> -->
            <th>Name</th>
            <th>Number</th>
            <th>Section</th>
            <th>Roll No.</th>
            <th>Attendence</th>
        </tr>
    </thead>
    <tbody id="tbody">

    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="./student.js"></script>

<?php
include('footer.php');
include('scripts.php');
?>