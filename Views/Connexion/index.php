<?php
$css = "login";
?>

<!-- Formulaire de connexion user (nav bar) -->
<div class="formus"></div>

<div id="background">
    <div id="form-ui">
        <form action="/LoginUsers/connexion" method="POST" id="form">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div id="form-body">
                <div id="welcome-lines">
                    <div id="welcome-line-1">STAFF</div>
                    <div id="welcome-line-2">Bienvenue</div>
                </div>
                <div id="input-area">
                    <div class="form-inp">
                        <input placeholder="Email" type="text" name="email" required>
                    </div>
                    <div class="form-inp">
                        <input placeholder="Mot de passe" type="password" name="password" required>
                    </div>
                </div>
                <div id="submit-button-cvr">
                    <button id="submit-button" type="submit">Connexion</button>
                </div>
                <div id="bar"></div>
            </div>
        </form>
    </div>
</div>