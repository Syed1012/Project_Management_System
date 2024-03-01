<?php
session_start();

if (!isset($_SESSION['reg_id'])) {
    header("Location: ../../login.php"); // Redirect to the login page
    exit();
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Project Management - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="#" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<?php include('header.php'); ?>

<div class="container mt-5">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Reg Id</th>
                <th scope="col">Student Name</th>
                <th scope="col">Review's attended</th>
                <th scope="col">Weekly Progress</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>row 1 data 1</td>
                <td>row 1 data 2</td>
                <td>row 1 data 3</td>
                <td>row 1 data 4</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>row 2 data 1</td>
                <td>row 2 data 2</td>
                <td>row 2 data 3</td>
                <td>row 2 data 4</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>row 3 data 1</td>
                <td>row 3 data 2</td>
                <td>row 3 data 3</td>
                <td>row 3 data 4</td>
            </tr>
            <tr>
                <th scope="row">4</th>
                <td>row 4 data 1</td>
                <td>row 4 data 2</td>
                <td>row 4 data 3</td>
                <td>row 4 data 4</td>
            </tr>
        </tbody>
    </table>
</div>

<?php include('scripts.php'); ?>