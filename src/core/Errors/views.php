<!DOCTYPE html>
<html>

<head>
    <title><?php echo $title; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<body>
    <div class="container mt-5">
        <div class="alert alert-danger">
            <h1><?php echo $title; ?></h1>
            <p class="fs-5"><?php echo $error_message; ?></p>
            <p>File: <code><?php echo $file; ?></code></p>
            <p>Line: <code><?php echo $line; ?></code></p>
            <?php if (!empty($trace)) : ?>
            <h2>Trace</h2>
            <ul>
                <?php foreach ($trace as $item) : ?>
                <li>
                    <?php echo $item['file']; ?>:<?php echo $item['line']; ?>
                    <?php if (isset($item['class'])) : ?>
                    (<?php echo $item['class']; ?><?php echo $item['type']; ?><?php echo $item['function']; ?>)
                    <?php else : ?>
                    (<?php echo $item['function']; ?>)
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

</body>

</html>