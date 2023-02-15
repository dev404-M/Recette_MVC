<?php
ob_start();
?>

<body>
    <h1>Liste des plats</h1>
    <div class="align">
        <a href="/filters/">Filtrez les plats ici</a><br>
        <a href="/showcart/">Visualiser le panier</a>
    </div>
    

    <section class="showListPlat">
        <?php
        foreach ($produits as $produit) { ?>
            <article>
                <div class="align">
                    <h2><?= $produit->getNomProduit() ?></h2>
                    <p><?= $produit->getNomType() ?></p>

                    <form action="/addToCart/" method="POST" class="align">
                        <label for="quantite">Quantité: </label>
                        <input type="number" value="1" name="quantite">
                        <input type="hidden" value="<?= $produit->getIdProduit() ?>" name="idproduit">
                        <input type="hidden" value="<?= $_SESSION['user']['id'] ?>" name="iduser">
                        <label for="cart"></label>
                        <button type="submit">Ajouter au panier</button>
                    </form>
                </div>

                <p>Prix: <?= $produit->getPrixProduit() ?>€</p>
                <p><?= $produit->getNomCategorie() ?>: <span><?= $produit->getPoidsProduit() ?></span></p>
                <p>Origine: <?= $produit->getNomOrigine() ?></p>
                <p>Ingrédients:
                    <?php
                    foreach ($produit->getIngredients() as $ingredients_produit) { ?>
                        <?= $ingredients_produit->getNomIngredient() ?>
                    <?php } ?>
                </p>
            </article>
        <?php  } ?>
    </section>

</body>
<script>
    let container = document.getElementById('masonry');

    let nb_col = window.innerWidth > 1024 ? 3 : window.innerWidth > 768 ? 3 : 1;

    let col_height = [];

    for (var i = 0; i <= nb_col; i++) {
        col_height.push(0);
    }

    for (var i = 0; i < container.children.length; i++) {
        let order = (i + 1) % nb_col || nb_col;
        container.children[i].style.order = order;
        col_height[order] += container.children[i].clientHeight;
    }
    container.style.height = Math.max.apply(Math, col_height) + 50 + 'px';
</script>
<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
