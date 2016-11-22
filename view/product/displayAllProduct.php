<?php

//Maybe n'afficher que le titre et l'ID -> revoir function readAll de produit
if ($tab_p != false) {
    foreach ($tab_p as $p) {
        $pId = htmlspecialchars($p->getId());
        $pLabel = htmlspecialchars($p->getLabel());
        $pPrice = htmlspecialchars($p->getPrice());
        $pSDesc = htmlspecialchars($p->getShortDesc());

        $securePLabel = rawurlencode($p->getLabel());
        $secureId = rawurldecode($p->getId());
        echo <<< EOT
            <div class="read readAll">
                <div class="id">ID :  $pId ~</div>
                <div class="name">$pLabel </div>
                <div class="price">Prix :  $pPrice €</div>
                <div class="description">$pSDesc</div>
                
                <a href="index.php?controller=product&action=read&label=$securePLabel"><div class="detail">Détails</div></a>
                <a href="index.php?controller=product&action=udpate&label=$securePLabel"><div class="detail">#Seul l'admin pourra le voir# Modifier</div></a>
                <a href="index.php?controller=product&action=delete&idProduct=$secureId"><div class="detail">#Seul l'admin pourra le voir# Supprimer</div></a>
            </div>
EOT;
    }
}
?>