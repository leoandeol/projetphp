<?php

//Maybe n'afficher que le titre et l'ID -> revoir function readAll de produit
if ($tab_p != false) {
    echo "<div class='products'>";
    foreach ($tab_p as $p) {
        $pId = htmlspecialchars($p->getId());
        $pLabel = htmlspecialchars($p->getLabel());
        $pPrice = htmlspecialchars($p->getPrice());
        $pSDesc = htmlspecialchars($p->getShortDesc());

        $securePLabel = rawurlencode($p->getLabel());
        $secureId = rawurldecode($p->getId());
        $securePPrice = rawurldecode($p->getPrice());
        echo <<< EOT
            <div class="product">
                    <img class="product-pic" src="res/upload/produit$pId.jpg" />
                    <div class="product-text">$pLabel </div>
                <div class="product-text">$pPrice €</div>
                <div class="product-text">$pSDesc</div>
                
                <div class="product-text">
					<a class="input-item" href="index.php?controller=product&action=read&label=$securePLabel">Détails</a>
				</div>
				<div class="product-text">
					<a class="input-item" href="index.php?controller=product&action=addPanier&label=$securePLabel&price=$securePPrice"><img class='imgbut' src="res/panier.png" /></a>
				</div>
EOT;
        if (Session::is_admin() && Session::is_connected()) {
            echo <<<EOT
			<div class="product-text">
					<a class="input-item" href="index.php?controller=product&action=update&label=$securePLabel">Modifier</a>
				</div>
            
			<div class="product-text">
					<a class="input-item" href="index.php?controller=product&action=delete&idProduct=$secureId">Supprimer</a>
			</div>
                
EOT;
        }
        echo "</div>";
    }
    echo "</div>";
}
?>