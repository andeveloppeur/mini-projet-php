<?php
session_start();
?>
<!DOCTYPE html>
<html lang="FR-fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/MonStyle.css">
    <title>Site</title>
</head>

<body>
    <nav class="container nav nav-pills nav-fill">
        <a class="nav-link  nav-item" href="accueil.php">Accueil</a>
        <a class="nav-link nav-item" href="listerProduits.php">Liste</a>
        <a class="nav-link nav-item" href="rechercherProduits.php">Recherche</a>
        <a class="nav-link active nav-item" href="ajouterProduit.php">Ajouter</a>
        <a class="nav-link nav-item" href="updateProduit.php">Modifier</a>
        <a class="nav-link nav-item" href="supprimerProduit.php">Supprimer</a>
        <a class="nav-link nav-item" href="../index.php">Déconnexion</a>
    </nav>
    <header></header>
    <section class="container corps">
        <?php
        $produits = array(
            array("Orange", "Pomme", "Mangue", "Citron", "Banane", "Pasteque", "Melon", "Cerise", "Fraise", "Poire"),
            array("Orange" => 500, "Pomme" => 9, "Mangue" => 456, "Citron" => 1000, "Banane" => 254, "Pasteque" => 450, "Melon" => 258, "Cerise" => 457, "Fraise" => 365, "Poire" => 7),
            array("Orange" => 1000, "Pomme" => 800, "Mangue" => 750, "Citron" => 450, "Banane" => 850, "Pasteque" => 1500, "Melon" => 1750, "Cerise" => 1250, "Fraise" => 900, "Poire" => 1550)
        );

        ?>
        <form action="ajouterProduit.php" method="POST" class="tab row">
            <div class="col-md-3"></div>
            <div class="col-md-6 bor">
                <?php
                $nouvPro = "";
                $totalMont = 0;
                $totalQuant = 0;
                $Totprix = 0;
                $prodExiste = 0;
                $ajout_reussi = 0;
                $nouvQuant = "";
                $nouvPrix = "";

                if (isset($_POST["valider"])) {

                    $nouvPro = $_POST["produit"]; //recupere le nom du produit saisi dans le formulaire via le tableau $_POST
                    $nouvQuant = $_POST["quantite"];
                    $nouvPrix = $_POST["prix"];
                    for ($i = 0; $i < count($produits[0]); $i++) { //casse
                        if (!strcasecmp($nouvPro, $produits[0][$i])) { //pour gerer la casse
                            $nouvPro = $produits[0][$i];
                        }
                    }
                    for ($i = 0; $i < count($produits[0]); $i++) { //permet de parcourir tout le tableau (count renvoi la taille du tableau)
                        if ($produits[0][$i] == $nouvPro) { //verifie si le produit à ajouter n existe pas deja
                            $prodExiste = 1; //si existe deja le variable $prodExiste=1 cela nous permettra de bloquer l'ajout
                        }
                    }

                    if ($prodExiste == 0 && $nouvPro != "" && $_POST["quantite"] >= 0 && $_POST["prix"] >= 100) {
                        $ajout_reussi = 1;
                    }
                }
                echo '<div class="row">
                            <div class="col-md-2"></div>
                            <input class="form-control col-md-8 espace ';
                if (isset($_POST["valider"]) && $nouvPro == "" || $prodExiste == 1) {
                    echo 'rougMoins';
                }
                echo '" type="text" id="produit" name="produit"';
                if (isset($_POST["valider"]) && $nouvPro == "") {
                    echo 'placeholder="Remplir le nom du produit"';
                } //si on envoi ajoute un produit sans remplir le nom du produit
                elseif ($prodExiste == 1) {
                    echo ' placeholder="' . $nouvPro . ' existe déja" value=""';
                } //si le produit existe deja
                elseif ($ajout_reussi == 1) {
                    echo ' placeholder="Nom produit" value=""';
                } //si ajout reussi
                elseif (isset($_POST["valider"]) && $nouvPro != "" && $prodExiste == 0) {
                    echo 'value="' . $nouvPro . '"';
                } //si il y a une erreur dans la quantité ou le prix garder le nom du produit saisi
                elseif ($prodExiste == 0) {
                    echo ' placeholder="Nom produit" value=""';
                }
                echo '>'; //lors du chargement de la page
                echo '</div>';


                echo '<div class="row">
                            <div class="col-md-2"></div>
                            <input class="form-control col-md-8 espace ';
                if (isset($_POST["valider"]) && $nouvQuant < 0 || isset($_POST["valider"]) && $nouvQuant == "") {
                    echo 'rougMoins';
                }
                echo '" type="number" id="quantite" name="quantite"';
                if ($nouvQuant == "" && isset($_POST["valider"])) {
                    echo ' placeholder="Remplir la quantité"';
                } elseif ($nouvQuant < 0 && $nouvQuant != "") {
                    echo ' placeholder="Impossible car ' . $nouvQuant . ' est inférieur à 0"';
                } elseif ($ajout_reussi == 1) {
                    echo ' placeholder="Quantité" value=""';
                } //si ajout reussi
                elseif ($nouvQuant >= 0 && isset($_POST["valider"])) {
                    echo ' value="' . $nouvQuant . '"';
                } elseif ($nouvQuant == "") {
                    echo ' placeholder="Quantité" value=""';
                }
                echo '>'; //lors du chargement de la page
                echo '</div>';


                echo '<div class="row">
                            <div class="col-md-2"></div><input class="form-control col-md-8 espace ';
                if (isset($_POST["valider"]) && $nouvPrix < 100 || isset($_POST["valider"]) && $nouvPrix == "") {
                    echo 'rougMoins';
                }
                echo '" type="number" id="prix" name="prix"';
                if ($nouvPrix == "" && isset($_POST["valider"])) {
                    echo ' placeholder="Remplir le prix"';
                } elseif ($nouvPrix < 100 && $nouvPrix != "") {
                    echo ' placeholder="Impossible car ' . $nouvPrix . ' est inférieur à 100"';
                } elseif ($ajout_reussi == 1) {
                    echo ' placeholder="Prix" value=""';
                } //si ajout reussi
                elseif ($nouvPrix >= 100 && isset($_POST["valider"])) {
                    echo ' value="' . $nouvPrix . '"';
                } elseif ($nouvPrix == "") {
                    echo ' placeholder="Prix" value=""';
                }
                echo '>'; //lors du chargement de la page
                echo '</div>';
                ?>
                <div class="row">
                    <div class="col-md-3"></div>
                    <input type="submit" class="form-control col-md-6 espace" value="Ajouter" name="valider">
                </div>
            </div>
        </form>
        <table class="col-12 liste mb5 table">
            <thead class="thead-dark">
                <tr class="row PourHover">
                    <!--creation d'une ligne-->
                    <td class="col-md-1 text-center gras">N°</td>
                    <td class="col-md-3 text-center gras">Produit</td>
                    <!--creation d'une colonne-->
                    <td class="col-md-3 text-center gras">Quantité</td>
                    <td class="col-md-2 text-center gras">Prix</td>
                    <td class="col-md-3 text-center gras">Montant</td>
                </tr>
            </thead>
            <?php
            function format($n)
            { //permet d afficher le separateur de millier ex : 10 000
                return strrev(wordwrap(strrev($n), 3, ' ', true)); //strrev permet de renverser une chaine de caractere et wordwrap permet d inserer l espace
            }
            if ($nouvPro != "" && $nouvQuant >= 0 && $nouvPrix >= 100 && $prodExiste == 0) { //pour eviter d'ajouter un element vide dans le tableau lorsque la page sera actualiser et que $nouvPro sera vide
                array_push($produits[0], $nouvPro); //array_push permet d ajouter un element au tableau
                $produits[1][$nouvPro] = $nouvQuant; //ajout d'une nouvelle quantité qui aura comme clef le nom du produit 
                $produits[2][$nouvPro] = $nouvPrix; //même chose
            }
            $j = 0;
            for ($i = 0; $i < count($produits[0]); $i++) { //permet de parcourir tout le tableau (count renvoi la taille du tableau)
                $leProdruit = $produits[0][$i];
                $laQuantite = $produits[1][$leProdruit];
                $lePrix = $produits[2][$leProdruit];
                if ($laQuantite >= 10) { //pour savoir les produit à renouveller
                    $j++;
                    echo
                        '<tr class="row">
                        <td class="col-md-1 text-center">' . $j . '</td>
                        <td class="col-md-3 text-center">' . $leProdruit . '</td>
                        <td class="col-md-3 text-center">' . format($laQuantite) . '</td>
                        <td class="col-md-2 text-center">' . format($lePrix) . '</td>
                        <td class="col-md-3 text-center">' . format($laQuantite * $lePrix) . '</td>
                    </tr>';
                } else { //si la quantité est inferieur à 10 la class rouge mettre les cellules en rouge
                    $j++;
                    echo
                        '<tr class="row">
                        <td class="col-md-1 text-center rouge">' . $j . '</td>
                        <td class="col-md-3 text-center rouge">' . $leProdruit . '</td>
                        <td class="col-md-3 text-center rouge">' . format($laQuantite) . '</td>
                        <td class="col-md-2 text-center rouge">' . format($lePrix) . '</td>
                        <td class="col-md-3 text-center rouge">' . format($laQuantite * $lePrix) . '</td>
                    </tr>';
                }
                $totalQuant += $laQuantite; //calcul le total des quantités
                $Totprix += $lePrix; //calcul le total des prix pour calculer la moyenne
                $prixMoy = $Totprix / ($i + 1); //$i+1 car à la fin $i=9 
                $totalMont += $laQuantite * $lePrix;
            }
            echo //permet d afficher le total des elements
                '<tr class="row">
                    <td class="col-md-1 text-center gras"></td>
                    <td class="col-md-3 text-center gras">Total</td>
                    <td class="col-md-3 text-center gras">' . format($totalQuant) . '</td>
                    <td class="col-md-2 text-center gras">' . $prixMoy . '</td>
                    <td class="col-md-3 text-center gras">' . format($totalMont) . '</td>
                </tr>';
            ?>
        </table>
    </section>
    <?php
    include("piedDePage.php");
    ?>
</body>

</html>