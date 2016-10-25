<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> Insérer le titrer ici </title>
    </head>

    <body>
        <?php ?>
        
        <form method = "get" action = "index.php?action=created">
            <fieldset>
                    <legend>Créer un produit :</legend>
                    <input type = 'hidden' name = 'action' value = 'created'>
                <p>
                    <label for = "nom_produit">Nom du produit</label> :
                    <input type = "text" placeholder = "Ex : Création de site web" name = "nom_produit" id = "nom_produit_id" required/>
                </p>
                <p>
                    <label for = "couleur_id">Prix du produit</label> :
                    <input type = "text" placeholder = "Ex : 15" name = "prix_produit" id = "prix_produit_id" required/>
                </p>
                <p>
                 <input type = "submit" value = "Envoyer" />
                </p>
            </fieldset>
        </form>
        

    </body>
</html>

