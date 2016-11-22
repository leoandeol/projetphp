
<?php

$pId = htmlspecialchars($p->getId());
$pLabel = htmlspecialchars($p->getLabel());
$pPrice = htmlspecialchars($p->getPrice());
$pCDesc = htmlspecialchars($p->getCompleteDesc());

$nbOption = $p->countOption();

$secureLabel = rawurlencode($p->getLabel());
$securePrice = rawurldecode($p->getPrice());

echo <<<EOT
    <div class="read">
        <div class="id">ID : $pId</div>
        <div class="label">Nom : $pLabel</div>
        <div class="price">Prix : $pPrice</div>
            
        <div class="completeDesc">$pCDesc</div>     
        <h1> $nbOption </h1>
EOT;
if (Session::is_connected()) {
    echo "<a href=\"index.php?action=addPanier&controller=product&label=$secureLabel&price=$securePrice\"><div class=\"redirect\" style=\"border:1px solid black;text-align:center;background-color:blue;\">Ajouter au panier</div></a>";
}




echo <<<EOT
        <a href="index.php?action=readAll&controller=product"><div class=redirect>Voir l'ensemble des produits</div></a>
EOT;
//changer le redirect classique par un $_POST
?>  


