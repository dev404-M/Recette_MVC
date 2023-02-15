<?php
ob_start();

?>

<section class="error">
    <h1>Erreur de commande</h1>
    <p>Votre panier est vide, ajoutez une quantité puis réessayez <a href="/">Ajoutez des articles à votre panier ici</a></p>
</section>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
