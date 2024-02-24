<?php
include('includes/header.php');
include('includes/navbar.php');
?>

<style>
    /* Importing fonts from Google */
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");

    /* Reseting */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        background: #ecf0f3;
    }

    .wrapper {
        max-width: 320px;
        min-height: 300px;
        margin: 80px auto;
        padding: 40px 30px 30px 30px;
        background-color: #ecf0f3;
        border-radius: 15px;
        box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
    }

    .logo {
        width: 80px;
        margin: auto;
    }

    .logo img {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0px 0px 3px brown, 0px 0px 0px 5px #ecf0f3,
            8px 8px 15px #a7aaa7, -8px -8px 15px #fff;
    }

    .wrapper .name {
        font-weight: 600;
        font-size: 1.4rem;
        letter-spacing: 1.3px;
        padding-left: 10px;
        color: #555;
    }

    .wrapper .form-field input {
        width: 100%;
        display: block;
        border: none;
        outline: none;
        background: none;
        font-size: 1.2rem;
        color: #666;
        padding: 10px 15px 10px 10px;
    }

    .wrapper .form-field {
        padding-left: 10px;
        margin-bottom: 20px;
        border-radius: 20px;
        box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
    }

    .wrapper .form-field .fas {
        color: #555;
    }

    .wrapper .btn {
        box-shadow: none;
        width: 100%;
        height: 40px;
        background-color: brown;
        color: black;
        font-weight: bolder;
        border-radius: 25px;
        box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
        letter-spacing: 1.3px;
    }

    .wrapper .btn:hover {
        background-color: black;
        color: white;
    }

    .wrapper a {
        padding-left: 15px;
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: bolder;
        color: brown;
    }

    .wrapper a:hover {
        color: black;
    }

    .popup-message {
        display: none;
        position: fixed;
        top: 30%;
        left: 90%;
        transform: translate(-50%, -50%);
        background-color: brown;
        color: white;
        font-weight: bolder;
        padding: 15px;
        border-radius: 5px;
        z-index: 9999;
    }

    @media (max-width: 380px) {
        .wrapper {
            margin: 30px 20px;
            padding: 40px 15px 15px 15px;
        }
    }
</style>



<div class="wrapper py-5">
    <div class="logo">
        <img src="assets/Images/GITAM-logo.jpg" alt="" />
    </div>

    <div class="text-center mt-4 name">GITAM PMS</div>
    <br>

    <!-- ... (your existing HTML content) ... -->
    <form method="POST" action="">
        <div class="form-field d-flex align-items-center">
            <span class="far fa-envelope"></span>
            <input type="email-id" name="email" placeholder="Enter Email Address" />
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn">Submit</button>
        </div>

        <div class="text-center fs-6 mt-3">
            <a href="login.php">Already have an account?</a>
        </div>
    </form>
</div>

<!-- Add a div for the popup message -->
<div class="popup-message" id="popupMessage">
    Email sent.
</div>

<!-- Add a div for the error message -->
<div class="popup-message error-message" id="errorMessage">
    provide an Email.
</div>



<!-- JavaScript for the popup and redirection -->
<script>
    // Get the popup message element by its id
    const popupMessage = document.getElementById('popupMessage');
    const errorMessage = document.getElementById('errorMessage');

    // Function to show the popup message for 2 seconds and then hide
    function showMessage(messageElement, message, duration) {
        messageElement.textContent = message;
        messageElement.style.display = 'block'; // Show the message
        setTimeout(function () {
            // Hide the message after the specified duration
            messageElement.style.display = 'none';
        }, duration);
    }

    // Function to show the "Email sent" message and redirect
    function showPopupAndRedirect() {
        showMessage(popupMessage, 'Email sent.', 2000); 
        // Redirect to login.php after 2 seconds
        setTimeout(function () {
            window.location.href = 'login.php';
        }, 2000); // Adjusted the timing here to match the message duration
    }

    // Add a submit event listener to the form
    const form = document.querySelector('form');
    form.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission
        const emailInput = form.querySelector('input[name="email"]');
        const emailValue = emailInput.value.trim();
        if (emailValue === '') {
            // If email is empty, show the error message and return
            showMessage(errorMessage, 'Provide an Email.', 2000); // Show the error message for 2 seconds
            return;
        }
        // You can add code here to send an email if needed
        // Call the function to show the popup and redirect
        showPopupAndRedirect();
    });
</script>

<?php
include('includes/footer.php');
?>