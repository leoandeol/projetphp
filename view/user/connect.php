<form method="POST" action="index.php">

    <fieldset>
        <legend>Se connecter :</legend>
        <input type='hidden' name='action' value='connected'>
        <input type='hidden' name='controller' value='user'>
        <div class="input">
            <label class="input-item" for="nick_id">Pseudonyme</label>
            <input class="input-field" type="text" value="<?php if(isset($data['login'])){ echo htmlspecialchars($data['login']); }else{echo"";}?>" name="nickname" id="nick_id" required/>
        </div>
        <div class="input">
            <label class="input-item" for="pass_id">Mot de passe</label>
            <input class="input-field" type="password" name="password" id="pass_id" required/>
        </div>
        <div class="input">
            <input class="input-field" type="submit"  value="Envoyer"/>
        </div>
        <div class="register-link">
            <a href="index.php?controller=user&action=register">Vous n'êtes pas inscrit ? Cliquer ici. </a>
        </div>
    </fieldset> 
</form>