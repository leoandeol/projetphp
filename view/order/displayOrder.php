
<?php

$pIDOrder = htmlspecialchars($p->getIDOrder());
        $pPrice = htmlspecialchars($p->getPrice());
        $pUserName = htmlspecialchars($p->getUserID());

        $secureIDOrder = rawurldecode($p->getIDOrder());
        echo <<< EOT
            <table>
                <tr>
                    <td>Commande ID : $pIDOrder</td>
                <td>Prix :  $pPrice €</td>
                </tr>
            </table>
EOT;
        echo "<table>";
foreach($tab_p as $q){
    $pLabel = htmlspecialchars($q->getLabel());
    $pPrice = htmlspecialchars($q->getPrice());
    $pCDesc = htmlspecialchars($q->getShortDesc());
    $pId = htmlspecialchars($q->getId());
    
    $secureLabel = rawurlencode($q->getLabel());

    echo <<<EOT


            <tr>
                <td><img class="cart-pic" src="res/upload/produit$pId.jpg" /></td>
                <td>Nom : $pLabel</td>
                <td>Prix : $pPrice €</td>

                <td>$pCDesc</td> 
                <td><a href="index.php?controller=product&action=read&label=$secureLabel">Détails</a></td>

EOT;
}
echo "</table>";
?>  


