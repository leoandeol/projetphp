<?php

$nickNameSecure = htmlspecialchars($user->getNickName());
$firstNameSecure = htmlspecialchars($user->getFirstName());
$lastNameSecure = htmlspecialchars($user->getLastName());
$mailSecure = htmlspecialchars($user->getMail());
$birthDateSecure = htmlspecialchars($user->getBirthDate());

echo " User " . $nickNameSecure . ", firstname : " . $firstNameSecure . ", lastname : " . $lastNameSecure . ", mail : " . $mailSecure . ", birthdate : " . $birthDateSecure;
echo <<< EOT
    <form method="POST" action="index.php">
        <input type='hidden' name='action' value='readAll'>
        <input type='hidden' name='controller' value='order'>
        <div class="input">
            <input class="input-field" type="submit"  value="Vos commandes"/>
        </div>
    </form>
EOT;
?>
