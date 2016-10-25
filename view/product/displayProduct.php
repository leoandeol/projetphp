
<?php  
    $pId = htmlspecialchars($p->getId());
    $pName = htmlspecialchars($p->getProductName());
    $pPrice = htmlspecialchars($p->getPrice());

    echo "<div><h2>ID : " . $pId . " </h2>Nom : " . $pName . "<br>Prix : " . $pPrice. "</div>";

?>  


