<?php ob_start(); ?>
    <div class="container">
        <h2 class="my-3">Inscription</h2>
        <form class="row my-auto form-floating" action="" method="POST">
            <?= $exeption ? 
                '<div class="alert alert-danger w-50" role="alert">' .
                    $exeption
                . '</div>' :
                null
            ?>
            <div class="mb-3 col-12">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input name="pseudo" id="pseudo" type="text" value='<?= filter_var($form["pseudo"]['value'], FILTER_SANITIZE_SPECIAL_CHARS) ?>' class="text-dark form-control <?= $form['email']['error'] ? 'is-invalid' : null ?>" aria-describedby="emailHelp">
                <p class="text-danger"><?= $form['pseudo']['error'] ?></p>
            </div>
            <div class="mb-3 col-12">
                <label for="email" class="form-label">Email address</label>
                <input name="email" id="email" type="email" value='<?= filter_var($form["email"]['value'], FILTER_SANITIZE_SPECIAL_CHARS) ?>' class="text-dark form-control <?= $form['email']['error'] ? 'is-invalid' : null ?>" aria-describedby="emailHelp">
                <p class="text-danger"><?= $form['email']['error'] ?></p>
            </div>
            <div class="mb-3 col-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="text-dark form-control <?= $form['password']['error'] ? 'is-invalid' : null ?>">
                <p class="text-danger"><?= $form['password']['error'] ?></p>
            </div>
            <div class="mb-3 col-6">
                <label for="confirm" class="form-label">Confirm your password</label>
                <input type="password" id="confirm" name="confirm" class="text-dark form-control <?= $form['confirm']['error'] ? 'is-invalid' : null ?>">
                <p class="text-danger"><?= $form['confirm']['error'] ?></p>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <div class="d-grid">
                <input type="submit" name="submit" class="btn btn-primary" />
            </div>
        </form>
    </div>
<?php 
    $content = ob_get_clean();
    $title    = "My-links - Inscription"; 
?>