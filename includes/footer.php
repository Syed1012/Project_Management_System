<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap5.bundle.min.js"></script>
<script src="assets/js/scripts.js"></script>



<script>
    // Check if an error message exists
    var errorMessage = "<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : '' ?>";
    if (errorMessage) {
        // Display the error message
        var errorContainer = document.getElementById('error-container');
        var errorMessageElement = document.getElementById('error-message');
        errorMessageElement.innerHTML = errorMessage;
        errorContainer.style.opacity = '1';

        // Hide the error message after 0.5 seconds
        setTimeout(function() {
            errorContainer.style.opacity = '0';
        }, 1500);
    }
</script>
</body>

</html>



</body>

</html>