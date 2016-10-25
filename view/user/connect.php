<form method="POST" action="index.php">

    <fieldset>
        <legend>Se connecter :</legend>
        <input type='hidden' name='action' value='connected'>
        <p>
            <label for="nick_id">Pseudonyme</label> :
            <input type="text" placeholder="Pseudonyme" name="nickname" id="nick_id" required/>
        </p>
        <p>
            <label for="pass_id">Mot de passe</label> :
            <input type="password" placeholder="Mot de passe" name="password" id="pass_id" required/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset> 
</form>