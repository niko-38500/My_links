<?php ob_start() ?>
<h2 class="text-center m-2">
    Your links
    <a href="/?s=desc" id="sort-button"><i class="fas fa-sort"></i></a>
</h2>
<div class="text-center container mt-4">
    <form action="/add" method="GET">
        <input type="url" name="fav" class="form-control d-inline text-dark" placeholder="https://">
        <input type="submit" value="Ajouté" class="form-control btn btn-outline-secondary">
    </form>
</div>

<div id="hz-scroll"></div>
<div class="separator"></div>

<?php 
    $content = ob_get_clean();
    $title = "My-links - Acceuil";
    $script = "home.js";
?>