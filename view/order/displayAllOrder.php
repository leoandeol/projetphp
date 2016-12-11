<?php

//Maybe n'afficher que le titre et l'ID -> revoir function readAll de produit
if ($tab_p != false) {
    echo "<div class='products'>";
    foreach ($tab_p as $p) {
        $pIDOrder = htmlspecialchars($p->getIDOrder());
        $pPrice = htmlspecialchars($p->getPrice());
        $pUserName = htmlspecialchars($p->getUserID());

        $secureIDOrder = rawurldecode($p->getIDOrder());

        echo <<< EOT
            <div class="product">
                <div class="product-name-pic">
                    <div class="product-name">$pIDOrder</div>
                </div>
                <div class="price">Prix :  $pPrice €</div>
                
                <a href="index.php?controller=order&action=read&idOrder=$secureIDOrder"><div class="detail">Détails</div></a>
EOT;
                        echo "</div>";
    }
    echo "</div>";
}
?>