# Recette_Lyon_MVC_A2

- rendre tâche, sous-tâche, estimation du temps
- Faire MCD, MLD
- scss ou sass
- rendre bdd et readme

## Etape 1 - MCD - MLD Construction Base de données (1h)
Sur PowerAMC, construire la structure de la base puis l'importer dans phpmyadmin (correction commune)

### MCD (40m)
### MLD (40m)

## Etape 2 - La structure de fichiers (15min)
```
Recette
    public/
        index.php
        style.css
    src/
        Controllers/
            MenuController.php
            UserController.php
        Models/
            Menu.php
            User.php
            UserManager.php
            MenuManager.php
        Views/
            Recette/
                index.php
                show.php
                create.php
        Router.php
```

## Etape 3 - Composer et l'autoloading (5min)

- Initialiser le dossier comme étant un projet composer

```shell
$ composer init  # crée le fichier composer.json
$ composer install # install l'autoloader
```

- Remplir le fichier composer avec la règle d'autoloading

```json
"autoload": {
    "psr-4": {
        "RootName\\": "src/"
    }
}
```

- Réinitialiser l'autoloader

```shell
$ composer dump-autoload
```

//lancer php -S localhost:8000 dans le dossier public

## Fonctionnalités

### Client : Insertion client (2h)
### Connexion clients (id, password) avec accès aux précédentes commandes (1h), sessions ###utilisateur, Panier de commande (3h),
###
### Menus: Plats (2h), ingrédients(2h), prix(2h), quantité(2h), régime(2h)
## Estimation globale (30h)


## VIEWS AND ROUTES :
- / (index) = main page, if login display list of products (showAll), else require login form
- /filters/ (showFilters) = filters page
- /filtered/ (showFiltered) = display products depending on applied filters