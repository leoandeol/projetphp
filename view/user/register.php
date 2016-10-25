<form method="POST" action="index.php">

    <fieldset>
        <legend>S'inscrire :</legend>
        <input type='hidden' name='action' value='created'>
        <p>
            <label for="nick_id">Pseudonyme</label> :
            <input type="text" placeholder="Pseudonyme" name="nickname" id="nick_id" required/>
        </p>
        <p>
            <label for="pass_id">Mot de passe</label> :
            <input type="text" placeholder="Mot de passe" name="password" id="pass_id" required/>
        </p>
        <p>
            <label for="lastname_id">Nom de famille</label> :
            <input type="text" placeholder="Ex : Dupont" name="lastname" id="lastname_id" required/>
        </p>
        <p>
            <label for="firstname_id">Prénom</label> :
            <input type="text" placeholder="Ex : Jean" name="firstname" id="firstname_id" required/>
        </p>
        <p>
            <label for="email_id">Email</label> :
            <input type="text" placeholder="Ex : jean.dupont@caramail.be" name="email" id="email_id" required/>
        </p>
        <p>
            <label for="birth_id">Date de naissance</label> :
            <input type="text" placeholder="Ex : 28/04/89" name="birthdate" id="birth_id" required/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset> 
</form>