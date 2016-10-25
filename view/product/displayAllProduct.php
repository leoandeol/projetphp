<?php
//Maybe n'afficher que le titre et l'ID -> revoir function readAll de produit
    foreach ($tab_p as $p) {
        $pId = htmlspecialchars($p->getId());
        $pName = htmlspecialchars($p->getProductName());
        $pPrice = htmlspecialchars($p->getPrice());
        $securePName = rawurlencode($p->getProductName());

        echo "<div><a href=\"index.php?controller=product&action=read&name=$securePName\">ID : " . $pId . "~/Nom : " . $pName . "~/Prix : " . $pPrice. "</a></div>";
    }
?>