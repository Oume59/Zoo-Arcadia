<?php
echo '<link rel="stylesheet" href="/assets/css/login.css">';
?>

<!-- Formulaire de connexion user (nav bar) + faire un echo php du link css quand il sera ok -->
<div class="vide"></div>

<div id="background">
    <div id="form-ui">
        <form action="/User/connexion" method="post" id="form">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div id="form-body">
                <div id="welcome-lines">
                    <div id="welcome-line-1">STAFF</div>
                    <div id="welcome-line-2">Bienvenue</div>
                </div>
                <div id="input-area">
                    <div class="form-inp">
                        <input placeholder="Email" type="text" name="email">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                    <div class="form-inp">
                        <input placeholder="Mot de passe" type="password" name="password">
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