
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
        <input class="input-field"  type = 'hidden' name = 'action' value = 'updated'>
EOT;
} else {
    echo <<<EOT
        <legend>Nouveau produit</legend>
        <input type = 'hidden' name = 'action' value = 'created'>
        <div class="input">
            <label class="input-item"  for = "id_produit">ID</label> 
            <input class="input-field"  type = "text" pattern="^(0|[1-9][0-9]*)$" value="$pId" name = "idP" id = "id_produit" required/>
        </div>
EOT;
}

echo <<<EOT

        <div class="input">
            <label class="input-item"  for = "label_produit">Label du produit</label>
            <input class="input-field"  type = "text" value = "$pLabel" name = "label" id = "label_produit" required/>
        </div>
        <div class="input">
            <label class="input-item"  for = "prix_produit">Prix du produit</label>
            <input class="input-field"  type = "text" pattern="^(0|[1-9][0-9]*)$" value = "$pPrice" name = "price" id = "prix_produit" required/>
        </div>
        <div class="input">
            <label class="input-item"  for = "sDesc_produit">Résumé descriptif</label>
            <textarea class="input-field"  type = "text" placeholder = "Description résumé de mon produit" name = "shortDesc" id = "sDesc_produit" required>
            $pSDesc
            </textarea>
        </div>
        <div class="input">
            <label class="input-item"  for = "cDesc_produit">Description détaillé</label>   
            <textarea class="input-field"  placeholder = "Description détaillé de mon produit" name = "completeDesc" id = "cDesc_produit" required>
        $pCDesc
            </textarea>
        </div>
            <input class="input-field"  type="file" name="path" />
        <div class="input">
            VOIR OPTION
        </div>
EOT;
if ($cer == 'update') {
    echo <<<EOT
    <div class="input">
            <input type = "submit" value = "Modifier" />
        </div>
    </fieldset>
</form>
EOT;
} else {
    echo <<<EOT
    <div class="input">
            <input type = "submit" value = "Créer" />
        </div>
    </fieldset>
</form>
EOT;
}
?>