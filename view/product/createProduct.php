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
                    <label for = "id_produit">ID</label> :
                    <input type = "text" pattern="^(0|[1-9][0-9]*)$" placeholder = "Ex : 15" name = "idP" id = "id_produit" required/>
                </p>
                <p>
                    <label for = "label_produit">Label du produit</label> :
                    <input type = "text" placeholder = "Ex : Création de site web" name = "label" id = "label_produit" required/>
                </p>
                <p>
                    <label for = "prix_produit">Prix du produit</label> :
                    <input type = "text" pattern="^(0|[1-9][0-9]*)$" placeholder = "Ex : 25" name = "price" id = "prix_produit" required/>
                </p>
                <p>
                    <label for = "sDesc_produit">Résumé descriptif</label> :
                    <textarea type = "text" placeholder = "Description résumé de mon produit" name = "shortDesc" id = "sDesc_produit" required>
                    </textarea>
                </p>
                <p>
                    <label for = "cDesc_produit">Description détaillé</label> :
                    <textarea placeholder = "Description détaillé de mon produit" name = "completeDesc" id = "cDesc_produit" required></textarea>
                </p>
                <p>
                    VOIR OPTION
                </p>
                <p>
                    <input type = "submit" value = "Envoyer" />
                </p>
            </fieldset>
        </form>


    </body>
</html>

