<?php

//Maybe n'afficher que le titre et l'ID -> revoir function readAll de produit
if ($tab_p != false) {
    foreach ($tab_p as $p) {
        $pLabel = htmlspecialchars($p->getLabel());
        $pPrice = htmlspecialchars($p->getPrice());
        $pSDesc = htmlspecialchars($p->getShortDesc());

        $securePLabel = rawurlencode($p->getLabel());
        $secureId = rawurldecode($p->getId());
        echo <<< EOT
            <div class="read readAll">
                <div class="name">$pLabel </div>
                <div class="price">Prix :  $pPrice €</div>
                <div class="description">$pSDesc</div>
                
                <a href="index.php?controller=product&action=read&label=$securePLabel"><div class="detail">Détails</div></a>
EOT;
        if(Session::is_admin() && Session::is_connected()){
         echo <<<EOT
            <a href="index.php?controller=product&action=update&label=$securePLabel"><div class="detail">Modifier</div></a>
                <a href="index.php?controller=product&action=delete&idProduct=$secureId"><div class="detail">Supprimer</div></a>
EOT;
        }
                        echo "</div>";
    }
}
?>