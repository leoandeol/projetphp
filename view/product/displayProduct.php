
<?php  
    $pId = htmlspecialchars($p->getId());
    $pName = htmlspecialchars($p->getProductName());
    $pPrice = htmlspecialchars($p->getPrice());

    echo <<<EOT
    <div class="read">
        <div class="id">ID : $pId  </div>
        <div class="name">Nom :  $pName</div>
        <div class="price">Prix :  $pPrice </div>
            
        <div class="description"> blblblblblbllblblblblblblblblblblblblbllbbllbbll</div>
            
        <a href="index.php?action=readAll&controller=product"><div class="redirect">Voir l'ensemble des produits</div></a>
EOT;

?>  

