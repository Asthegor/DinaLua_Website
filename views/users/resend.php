<h1>Bonjour <?= $viewModel['username'] ?></h1>
<br>
<p>Vous essayez de vous connecter à votre compte mais l'adresse email associée à celui-ci n'a toujours pas été confirmée.</p>
<br>
<p>Veuillez cliquer sur le bouton ci-dessous pour renvoyer un email de confirmation.</p>
<br>
<div>
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <div style="position: relative; height:2em;">
            <div style="margin:0; position:absolute; top:50%; left:50%; -ms-transform:translate(-50%,-50%); transform:translate(-50%,-50%);">
                <input class="btn btn-primary" name="submit" type="submit" value="Renvoyer l'email" style="width:auto; min-width: 100px"/>
            </div>
        </div>
    </form>
</div>
<hr>
