<?php
include('includes/header.php');
include('includes/navbar.php');
?>

<style>
    body {
        background-image: url('');
        /* Replace 'path_to_your_image.jpg' with the actual path to your image */
        background-size: 100% 100%;
        background-position: center center;
        background-attachment: fixed;
    }

    .center-content {
        height: calc(100vh);
        /* Adjust [header-height] to the actual height of your header */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .TEXT {
        font-size: 110px;
        font-weight: bolder;
        color: brown;
    }
</style>

<div class="container-fluid">
    <div class="row center-content">
        <div class="col-md-12 mb-5">
            <h3 class="TEXT">Welcome</h3>
            <a href="login.php" class="btn  mt-3" style="padding: 10px; font-weight: bolder; background-color: brown; color: black;" onmouseover="this.style.backgroundColor='black'; this.style.color='white';" onmouseout="this.style.backgroundColor='brown'; this.style.color='black';">LOGIN</a>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>