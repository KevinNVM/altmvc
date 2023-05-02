<?php require __DIR__ . '/../partials/header.php' ?>

<?php require __DIR__ . '/../partials/navbar.php' ?>

<main class="container mt-4">

    <h4><?= $post->title ?></h4>

    <p>
        <?= $post->body ?>
    </p>

</main>


<?php require __DIR__ . '/../partials/footer.php' ?>