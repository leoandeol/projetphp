<form method="POST" action="index.php">

    <fieldset>
        <legend>S'inscrire :</legend>
        <input type='hidden' name='action' value='registered'>
        <input type='hidden' name='controller' value='user'>
        <div class="input">
            <label class="input-item" for="nick_id">Pseudonyme</label>
            <input class="input-field" type="text" value="<?php if(isset($data['nName'])){ echo $data['nName'];}else{echo "Pseudonyme";}?>" name="nickname" id="nick_id" required/>
        </div>
        <div class="input">
            <label class="input-item" for="pass_id">Mot de passe</label>
            <input class="input-field" type="password" placeholder="Mot de passe" name="password" id="pass_id" required/>
        </div>
        <div class="input">
            <label class="input-item" for="pass_id2">Mot de passe bis</label>
            <input class="input-field" type="password" placeholder="Mot de passe" name="password2" id="pass_id2" required/>
        </div>
        <div class="input">
            <label class="input-item" for="lastname_id">Nom de famille</label>
            <input class="input-field" type="text" value="<?php if(isset($data['lName'])){ echo $data['lName'];}else{echo "Nom de famille";}?>" name="lastname" id="lastname_id" required/>
        </div>
        <div class="input">
            <label class="input-item" for="firstname_id">Prénom</label>
            <input class="input-field" type="text" value="<?php if(isset($data['fName'])){ echo $data['fName'];}else{echo "Prénom";}?>" name="firstname" id="firstname_id" required/>
        </div>
        <div class="input">
            <label class="input-item" for="email_id">Email</label>
            <input class="input-field" type="email" value="<?php if(isset($data['mail'])){ echo $data['mail'];}else{echo "Email";}?>" name="email" id="email_id" required/>
        </div>
        <div class="input">
            <label class="input-item" for="birth_id">Date de naissance</label>
            <input class="input-field" type="date" value="<?php if(isset($data['bDate'])){ echo $data['bDate'];}else{echo "Date de naissance";}?>" name="birthdate" id="birth_id" required/>
        </div>
        <div class="input">
            <input class="input-field" type="submit"  value="Envoyer"/>
        </div>
    </fieldset> 
</form>