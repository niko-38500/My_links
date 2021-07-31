<?php ob_start() ?>

<div class="container">
    <h2 class="my-4">Connexion</h2>
    <?= $form['email']['error'] ? '<div class="alert alert-danger">' . $form['email']['error'] . '</div>' : null ?>
    <form method="POST" action="">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input name='email' type="email" class="form-control text-dark" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input name="password" type="password" class="form-control text-dark" id="exampleInputPassword1">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input text-dark" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <div class="d-grid">
        <input type="submit" name="submit" class="btn btn-primary" />
    </div>
    
    </form>
</div>

<?php 
$content = ob_get_clean();
$title = "Connexion - My-links";
?>