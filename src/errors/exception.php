<html>
    <head>
        <title><?php echo $error_message; ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5">
            <h1 class="mb-4"><?php echo $error_message; ?></h1>
            <p class="mb-3">Message: <?php echo $exception->getMessage(); ?></p>
            <p class="mb-3">File: <?php echo $file; ?></p>
            <p class="mb-3">Line: <?php echo $line; ?></p>
            <h2 class="mb-3">Stack Trace:</h2>
            <pre><?php echo $trace; ?></pre>
        </div>
    </body>
</html>
