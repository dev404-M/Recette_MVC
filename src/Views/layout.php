<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>— Plats —</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&family=Roboto:ital,wght@0,300;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/style.css">
    <script src="https://kit.fontawesome.com/6e59f38135.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav>
            <?php
            echo "<br>";
            if (!isset($_SESSION['user']['id'])) {
            ?>
                <ul>
                    <li>
                        <a href="/login" class="icon"><i class="fa-regular fa-user"></i>Login</a>
                    </li>
                </ul>

                <!--<p class="hidden">Login</p>-->

            <?php
            } else {

            ?>
                <ul>
                    <li>
                        <a href="/" class="icon"><i class="fa-light fa-house"></i>Plats</a>
                    </li>
  
                    <li>
                        <a href="#" class="icon"><i class="fa-regular fa-user"></i>
                        <?php echo $_SESSION["user"]["code_client"]; ?></a>
                      
                    </li>

                    <li>
                        <a href="/filters/" class="icon"><i class="fa-solid fa-list"></i>Filtres</a>
                    </li>

                    <li><a href="/logout" class="icon"><i class="fas fa-power-off"></i>Logout</a></li>
                </ul>
            <?php
            }
            ?>
        </nav>
    </header>

    <main>
        <?php echo $content; ?>
    </main>
</body>

</html>
<?php
unset($_SESSION['error']);
unset($_SESSION['old']);
