<?php

namespace Plat\Controllers;

use Plat\Models\PlatManager;
use Plat\Models\UserManager;
use Plat\Validator;

class PlatController
{
    private $manager;
    private $usermanager;
    private $validator;

    public function __construct()
    {
        $this->manager = new PlatManager();
        $this->usermanager = new UserManager();
        $this->validator = new Validator();
    }

    public function checkSession()
    {
        if (!isset($_SESSION['user']['id'])) {
            header("Location: /login");
            die();
            if ($_SESSION['user']['id'] == "0") {
                header("Location: /login");
            }
        }
    }

    public function index()
    {
        $this->checkSession();
        $this->showAll();
    }


    public function showAll()
    { //Affiche tous les plats et leurs ingrédients
        $this->checkSession();
        $produits = $this->manager->getAllProduits();
        $ingredients = $this->manager->getAllIngredients();
        require VIEWS . 'Plat/index.php';
    }


    public function showFilters()
    { //Affiche page filtres (non fonctionnels)
        $this->checkSession();
        $produits = $this->manager->getAllProduits(); //Variable sur laquelle on boucle pour récupérer les produits
        $ingredients = $this->manager->getAllIngredients(); //Variable sur laquelle on boucle pour récupérer les ingrédients
        //$prix_min = $_POST['prix_min']; //Compare prix produit
        //$prix_max = $_POST['prix_max']; //Compare prix produit
        //$plat_origine = $_POST['plat_origine']; //Vérifie origine plat
        //$ingredient = $_POST['ingredient']; //Vérifie présence ingrédient dans un plat
        /*$content = $this->manager->($slug, $_SESSION["user"]["id"]);
        if (!$Plat) {
            header("Location: /error");
        }*/
        require VIEWS . 'Plat/filters.php';
    }

    public function showFiltered()
    { //Affiche les plats correspondants aux filtres (non fonctionnels)
        $this->checkSession();
        require VIEWS . 'Plat/filtered.php';
    }

    public function addToCart()
    { //Ajoute articles panier
        $this->checkSession();
        $IDPANIER = uniqid();
        $IDUSER = $_POST['iduser'];
        $IDPRODUIT = $_POST['idproduit'];
        $QUANTITE = $_POST['quantite'];
        $this->manager->addToCart($IDPANIER, $IDUSER, $IDPRODUIT, $QUANTITE);
        header('Location: /showcart/');
    }

    public function showCart()
    { //Affiche panier
        $this->checkSession();
        $panier = $this->manager->showPanier();
        require VIEWS . 'Plat/showcart.php';
    }

    
    public function emptyCart()
    { 
       require VIEWS . 'Plat/emptycart.php';
    }

    public function actionCart()
    { //Selon $_POST envoyé au panier
        $this->checkSession();
        if (isset($_POST['delete'])) { //Supprime ligne
            $delete = $this->manager->delete();
            $panier = $this->manager->showPanier();
            header('Location: /showcart/');
        }
         else if (isset($_POST['update'])) { //Modifie quantité (non fonctionnel)
            $update = $this->manager->update();
            $panier = $this->manager->showPanier();
            header('Location: /showcart/');
        } 
        else if (isset($_POST['confirmOrder'])) { //Insert dans commander, delete from panier
            if ($_POST['quantite'] != 0) {
                $uuid = uniqid();
                $confirmOrder = $this->manager->confirmOrder($uuid);
                $delete = $this->manager->delete();
                header('Location: /');
            } else {
                require VIEWS . 'Plat/emptycart.php';
            }

        } else if (isset($_POST['menu'])) {
            require VIEWS . 'Plat/index.php';
        }
    }
}
