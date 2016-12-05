
<?php
  
    echo <<<EOT
    <div> Panier de l'utilisateur <br>
    <h2><a href="index.php?controller=product&action=clearPanier">Vider le panier</a></h2><br></div>
    
<form method="post" action="index.php?controller=product&action=orderCommand">
<table style="width: 400px">
	<tr>
		<td colspan="4">Votre panier</td>
	</tr>
	<tr>
		<td>Libellé</td>
		<td>Quantité</td>
		<td>Prix Unitaire</td>
		<td>Action</td>
	</tr>

EOT;

    if (Panier::createPanier()) {
        $nbArticles = Panier::countArticles();
        if ($nbArticles <= 0) {
            echo "<tr><td>Votre panier est vide </ td></tr>";
        } else {
            $totalPrice = Panier::totalPrice();
            for ($i = 0; $i < $nbArticles; $i++) {
                $pLabel = htmlspecialchars($_SESSION['panier']['label'][$i]);
                $pPrice = htmlspecialchars($_SESSION['panier']['price'][$i]);

                $sLabel = rawurldecode($_SESSION['panier']['label'][$i]);
                
                $nbOptionArticle = count($_SESSION['panier']['option'][$i]);

                echo <<<EOT
				<tr>
					<td><a href="index.php?controller=product&action=read&label=$sLabel"> $pLabel </a></td>
					<td> $pPrice </td>
					<td><a href="index.php?controller=product&action=deleteProductPanier&label=$sLabel">XX</a></td>
				</tr>
EOT;

                
                        for($y = 0; $y < $nbOptionArticle;$y++){
                                $pLabel = htmlspecialchars($_SESSION['panier']['label'][$i][$y]['label']);
                                $pPrice = htmlspecialchars($_SESSION['panier']['price'][$i][$y]['prix']);

                                $sLabel = rawurldecode($_SESSION['panier']['label'][$i][$y]['label']);
                            echo <<<EOT
                            	<tr>
                                        <td> </td>
					<td><a href="index.php?controller=product&action=read&label=$sLabel"> $pLabel </a></td>
					<td> $pPrice </td>
					<td><a href="index.php?controller=product&action=deleteOptionPanier&label=$sLabel">XX</a></td>
				</tr>
EOT;
                    }
            }
            echo <<<EOT
			<tr>
				<td colspan="2"> </td>
				<td colspan="2">
					Total : $totalPrice
				</td>
			</tr>
EOT;
        }
    }
    echo "</table>";
    echo "<input type=\"submit\" value=\"Enregistrer la commande\">";
    echo "</form>";

?>