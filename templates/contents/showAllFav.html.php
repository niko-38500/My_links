<?php ob_start() ?>
<h2 class="text-center m-2">
    Last added links
    <a href="/favorites?s=desc" id="sort-button"><i class="fas fa-sort"></i></a>
</h2>

<div id="hz-scroll"></div>
<div class="separator"></div>


<?php 
    $content = ob_get_clean();
    $title = "My-links - Acceuil";
    $script = "showAll.js";
?>