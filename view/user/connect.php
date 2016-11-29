<form method="POST" action="index.php">

    <fieldset>
        <legend>Se connecter :</legend>
        <input type='hidden' name='action' value='connected'>
        <input type='hidden' name='controller' value='user'>
        <div class="input">
            <label class="input-item" for="nick_id">Pseudonyme</label>
            <input class="input-field" type="text" placeholder="Pseudonyme" name="nickname" id="nick_id" required/>
        </div>
        <div class="input">
            <label class="input-item" for="pass_id">Mot de passe</label>
            <input class="input-field" type="password" placeholder="Mot de passe" name="password" id="pass_id" required/>
        </div>
        <div class="input">
            <input class="input-field" type="submit"  value="Envoyer"/>
        </div>
    </fieldset> 
</form>