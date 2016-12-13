
<?php

$pId = htmlspecialchars($p->getId());
$pLabel = htmlspecialchars($p->getLabel());
$pPrice = htmlspecialchars($p->getPrice());
$pCDesc = htmlspecialchars($p->getCompleteDesc());

$nbOption = $p->countOption();

$secureLabel = rawurlencode($p->getLabel());
$securePrice = rawurldecode($p->getPrice());

echo <<<EOT
    <div class="product-detail">
        <div class="product-detail-name">$pLabel</div> 
        <img class="product-detail-pic" src="res/upload/produit$pId.jpg" />     
        <div class="product-detail-text">$pCDesc</div>
        <div class="product-detail-price">$pPrice €</div>
EOT;


if ($nbOption != 0) {
    echo "<form method = \"post\" action = \"index.php\">";
    $i = 0;
    foreach($o as $object) {
        $pNameO = htmlspecialchars($object->getName());
        $pPriceO = htmlspecialchars($object->getPrice());
        $pDescO = htmlspecialchars($object->getDescription());

        echo "<fieldset>";

        $name = "check" . $i;
        $i++;
        
        echo "<input type=\"checkbox\" name=\"$name\">";

echo <<<EOT
                <div class="product-text">Nom : $pNameO</div>
                <div class="product-text">Prix : $pPriceO</div>
                <div class="product-text">$pDescO</div>   
            </fieldset>
        
EOT;
    }
echo "</form>";
}
echo <<< EOT
    <div class = "containerbuttons">
        <a href="index.php?action=readAll&controller=product"><img class='returnbutn' src="res/Retour.png" /></a>
        <a href="index.php?action=addPanier&controller=product&label=$secureLabel&price=$securePrice"><img class='basktebutn' src="res/panier.png" /></a>
    </div>
EOT;
?>  


