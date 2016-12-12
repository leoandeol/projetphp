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
                <form method="POST" action="index.php">
                  <input type='hidden' name='action' value='displaySelf'>
                  <input type='hidden' name='controller' value='user'>
                  <div class="input">
                   <input class="input-field" type="submit"  value="Retour"/>
                  </div>
                </form>
EOT;
                        echo "</div>";
    }
    echo "</div>";
}
?>