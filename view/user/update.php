<form method="POST" action="index.php">
    <input type='hidden' name='action' value='updated'>
    <p>
        <label for="fName">Prénom</label>
        <input type="text" name="firstName" for="fName"/>
    </p>
    <p>
        <label for="lName">Nom de famille</label>
        <input type="text" name="lastName" for="lName"/>
    </p>
    <p>
        <label for="nName">Pseudonyme</label>
        <input type="text" name="nickName" for="nName"/>
    </p>
    <p>
        <label for="oPass">Mot de passe actuel</label>
        <input type="text" name="oldPassword" for="oPass"/>
    </p>
    <p>
        <label for="nPass">Nouveau mot de passe</label>
        <input type="text" name="newPassword" for="nPass"/>
    </p>
    <p>
        <label for="nPass2">Confirmez le mot de passe</label>
        <input type="text" name="confPassword" for="nPass2"/>
    </p>
    <p>
        <label for="mail">Mail</label>
        <input type="text" name="mail" for="mail"/>
    </p>
    <p>
        <label for="bDate">date de </label>
        <input type="date" name="birthDate" for="bDate"/>
    </p>
    <?php echo $checkBoxAdmin; ?>
    <p>
        <input type="submit" value="Submit"/>
    </p>
</form>