<?php
namespace Plat\Models;

use Plat\Models\Plat;
use Plat\Models\User;

/** Class UserManager **/
class PlatManager
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new \PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
        $this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    public function getAllProduits() //Sélectionne tous les produits avec type, origine, catégorie
    {
        $stmt = $this->bdd->prepare('SELECT * FROM produit JOIN type ON type.IDTYPE = produit.IDTYPE JOIN categorie ON categorie.IDCATEGORIE = produit.IDCATEGORIE JOIN origine ON origine.IDORIGINE = produit.IDORIGINE');
        $stmt->execute(array());
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Plat\Models\Plat");
    }

    public function getAllIngredients() //Sélectionne tous les ingrédients
    {
        $stmt = $this->bdd->prepare('SELECT * FROM ingredients');
        $stmt->execute(array());
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Plat\Models\Plat");
    }

    public function getProductsIngredients($idproduit) //Sélectionne tous les ingrédients pour chaque produit
    {
        $stmt = $this->bdd->prepare('SELECT * FROM ingredients JOIN contenir ON contenir.IDINGREDIENT = ingredients.IDINGREDIENT JOIN produit ON contenir.IDPRODUIT = produit.IDPRODUIT WHERE contenir.IDPRODUIT = :IDPRODUIT');
        $stmt->execute(array(
            'IDPRODUIT' => $idproduit,
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Plat\Models\Plat");
    }


    public function addToCart($IDPANIER, $IDUSER, $IDPRODUIT, $QUANTITE) //Insert Produits dans le panier
    {
        $stmt = $this->bdd->prepare('INSERT INTO panier VALUES(:IDPANIER, :IDUSER, :IDPRODUIT, :QUANTITE)');
        $stmt->execute(array(
            'IDPANIER' => $IDPANIER,
            'IDUSER' => $IDUSER,
            'IDPRODUIT' => $IDPRODUIT,
            'QUANTITE' => $QUANTITE,
        ));
    }

    public function showPanier()
    { //Affiche produits du panier
        $stmt = $this->bdd->prepare('SELECT * FROM panier JOIN produit ON panier.IDPRODUIT = produit.IDPRODUIT');
        $stmt->execute(array());
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Plat\Models\Plat");
    }

    public function delete()
    { //Supprime produit du panier
        $stmt = $this->bdd->prepare('DELETE FROM panier WHERE IDPANIER = ? OR IDUSER = ?');
        $stmt->execute(array(
            $_POST['delete'],
            $_POST['confirmOrder'],
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Plat\Models\Plat");
    }


    public function update()
    { //Modifie quantite du panier (non fonctionnel)
        $stmt = $this->bdd->prepare('UPDATE panier SET QUANTITE = ? WHERE IDPANIER = ?');
        $stmt->execute(array(
            $_POST['quantite'],
            $_POST['update'],
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Plat\Models\Plat");
    }


    public function confirmOrder($uuid)
    { //Valide la commande, supprime de panier, insert commander
        $panier = $this->showPanier();
        foreach ($panier as $value) {
            $stmt = $this->bdd->prepare('INSERT INTO commander (IDPRODUIT, IDUSER, QUANTITE, IDCOMMANDE, DATE) VALUES (:IDPRODUIT, :IDUSER, :QUANTITE, :IDCOMMANDE, :DATE)');
            $stmt->execute(array(
                'IDPRODUIT' => $value->getIdProduit(),
                'IDUSER' => $_SESSION['user']['id'],
                'QUANTITE' => $value->getQuantite(),
                'IDCOMMANDE' => $uuid,
                'DATE' => date('Y-m-d H:i:s'),
            ));
        }
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Plat\Models\Plat");
    }
}
