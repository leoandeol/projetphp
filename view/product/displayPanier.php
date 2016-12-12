
<?php
  
    echo <<<EOT
    <div> Panier de l'utilisateur <br>
    <h2><a href="index.php?controller=product&action=clearPanier">Vider le panier</a></h2><br></div>
    
<form method="post" action="index.php?controller=order&action=create">
<table style="width: 400px">
	<tr>
		<td colspan="4">Votre panier</td>
	</tr>
	<tr>
		<td>Libellé</td>
		<td>Quantité</td>
		<td>Prix Unitaire</td>
	</tr>

EOT;

    if (Panier::createPanier()) {
        $nbArticles = Panier::countDiffArticles();
        if ($nbArticles <= 0) {
            echo "<tr><td>Votre panier est vide </ td></tr>";
        } else {
            $totalPrice = Panier::totalPrice();
            for ($i = 0; $i < $nbArticles; $i++) {
                $pLabel = htmlspecialchars($_SESSION['panier']['label'][$i]);
                $pPrice = htmlspecialchars($_SESSION['panier']['price'][$i]);
                $pQuantity = htmlspecialchars($_SESSION['panier']['quantity'][$i]);

                $sLabel = rawurldecode($_SESSION['panier']['label'][$i]);
                $sPrice = rawurldecode($_SESSION['panier']['price'][$i]);
                
               /* $nbOptionArticle = count($_SESSION['panier']['option'][$i]);*/

                echo <<<EOT
				<tr>
					<td><a href="index.php?controller=product&action=read&label=$sLabel"> $pLabel </a></td>
					<td> $pQuantity </td>
                    <td> $pPrice </td>
					<td>
						<a href="index.php?controller=product&action=deleteArticlePanier&label=$sLabel"><img class='imgbut' src="res/Minus.png" /></a>
					</td>
					<td>
						<a href="index.php?controller=product&action=addPanier&label=$sLabel&price=$sPrice"><img class='imgbut' src="res/Add.png" /></a>
					</td>
					<td>
						<a href="index.php?controller=product&action=deleteAllArticlesPanier&label=$sLabel"><img class='imgbut' src="res/Delete.png" /></a>
					</td>
				</tr>
EOT;

               /* 
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
                    }*/
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