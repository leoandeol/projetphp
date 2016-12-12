<?php
if(isset($error))
{
    echo "<p>Une erreur est apparue : ".htmlspecialchars($error).".</p>";
}
else
{
    echo "<p>Une erreur est apparue.</p><p> Veuillez effectuer une nouvelle tentative, et si l'erreur se répète, veuillez contacter l'administrateur du site.</p>";
}
?>