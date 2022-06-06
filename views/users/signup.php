<div>
    <h1 style="text-align:center;">Inscription</h1>
    <hr>
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label class="form-label">Nom d'utilisateur</label>
            <input type="text" name="username" class="form-control" />
        </div>
        <div class="form-group">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" />
        </div>
        <div class="form-group">
            <label class="form-label">Confirmation du mot de passe</label>
            <input type="password" name="password_again" class="form-control" />
        </div>
        <div class="form-group">
            <label class="form-label">Adresse courriel</label>
            <input type="email" name="email" class="form-control" />
        </div>
        <p>Votre adresse email ne sera JAMAIS transmise à un tiers.</p>
        <div style="position: relative; height:2em;">
            <div style="margin:0; position:absolute; top:50%; left:50%; -ms-transform:translate(-50%,-50%); transform:translate(-50%,-50%);">
                <input class="btn btn-primary" name="submit" type="submit" value="S'enregistrer" style="width:auto; min-width: 100px"/>
                <input class="btn btn-warning" name="cancel" type="submit" value="Annuler" style="width:auto; min-width: 100px"/>
            </div>
        </div>
    </form>
</div>
<hr>
