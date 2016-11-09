
<?php

$pId = htmlspecialchars($p->getId());
$pLabel = htmlspecialchars($p->getLabel());
$pPrice = htmlspecialchars($p->getPrice());
$pSDesc = htmlspecialchars($p->getShortDesc());
$pCDesc = htmlspecialchars($p->getCompleteDesc());

echo <<<EOT
<form method = "post" action = "index.php?action=modified&controller=product">
    <fieldset>
        <legend>Modifier un produit :</legend>
        <input type = 'hidden' name = 'action' value = 'created'>
        <p>
            <label for = "id_produit">ID</label> :
            <input type = "text" pattern="^(0|[1-9][0-9]*)$" value="$pId" name = "idP" id = "id_produit" required/>
        </p>
        <p>
            <label for = "label_produit">Label du produit</label> :
            <input type = "text" value = "$pLabel" name = "label" id = "label_produit" required/>
        </p>
        <p>
            <label for = "prix_produit">Prix du produit</label> :
            <input type = "text" pattern="^(0|[1-9][0-9]*)$" value = "$pPrice" name = "price" id = "prix_produit" required/>
        </p>
        <p>
            <label for = "sDesc_produit">Résumé descriptif</label> :
            <textarea type = "text" placeholder = "Description résumé de mon produit" name = "shortDesc" id = "sDesc_produit" required>
            $pSDesc
            </textarea>
        </p>
        <p>
            <label for = "cDesc_produit">Description détaillé</label> :
            <textarea placeholder = "Description détaillé de mon produit" name = "completeDesc" id = "cDesc_produit" required>
        $pCDesc
            </textarea>
        </p>
        <p>
            VOIR OPTION
        </p>
        <p>
            <input type = "submit" value = "Modifier" />
        </p>
    </fieldset>
</form>
EOT;
?>