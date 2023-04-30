<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $error_message ?></title>
        <!-- Include Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5">
            <div class="alert alert-danger">
                <h1><?= $title ?></h1>
                <p>Message: <?php echo $error['message'] ?></p>
                <p>File: <?php echo $file ?></p>
                <p>Line: <?php echo $line ?></p>
            </div>
            <h2>Stack Trace:</h2>
            <div class="list-group">
                <?php foreach ($trace as $item): ?>
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?php echo $item['file'] ?></h5>
                            <small><?php echo $item['line'] ?></small>
                        </div>
                        <?php if (isset($item['class'])): ?>
                            <p class="mb-1"><?php echo $item['class'] . $item['type'] . $item['function'] . '()' ?></p>
                        <?php else: ?>
                            <p class="mb-1"><?php echo $item['function'] . '()' ?></p>
                        <?php endif; ?>
                        <?php if (!empty($item['args'])): ?>
                            <small>Arguments:</small>
                            <ul>
                                <?php foreach ($item['args'] as $arg): ?>
                                    <li><?php echo var_export($arg, true) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>
