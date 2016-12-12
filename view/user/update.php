<?php 

//$cer
if(isset($dataErr['nName'])){
    $nName= htmlspecialchars($dataErr['nName']);
}
else{
    $nName = "";
}
if(isset($dataErr['lName'])){
    $lName = htmlspecialchars($dataErr['lName']);
}
else{
    $lName = "";   
}
if(isset($dataErr['fName'])){
    $fName = htmlspecialchars($dataErr['fName']);
}else{
    $fName="";
}
if(isset($dataErr['mail'])){
    $mail=$dataErr['mail'];
}
else{
    $mail="";
}
if(isset($dataErr['bDate'])){
    $bDate = $dataErr['bDate'];
}
else{
    $bDate = "";
}


if(isset($dataErr['cerise'])){
	$cer = $dataErr['cerise'];
}else{
	$cer = $cerise;
}
if ($cer == 'update') {
    echo "<form method = \"POST\" action = \"index.php?action=updated&controller=user\" enctype=\"multipart/form-data\">";
    echo "<input type='hidden' name='action' value='updated'>";
} else {
    echo "<form method = \"POST\" action = \"index.php?action=created&controller=user\" enctype=\"multipart/form-data\">";
    echo "<input type='hidden' name='action' value='created'>";
}
echo <<<EOT
    <input type='hidden' name='controller' value='user'>
        <div class="input">
            <label class="input-item" for="nick_id">Pseudonyme</label>
            <input class="input-field" type="text" placehorlder="Pseudonyme" value="$nName" name="nickname" id="nick_id"/>
        </div>
EOT;
    if($cer == "update"){
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
    }
    else{
        
echo <<<EOT
        <div class="input">
            <label class="input-item" for="pass_id">Mot de passe</label>
            <input class="input-field" type="password" placeholder="Mot de passe" name="password" id="pass_id" required/>
        </div>
        <div class="input">
            <label class="input-item" for="pass_id2">Mot de passe bis</label>
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
EOT;
			if(isset($dataErr['checkBoxAdmin'])){
                            echo $dataErr['checkBoxAdmin'];
                        }
                        else{
                            echo $checkBoxAdmin;
                        } 
echo <<<EOT
                </div>
        <div class="input">
            <input class="input-field" type="submit"  value="Envoyer"/>
        </div>
</form>
EOT;
?>