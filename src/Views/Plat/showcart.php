<?php
ob_start();
?>
<body>


<section class="cart">
    <form action="/actionCart/" method="POST">
        <table>
            <thead>
                <tr>
                    <th>Quantité</th>
                    <th>Plat</th>
                    <th>Prix</th>
                    <th>Total</th>
                    <th>Supprimer</th>
                    <th>Modifier quantité</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalCart = 0;
                foreach ($panier as $value) {
                    if ($_SESSION['user']['id'] == $value->getIdUser()) { ?>
                        <tr>
                        <td><input type="number" id="quantite" value="<?= $value->getQuantite() ?>" name="quantite"></td>
                        <input type="hidden" value="<?= $value->getIdPanier() ?>" name="idpanier">
                        <td><?= $value->getNomProduit() ?></td>
                        <?php if ($value->getPrixProduit() * $value->getQuantite() < 1) { ?>
                            <td><?= $value->getPrixProduit() ?> ct d'€</td>
                            <td><?= $value->getQuantite() * $value->getPrixProduit() ?>ct d'€</td>
                        <?php } else if ($value->getPrixProduit() < 1) { ?>
                            <td><?= $value->getPrixProduit() ?> ct d'€</td>
                            <td><?= $value->getQuantite() * $value->getPrixProduit() ?> €</td>
                        <?php  } else { ?>
                            <td><?= $value->getPrixProduit() ?> €</td>
                            <td><?= $value->getQuantite() * $value->getPrixProduit() ?> €</td>
                        <?php } ?>
                        <td><button type="submit" value="<?= $value->getIdPanier() ?>" name="delete"><i class="fa-regular fa-trash-can"></i></button></td>
                        <td><button type="submit" value="<?= $value->getIdPanier() ?>" name="update"><i class="fa-solid fa-arrow-up-1-9"></i></button></td>
                    </tr>
                   <?php } ?>
            
                  
                <?php
                    $totalCart += $value->getPrixProduit() * $value->getQuantite();
                } ?>
            </tbody>
        </table>
        <?php if ($totalCart <= 0) {
        ?>
            <h1>Vous n'avez aucun article dans votre panier ! <a href="/">Ajoutez-en ici</a></h1>
        <?php } else { ?>
            <p><?= $totalCart ?></p>
        <?php } ?>
        <button type="submit" value="<?= $_SESSION['user']['id'] ?>" name="confirmOrder">Valider la commande</button>
    </form>
</section>
</body>
<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';