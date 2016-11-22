
<?php

$pId = htmlspecialchars($p->getId());
$pName = htmlspecialchars($p->getName());
$pPrice = htmlspecialchars($p->getPrice());
$pDesc = htmlspecialchars($p->getDescription());

$secureName = rawurlencode($p->getName());
$securePrice = rawurldecode($p->getPrice());

echo <<<EOT
    <div class="read">
        <div class="id">ID : $pId</div>
        <div class="label">Nom : $pName</div>
        <div class="price">Prix : $pPrice</div>
            
        <div class="completeDesc">$pDesc</div>        
EOT;



echo <<<EOT
<a href="index.php?action=readAll&controller=product"><div class=redirect>Voir l'ensemble des produits</div></a>
EOT;
//changer le redirect classique par un $_POST
?>  


