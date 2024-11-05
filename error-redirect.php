<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 - Page Not Found</title>
</head>
<body>
    <h1>404 - Page Not Found</h1>
    <p>Sorry, the page you are looking for does not exist. You will be redirected to the homepage in a few seconds.</p>
    <script>
        // Redirect to homepage after 5 seconds
        setTimeout(function() {
            window.location.href = "/";
        }, 5000);
    </script>
</body>
</html>
