<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GITAM PMS</title>

    <link rel="stylesheet" href="assets/css/bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <style>
        .error-container {
            position: fixed;
            top: 110px;
            /* Adjust the top position as needed */
            left: 50%;
            transform: translateX(-50%);
            background-color: #f44336;
            /* Red background color */
            color: white;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            opacity: 0;
            /* Initially hidden */
            transition: opacity 0.5s;
            /* Fade in/out effect */
            z-index: 1000;
            /* Ensure it's above other elements */
        }

        .error-message {
            margin: 0;
        }
    </style>

</head>

<body>