<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> Insérer le titrer ici </title>
    </head>

    <body>
        <?php ?>
        
        <form method = "post" action = "index.php?action=created&controller=product">
            <fieldset>
                    <legend>Créer un produit :</legend>
                    <input type = 'hidden' name = 'action' value = 'created'>
                <p>
                    <label for = "id_produit">Nom du produit</label> :
                    <input type = "text" pattern="^(0|[1-9][0-9]*)$" placeholder = "Ex : 15" name = "idP" id = "id_produit" required/>
                </p>
                <p>
                    <label for = "nom_produit">Nom du produit</label> :
                    <input type = "text" placeholder = "Ex : Création de site web" name = "name" id = "nom_produit" required/>
                </p>
                <p>
                    <label for = "couleur_id">Prix du produit</label> :
                    <input type = "text" pattern="^(0|[1-9][0-9]*)$" placeholder = "Ex : 15" name = "price" id = "prix_produit" required/>
                </p>
                <p>
                 <input type = "submit" value = "Envoyer" />
                </p>
            </fieldset>
        </form>
        

    </body>
</html>

