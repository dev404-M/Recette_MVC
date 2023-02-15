<?php
namespace Plat\Models;

class Plat {
    private $IDPRODUIT;
    private $NOMPRODUIT;

    private $IDTYPE;
    private $NOMTYPE;

    private $IDCATEGORIE;
    private $NOMCATEGORIE;

    private $IDORIGINE;
    private $NOMORIGINE;

    private $PRIXPRODUIT;
    PRIVATE $POIDSPRODUIT;

    private $IDINGREDIENT;
    private $NOMINGREDIENT;

    private $IDPANIER;
    private $QUANTITE;
    private $IDUSER;

    private $IDCOMMANDE;

    private $ingredients = [];

    public function getIdProduit(){
        return $this->IDPRODUIT;
    }
    
    public function getNomProduit(){
        return $this->NOMPRODUIT;
    }

    public function getIdUser(){
        return $this->IDUSER;
    }


    public function getIdType(){
        return $this->IDTYPE;
    }
    
    public function getNomType(){
        return $this->NOMTYPE;
    }


    public function getIdCategorie(){
        return $this->IDCATEGORIE;
    }

    public function getNomCategorie(){
        return $this->NOMCATEGORIE;
    }


    public function getIdOrigine(){
        return $this->IDORIGINE;
    }

    public function getNomOrigine(){
        return $this->NOMORIGINE;
    }


    public function getPrixProduit(){
        return $this->PRIXPRODUIT;
    }

    public function getPoidsProduit(){
        return $this->POIDSPRODUIT;
    }

    public function getIdIngredient(){
        return $this->IDINGREDIENT;
    }

    public function getNomIngredient(){
        return $this->NOMINGREDIENT;
    }

    public function getIdPanier(){
        return $this->IDPANIER;
    }
    
    public function getQuantite(){
        return $this->QUANTITE;
    }

     
    public function getIdCommande(){
        return $this->IDCOMMANDE;
    }
    //SETTERS

    public function setIdProduit($IDPRODUIT)
    {
        $this->IDPRODUIT = $IDPRODUIT;
    }

    public function setNomProduit($NOMPRODUIT)
    {
        $this->NOMPRODUIT = $NOMPRODUIT;
    }


    public function setIdType($IDTYPE)
    {
        $this->IDTYPE = $IDTYPE;
    }

    public function setNomType($NOMTYPE)
    {
        $this->NOMTYPE = $NOMTYPE;
    }


    public function setIdCategorie($IDCATEGORIE)
    {
        $this->IDCATEGORIE = $IDCATEGORIE;
    }

    public function setNomCategorie($NOMCATEGORIE)
    {
        $this->NOMCATEGORIE = $NOMCATEGORIE;
    }


    public function setIdOrigine($IDORIGINE)
    {
        $this->IDORIGINE = $IDORIGINE;
    }

    public function setNomOrigine($IDORIGINE)
    {
        $this->IDORIGINE = $IDORIGINE;
    }

    

    public function setPrixProduit($PRIXPRODUIT)
    {
        $this->PRIXPRODUIT = $PRIXPRODUIT;
    }

    public function setPoidsProduit($POIDSPRODUIT)
    {
        $this->POIDSPRODUIT = $POIDSPRODUIT;
    }

    public function setIdIngredient($IDINGREDIENT)
    {
        $this->IDINGREDIENT = $IDINGREDIENT;
    }

    public function setNomIngredient($NOMINGREDIENT)
    {
        $this->NOMINGREDIENT = $NOMINGREDIENT;
    }

    
    public function setIdPanier($IDPANIER)
    {
        $this->IDPANIER = $IDPANIER;
    }

    
    public function setQuantite($QUANTITE)
    {
        $this->QUANTITE = $QUANTITE;
    }

    public function setIdCommande($IDCOMMANDE)
    {
        $this->IDCOMMANDE = $IDCOMMANDE;
    }
 
    //Function appelle getProductsIngredients en envoyant param IDPRODUIT
    public function getIngredients(){
        $manager = new PlatManager();
        $this->ingredients = $manager->getProductsIngredients($this->getIdProduit());
        return $this->ingredients;
    }
}
?>