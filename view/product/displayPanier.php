
<?php

if (Session::is_connected()) {
    echo <<<EOT
<form method="post" action="panier.php">
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

                echo <<<EOT
				<tr>
					<td><a href="index.php?controller=product&action=read&label=$sLabel"> $pLabel </a></td>
					<td> $pPrice </td>
					<td><a href="index.php?controller=product&action=supprimerPanier&label=$sLabel">XX</a></td>
				</tr>
EOT;
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
}
?>