
<?php

if (isset($p)) {
    $pId = htmlspecialchars($p->getId());
    $pLabel = htmlspecialchars($p->getLabel());
    $pPrice = htmlspecialchars($p->getPrice());
    $pSDesc = htmlspecialchars($p->getShortDesc());
    $pCDesc = htmlspecialchars($p->getCompleteDesc());
} else {
    if(isset($data['pId'])){
		$pId = $data['pId'];
	}else{
		$pId = "";
	}
	if(isset($data['pLabel'])){
		$pLabel = $data['pLabel'];
	}else{
		$pLabel = "";
	}
	if(isset($data['pPrice'])){
		$pPrice = $data['pPrice'];
	}else{
		$pPrice = "";
	}
	if(isset($data['pSDesc'])){
		$pSDesc = $data['pSDesc'];
	}else{
		$pSDesc = "";
	}
	if(isset($data['pCDesc'])){
		$pCDesc = $data['pCDesc'];
	}else{
		$pCDesc = "";
	}
}

if(isset($data['cerise'])){
	$cer = $data['cerise'];
}else{
	$cer = $cerise;
}

if ($cer == 'update') {
    echo "<form method = \"POST\" action = \"index.php?action=updated&controller=product\" enctype=\"multipart/form-data\">";
} else {
    echo "<form method = \"POST\" action = \"index.php?action=created&controller=product\" enctype=\"multipart/form-data\">";
}
echo "<fieldset>";
if ($cer == 'update') {
    echo <<<EOT
        <legend>Modification de $pId</legend>
        <input type = 'hidden' name = 'action' value = 'updated'>
        <p>
            <label for = "id_produit">ID</label> :
            <input type = "text" pattern="^(0|[1-9][0-9]*)$" value="$pId" name = "idP" id = "id_produit" readonly/>
        </p>
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
if ($cer == 'update') {
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