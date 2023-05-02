<?php require __DIR__ . '/../partials/header.php' ?>

<?php require __DIR__ . '/../partials/navbar.php' ?>

<main class="container mt-4">

    <h4>Posts List</h4>

    <?php foreach ($posts as $post) : ?>
    <ul>
        <li>
            <a href="/posts/<?= $post->slug ?>">
                <?= $post->title ?>
            </a>
        </li>
        <li>
            <p>
                <?= $post->body ?>
            </p>
        </li>
    </ul>
    <?php endforeach; ?>

</main>


<?php require __DIR__ . '/../partials/footer.php' ?>