<?php require __DIR__ . '/partials/header.php' ?>

<?php require __DIR__ . '/partials/navbar.php' ?>

<main class="container mt-4">
    
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Welcome To <?= $app_name ?> <code><small>V<?= $framework_version ?></small></code></h4>
  <p>
  Congratulations! You have successfully installed our framework. We hope that it will help you to create amazing web applications with ease. Our framework is designed to be simple, flexible, and easy to use. We believe that you will find it to be a powerful tool that will allow you to create great things. We are excited to see what you will create with our framework, and we wish you the best of luck in all of your future projects!
  </p>
  <hr>
  <p class="mb-0">
    Visit documentation : <a target="_blank" href="https://kevinnvm.github.io/">https://kevinnvm.github.io/</a>  
</p>
<ul>
  <li>PHP Version : <?= $php_version ?></li>
  <li>AltMVC Version : <?= $framework_version ?></li>
</ul>
</div>

</main>


<?php require __DIR__ . '/partials/footer.php' ?>
