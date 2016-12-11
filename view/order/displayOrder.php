
<?php

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
            </div>
EOT;
foreach($tab_p as $q){
    $pLabel = htmlspecialchars($q->getLabel());
    $pPrice = htmlspecialchars($q->getPrice());
    $pCDesc = htmlspecialchars($q->getShortDesc());

    $secureLabel = rawurlencode($q->getLabel());

    echo <<<EOT

        <fieldset>
            <div class="read">
                <div class="label">Nom : $pLabel</div>
                <div class="price">Prix : $pPrice</div>

                <div class="completeDesc">$pCDesc</div> 
            <div><a href="index.php?controller=product&action=read&label=$secureLabel"><div class="detail">Détails</div></a>
            </div>

        </fieldset>
EOT;

}
?>  


