<?php

ob_start();
?>
<body>

<section class="filters">
        <h1>Appliquez des filtres</h1>
        <form action="/filtered/" method="POST">
            <div class="align">
                <label for="ingredient">Liste des plats contenant l'ingrédient suivant :</label>
                <select name="ingredient" id="ingredient">
                    <?php foreach ($ingredients as $ingredient) { ?>
                        <option value="<?= $ingredient->getIdIngredient() ?>"><?= $ingredient->getNomIngredient() ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="align">
                <label for="plat_keyword">Liste des plats contenant le mot suivant :</label>
                <input type="text" name="plat_keyword" id="plat_keyword">
            </div>

            <div class="align">
                <p>Liste des plats par fourchette de prix, par origine et par origine de plat</p>
                <label for="prix_min">Choisir prix mini :</label>
                <input type="number" name="prix_min" id="prix_min">
            </div>

            <div class="align">
                <label for="prix_max">Prix max</label>
                <input type="number" name="prix_max" id="prix_max">
            </div>

            <div class="align">
                <label for="plat_origine">Origine</label>
                <select id="plat_origine" name="plat_origine">
                    <?php
                    foreach ($produits as $produit) { ?>
                        <option value="<?= $produit->getIdOrigine() ?>"><?= $produit->getNomOrigine() ?></option>
                    <?php } ?>
                </select>
            </div>
                <input type="submit">
        </form>
    </section>
    
    </body>
<script>
    let showEdit = document.getElementsByClassName('showEdit');

    let enleveTodolist = document.getElementsByClassName('enleveTodolist');
    let afficheInput = document.getElementsByClassName('afficheInput');

    Array.from(showEdit).map(function(element, index) {
        element.addEventListener('click', function() {
            enleveTodolist[index].style.display = 'none';
            afficheInput[index].style.display = 'flex';
        })
    })

    let btnDelete = document.getElementById('btnDeleteList');
    let btnUndoDel = document.getElementById('btnUndoDel');
    let modalDelete = document.getElementById('modalDelete');

    btnDelete.addEventListener('click', function() {
        console.log(2);
        modalDelete.style.display = 'flex';
    });

    btnUndoDel.addEventListener('click', function() {
        console.log(2);
        modalDelete.style.display = 'none';
    });
</script>

<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
