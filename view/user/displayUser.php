<?php

$idSecure = htmlspecialchars($user->getIdUser());
$nickNameSecure = htmlspecialchars($user->getNickName());
$firstNameSecure = htmlspecialchars($user->getFirstName());
$lastNameSecure = htmlspecialchars($user->getLastName());
$mailSecure = htmlspecialchars($user->getMail());
$birthDateSecure = htmlspecialchars($user->getBirthDate());

echo "User n° " . $idSecure . ", nickname : " . $nickNameSecure . ", firstname : " . $firstNameSecure . ", lastname : " . $lastNameSecure . ", mail : " . $mailSecure . ", birthdate : " . $birthDateSecure;
?>