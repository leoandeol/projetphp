<form method="POST" action="index.php">
    <input type='hidden' name='action' value='updated'>
    <input type='hidden' name='controller' value='user'><div class="input">
            <label class="input-item" for="nick_id">Pseudonyme</label>
            <input class="input-field" type="text" value="<?php echo "$nName" ?>" name="nickname" id="nick_id"/>
        </div>
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
        <div class="input">
            <label class="input-item" for="lastname_id">Nom de famille</label>
            <input class="input-field" type="text" value="<?php echo"$lName" ?>" name="lastname" id="lastname_id"/>
        </div>
        <div class="input">
            <label class="input-item" for="firstname_id">Prénom</label>
            <input class="input-field" type="text" value="<?php echo"$fName" ?>" name="firstname" id="firstname_id"/>
        </div>
        <div class="input">
            <label class="input-item" for="email_id">Email</label>
            <input class="input-field" type="email" value="<?php echo"$mail" ?>" name="email" id="email_id"/>
        </div>
        <div class="input">
            <label class="input-item" for="birth_id">Date de naissance</label>
            <input class="input-field" type="date" value="<?php echo"$bDate" ?>" name="birthdate" id="birth_id"/>
        </div>
        <div class="input">
            <input class="input-field" type="submit"  value="Envoyer"/>
        </div>
</form>