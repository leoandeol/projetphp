<?php

//$cer
if (isset($data['nName'])) {
    $nName = htmlspecialchars($data['nName']);
} else {
    $nName = "";
}
if (isset($data['lName'])) {
    $lName = htmlspecialchars($data['lName']);
} else {
    $lName = "";
}
if (isset($data['fName'])) {
    $fName = htmlspecialchars($data['fName']);
} else {
    $fName = "";
}
if (isset($data['mail'])) {
    $mail = htmlspecialchars($data['mail']);
} else {
    $mail = "";
}
if (isset($data['bDate'])) {
    $bDate = htmlspecialchars($data['bDate']);
} else {
    $bDate = "";
}

if (isset($data['cerise'])) {
    $cer = htmlspecialchars($data['cerise']);
} else {
    $cer = $cerise;
}
if ($cer == 'update') {
    echo "<form method = \"POST\" action = \"index.php?action=updated&controller=user\" enctype=\"multipart/form-data\">";
    echo "<input type='hidden' name='action' value='updated'>";
} else {
    echo "<form method = \"POST\" action = \"index.php?action=registered&controller=user\" enctype=\"multipart/form-data\">";
    echo "<input type='hidden' name='action' value='created'>";
}
echo <<<EOT
    <input type='hidden' name='controller' value='user'>
        <div class="input">
            <label class="input-item" for="nick_id">Pseudonyme</label>
            <input class="input-field" type="text" placehorlder="Pseudonyme" value="$nName" name="nickname" id="nick_id"/>
        </div>
EOT;
if ($cer == "update") {
    echo <<<EOT
        <div class="input">
            <label class="input-item" for="pass_id">Vieux mot de passe</label>
            <input class="input-field" type="password" placeholder="Mot de passe" name="old_password" id="pass_id" required/>
        </div>
        <div class="input">
            <label class="input-item" for="pass_id">Nouveau mot de passe</label>
            <input class="input-field" type="password" placeholder="Mot de passe" name="password" id="pass_id"/>
        </div>
        <div class="input">
            <label class="input-item" for="pass_id2">Nouveau mot de passe bis</label>
            <input class="input-field" type="password" placeholder="Mot de passe" name="password2" id="pass_id2"/>
        </div>
EOT;
    if (isset($data['checkBoxAdmin'])) {
        echo $data['checkBoxAdmin'];
    } else {
        echo $checkBoxAdmin;
    }
} else {

    echo <<<EOT
        <div class="input">
            <label class="input-item" for="pass_id">Mot de passe</label>
            <input class="input-field" type="password" placeholder="Mot de passe" name="password" id="pass_id" required/>
        </div>
        <div class="input">
            <label class="input-item" for="pass_id2">Confirmez le mot de passe</label>
            <input class="input-field" type="password" placeholder="Mot de passe" name="password2" id="pass_id2" required/>
        </div>
EOT;
}
echo <<<EOT
        <div class="input">
            <label class="input-item" for="lastname_id">Nom de famille</label>
            <input class="input-field" type="text" value="$lName" placeholder="Nom de famille"name="lastname" id="lastname_id"/>
        </div>
        <div class="input">
            <label class="input-item" for="firstname_id">Prénom</label>
            <input class="input-field" type="text" value="$fName" placeholder="Prénom" name="firstname" id="firstname_id"/>
        </div>
        <div class="input">
            <label class="input-item" for="email_id">Email</label>
            <input class="input-field" type="email" value="$mail" placeholder="Mail" name="email" id="email_id"/>
        </div>
        <div class="input">
            <label class="input-item" for="birth_id">Date de naissance</label>
            <input class="input-field" type="date" value="$bDate" placeholder="Date de naissance" name="birthdate" id="birth_id"/>
        </div>
		<div class ="input">
        </div>
        <div class="input">
            <input class="input-field" type="submit"  value="Envoyer"/>
        </div>
</form>
EOT;
?>