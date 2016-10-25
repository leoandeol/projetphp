<?php

    foreach ($tab_user as $user) {
        $idSecure = htmlspecialchars($user->getIdUser());
        $idUrlSecure = rawurlencode($user->getIdUser());
        echo "<p> User n° <a href=index.php?controller=user&action=read&idUser=$idUrlSecure>$idSecure</a>";
    }
?>