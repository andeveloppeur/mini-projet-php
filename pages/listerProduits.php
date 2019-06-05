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
        <a class="nav-link nav-item" href="accueil.php">Accueil</a>
        <a class="nav-link active nav-item" href="listerProduits.php">Liste</a>
        <a class="nav-link nav-item" href="rechercherProduits.php">Recherche</a>
        <a class="nav-link nav-item" href="ajouterProduit.php">Ajouter</a>
        <a class="nav-link nav-item" href="updateProduit.php">Modifier</a>
        <a class="nav-link nav-item" href="supprimerProduit.php">Supprimer</a>
        <a class="nav-link nav-item" href="../index.php">Déconnexion</a>
    </nav>
    <header></header>
    <section class="container cListe">
        <table class="col-12 tabliste table">

            <?php
            $totalQuant = 0;
            $Totprix = 0;
            $prixMoy = 0;
            $totalMont = 0;
            $produits = array(
                array("Orange", "Pomme", "Mangue", "Citron", "Banane", "Pasteque", "Melon", "Cerise", "Fraise", "Poire"),
                array("Orange" => 500, "Pomme" => 9, "Mangue" => 456, "Citron" => 1000, "Banane" => 254, "Pasteque" => 450, "Melon" => 258, "Cerise" => 457, "Fraise" => 365, "Poire" => 7),
                array("Orange" => 1000, "Pomme" => 800, "Mangue" => 750, "Citron" => 450, "Banane" => 850, "Pasteque" => 1500, "Melon" => 1750, "Cerise" => 1250, "Fraise" => 900, "Poire" => 1550)
            );
            ?>
            <thead class="thead-dark">
                <tr class="row">
                    <td class="col-md-1 text-center gras">N°</td>
                    <td class="col-md-3 text-center gras">Produit</td>
                    <td class="col-md-3 text-center gras">Quantité</td>
                    <td class="col-md-2 text-center gras">Prix</td>
                    <td class="col-md-3 text-center gras">Montant</td>
                </tr>
            </thead>
            <?php
            function format($n)
            { //permet d afficher le separateur de millier
                return strrev(wordwrap(strrev($n), 3, ' ', true));
            }
            $j = 0;
            for ($i = 0; $i < count($produits[0]); $i++) {
                $leProdruit = $produits[0][$i];
                $laQuantite = $produits[1][$leProdruit];
                $lePrix = $produits[2][$leProdruit];
                if ($laQuantite >= 10) {
                    $j++;
                    echo
                        '<tr class="row">
                        <td class="col-md-1 text-center">' . $j . '</td>
                        <td class="col-md-3 text-center">' . $leProdruit . '</td>
                        <td class="col-md-3 text-center">' . format($laQuantite) . '</td>
                        <td class="col-md-2 text-center">' . format($lePrix) . '</td>
                        <td class="col-md-3 text-center">' . format($laQuantite * $lePrix) . '</td>
                    </tr>';
                } else { //si la quantité est inferieur à 10 la class rouge mettre les cellule en rouge
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
            echo
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