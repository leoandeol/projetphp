<?php
//Maybe n'afficher que le titre et l'ID -> revoir function readAll de produit
    foreach ($tab_p as $p) {
        $pId = htmlspecialchars($p->getId());
        $pName = htmlspecialchars($p->getProductName());
        $pPrice = htmlspecialchars($p->getPrice());
        $securePName = rawurlencode($p->getProductName());

        echo <<< EOT
                <div class="read readAll">
                <div class="id">ID :  $pId ~</div>
                <div class="name">$pName </div>
                <div class="price">Prix :  $pPrice €</div>
                <div class="description">###Futur description résumé du produit -> modifié la table en conséquence ###</div>
                
<a href="index.php?controller=product&action=read&name=$securePName"><div class="detail">Détails</div></a>
</div>
EOT;

    }
?>