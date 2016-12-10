
<?php

if (isset($p)) {
    $pId = htmlspecialchars($p->getId());
    $pLabel = htmlspecialchars($p->getLabel());
    $pPrice = htmlspecialchars($p->getPrice());
    $pSDesc = htmlspecialchars($p->getShortDesc());
    $pCDesc = htmlspecialchars($p->getCompleteDesc());
} else {
    $pId = "";
    $pLabel = "";
    $pPrice = "";
    $pSDesc = "";
    $pCDesc = "";
}


if ($cerise == 'update') {
    echo "<form method = \"post\" action = \"index.php?action=updated&controller=product\" enctype=\"multipart/form-data\">";
} else {
    echo "<form method = \"post\" action = \"index.php?action=created&controller=product\" enctype=\"multipart/form-data\">";
}
echo "<fieldset>";
if ($cerise == 'update') {
    echo <<<EOT
        <legend>Modification de $pId</legend>
        <input type = 'hidden' name = 'action' value = 'updated'>
EOT;
} else {
    echo <<<EOT
        <legend>Nouveau produit</legend>
        <input type = 'hidden' name = 'action' value = 'created'>
        <p>
            <label for = "id_produit">ID</label> :
            <input type = "text" pattern="^(0|[1-9][0-9]*)$" value="$pId" name = "idP" id = "id_produit" required/>
        </p>
EOT;
}

echo <<<EOT

        <p>
            <label for = "label_produit">Label du produit</label> :
            <input type = "text" placeholder="Création d'un site web" value = "$pLabel" name = "label" id = "label_produit" required/>
        </p>
        <p>
            <label for = "prix_produit">Prix du produit</label> :
            <input type = "text" pattern="^(0|[1-9][0-9]*)$" placeholder="69" value = "$pPrice" name = "price" id = "prix_produit" required/>
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
                    <input type="file" name="path" />
                </p>
        <p>
            VOIR OPTION
        </p>
EOT;
if ($cerise == 'update') {
    echo <<<EOT
    <p>
            <input type = "submit" value = "Modifier" />
        </p>
    </fieldset>
</form>
EOT;
} else {
    echo <<<EOT
    <p>
            <input type = "submit" value = "Créer" />
        </p>
    </fieldset>
</form>
EOT;
}
?>