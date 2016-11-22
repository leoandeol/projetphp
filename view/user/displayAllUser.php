<?php

    foreach ($tab_user as $user) {
        $idSecure = htmlspecialchars($user->getNickName());
        $idUrlSecure = rawurlencode($user->getNickName());
        echo "<div> User n° <a href=index.php?controller=user&action=read&nickName=$idUrlSecure>$idSecure</a> </div>";
    }
?>