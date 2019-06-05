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
        <a class="nav-link nav-item" href="listerProduits.php">Liste</a>
        <a class="nav-link nav-item" href="rechercherProduits.php">Recherche</a>
        <a class="nav-link nav-item" href="ajouterProduit.php">Ajouter</a>
        <a class="nav-link nav-item" href="updateProduit.php">Modifier</a>
        <a class="nav-link active nav-item" href="supprimerProduit.php">Supprimer</a>
        <a class="nav-link nav-item" href="../index.php">Déconnexion</a>
    </nav>
    <header></header>
    <section class="container corps">
        <form action="supprimerProduit.php" method="POST" class="tab row">
            <div class="col-md-3"></div>
            <div class="col-md-6 bor">
                <?php
                $produits = array(
                    array("Orange", "Pomme", "Mangue", "Citron", "Banane", "Pasteque", "Melon", "Cerise", "Fraise", "Poire"),
                    array("Orange" => 500, "Pomme" => 9, "Mangue" => 456, "Citron" => 1000, "Banane" => 254, "Pasteque" => 450, "Melon" => 258, "Cerise" => 457, "Fraise" => 365, "Poire" => 7),
                    array("Orange" => 1000, "Pomme" => 800, "Mangue" => 750, "Citron" => 450, "Banane" => 850, "Pasteque" => 1500, "Melon" => 1750, "Cerise" => 1250, "Fraise" => 900, "Poire" => 1550)
                );
                $prodExiste = 0;
                $supPro = "";
                $totalMont = 0;
                $Totprix = 0;
                $totalQuant = 0;
                $Totprix = 0;
                $prixMoy = 0;

                if (isset($_POST["valider"])) {
                    $supPro = $_POST["produit"]; //recupere le nom du produit saisi dans le formulaire via le tableau $_POST

                    for ($i = 0; $i < count($produits[0]); $i++) { //casse
                        if (!strcasecmp($supPro, $produits[0][$i])) { //pour gerer la casse
                            $supPro = $produits[0][$i];
                        }
                    }
                    for ($i = 0; $i < count($produits[0]); $i++) { //permet de parcourir tout le tableau (count renvoi la taille du tableau)
                        if ($produits[0][$i] == $supPro) { //verifie si le produit à ajouter n existe pas deja
                            $prodExiste = 1; //si existe deja le variable $prodExiste=1 cela nous permettra de bloquer l'ajout
                        }
                    }
                }
                echo '<div class="row">
                        <div class="col-md-2"></div>
                        <input class="form-control col-md-8 espace ';
                if (isset($_POST["valider"]) && $supPro == "" || isset($_POST["valider"]) && $prodExiste == 0) {
                    echo 'rougMoins';
                }
                echo '" type="text" id="produit" name="produit"';
                if (isset($_POST["valider"]) && $supPro == "") {
                    echo 'placeholder="Remplir le nom du produit à supprimer"';
                } //si on envoi ajoute un produit sans remplir le nom du produit
                elseif ($prodExiste == 0 && isset($_POST["valider"])) {
                    echo ' placeholder="Le produit ' . $supPro . ' n\'existe pas" value=""';
                } //si le produit existe deja
                elseif ($prodExiste == 1) {
                    echo ' placeholder="Nom produit" value=""';
                } //si modif reussi
                elseif ($prodExiste == 0) {
                    echo ' placeholder="Produit à supprimer" value=""';
                }
                echo '>'; //lors du chargement de la page
                echo '</div>';
                ?>

                <div class="row">
                    <div class="col-md-3"></div>
                    <input type="submit" class="form-control col-md-6 espace" value="Supprimer" name="valider">
                </div>
            </div>
        </form>
        <table class="col-12 liste mb5 table">

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


            if ($supPro != "" && $prodExiste == 1) {
                $indice = array_search($supPro, $produits[0]); //array_search($supPro, $produits[0]) retourne l'indice ou se trouve l'element à supprimer
                unset($produits[0][$indice]); //la fonction unset permet de supprimer l'element du tableau
                unset($produits[1][$supPro]); //on utilise $Quantite[$supPro] car dans les quantités, les clefs correspondent au nom des produits 
                unset($produits[2][$supPro]);
            }
            $j = 0;
            foreach ($produits[0] as $prod) { //Ici la boucle foreach est préferable au boucle for car par ex lors de la suppression de l element qui a l'indice 2 le tableau apres suppression aura les indices 0 1 3 4....
                $leProdruit = $prod;
                $laQuantite = $produits[1][$leProdruit];
                $lePrix = $produits[2][$leProdruit];

                if ($leProdruit != "") {
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
                    } else { //si la quantité est inferieur à 10 la class rouge met les cellules en rouge
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
                    $prixMoy = $Totprix / $j; //pas de $i+1 car on a utiliser foreach
                    $totalMont += $laQuantite * $lePrix;
                }
            }
            echo
                '<tr class="row">
                        <td class="col-md-1 text-center gras"></td>
                        <td class="col-md-3 text-center gras">Total</td>
                        <td class="col-md-3 text-center gras">' . format($totalQuant) . '</td>
                        <td class="col-md-2 text-center gras">' . $prixMoy . '</td>
                        <td class="col-md-3 text-center gras">' . format($totalMont) . '</td>
                    </tr>';
            /*echo"<pre>"; //pour verifier si les elements sont reelement supprimés
                    print_r($produits);
                echo"<pre>";*/
            ?>
        </table>
    </section>
    <?php
    include("piedDePage.php");
    ?>
</body>

</html>