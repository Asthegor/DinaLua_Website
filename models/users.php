<?php

class UsersModel extends Model
{
    public function login()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
        if (isset($post['cancel']))
        {
            $this->returnToPage('home');
            return;
        }
        if (isset($post['submit']))
        {
            if ($post['email'] == '' || $post['password'] == '')
            {
                Messages::setMsg("Merci de renseigner tous les champs.", 'error');
                return;
            }
            else
            {
                date_default_timezone_set('Europe/Paris');
                $password = md5($post['password']);

                $maxAttempts = 3;
                
                $this->query("SELECT username, uniqueid, email, confirmed, attempts, locked ".
                             " FROM users ".
                             " WHERE email = :email AND password = :password");
                $this->bind(':email', $post['email']);
                $this->bind(':password', $password);
                $row = $this->single();
                
                // Compte non confirmé
                if (isset($row['confirmed']) && $row['confirmed'] == "0")
                {
                    $this->returnToPage('users/resend/'.$row['uniqueid']);
                    return;
                }
                
                // Compte bloqué par un administrateur/modérateur
                if (isset($row['locked']) && $row['locked'] == "1")
                {
                    Messages::setMsg("Votre compte est actuellement bloqué. Pour débloquer votre compte, veuillez me contacter à l'aide de l'adresse email renseigné dans votre compte.", 'error');
                    return;
                }
                
                // Compte bloqué pour 1 journée
                if (isset($row['attempts']) && intval($row['attempts']) > $maxAttempts)
                {
                    Messages::setMsg("Votre compte est actuellement bloqué pendant 1 jour. Veuillez revenir demain pour vous reconnecter.", 'error');
                    // Rajouter une ligne dans un journal de log pour tracer les comptes posant problème
                    return;
                }

                // Username et password corrects
                if (isset($row['uniqueid']))
                {
                    // Données de la session
                    $_SESSION['Dina_data'] = array(
                        "confirmed"     => $row['confirmed'],
                        "username"      => $row['username'],
                        "uniqueid"      => $row['uniqueid'],
                        "email"         => $row['email']
                    );
                    //
                    $this->query("UPDATE users SET attempts = 0, connected = :connected WHERE email = :email");
                    $this->bind(':email', $post['email']);
                    $this->bind(':connected', date("Y-m-d H:i:s") );
                    $this->execute();
                    $this->returnToPage('home');
                }
                else
                {
                    $this->query("UPDATE users SET attempts = attempts + 1 WHERE email = :email AND locked = 0");
                    $this->bind(':email', $post['email']);
                    $this->execute();
                    $this->query("SELECT uniqueid, email, attempts, locked ".
                                 " FROM users ".
                                 " WHERE email = :email ");
                    $this->bind(':email', $post['email']);
                    $row = $this->single();
                    $this->close();
                    if(isset($row['attempts']) && intval($row['attempts']) > $maxAttempts)
                    {
                        $today = date("Y-m-d H:i:s");
                        $tomorrow = date("Y-m-d H:i:s", strtotime($today . '+ 1 day'));

                        $this->query("UPDATE users SET lockdelay = :lockdelay WHERE email = :email AND ISNULL(lockdelay) OR lockdelay < :today");
                        $this->bind(':email', $post['email']);
                        $this->bind(':today', $today );
                        $this->bind(':lockdelay', $tomorrow );
                        $this->execute();

                        Messages::setMsg("Suite à un grand nombre de tentatives de connexion, votre compte a été bloqué pendant 1 jour.", 'error');
                        return;
                    }
                    else
                    {
                        Messages::setMsg("L'adresse email ou le mot de passe sont incorrects. Veuillez vérifier les données saisies.", 'error');
                        return;
                    }
                }
            }
        }
        return;
    }
    
    public function signup()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
        if (isset($post['cancel']))
        {
            $this->returnToPage('home');
            return;
        }
        if (isset($post['submit']))
        {
            $errors = array();
            if ($post['username'] == '' || $post['password'] == '' || $post['password_again'] == '' || $post['email'] == '')
            {
                $errors[] = "Merci de renseigner tous les champs.";
            }
            if (strlen($post['username']) < 5 || strlen($post['username']) > 30)
            {
                $errors[] = "Le nom d'utilisateur doit être entre 5 et 30 caractères.";
            }
            if(!ctype_alnum($post['username']))
            {
                $errors[] = "Le nom d'utilisateur ne doit contenir que des lettres ou des chiffres.";
            }
            if(!$this->IsUsernameUnique($post['username']))
            {
                $errors[] = "Le nom d'utilisateur renseigné est déjà utilisé.";
            }
            if (strlen($post['password']) < 6)
            {
                $errors[] = 'Le mot de passe doit contenir plus de 5 caractères.';
            }
            if ($post['password'] != $post['password_again'])
            {
                $errors[] = 'Les deux mots de passe saisis ne correspondent pas.';
            }
            if (stristr($post['password'], $post['username']))
            {
                $errors[] = "Le mot de passe est trop similaire au nom d'utilisateur.";
            }
            
            
            if(!empty($errors))
            {
                $errormessage = "";
                foreach($errors as $key => $value)
                {
                    $errormessage .= $value . "<br>";
                }
                
                Messages::setMsg($errormessage, 'error');
            }
            else
            {
                
                // Insert into MySQL
                date_default_timezone_set('Europe/Paris');
                
                $uniqueid = $this->GetUniqueID("");
                $password = md5($post['password']);
                $currentDate = gmdate("Y-m-d H:i:s");
                
                $this->startTransaction();

                $this->query("INSERT INTO users ( uniqueid,      username,  password,  email,  created,  connected)
                                         VALUES (:uniqueid, :username, :password, :email, :created, :connected)");
                            
                $this->bind(':uniqueid', $uniqueid, PDO::PARAM_STR);
                $this->bind(':username', $post['username']);
                $this->bind(':password', $password);
                $this->bind(':email', $post['email']);
                $this->bind(':created', $currentDate);
                $this->bind(':connected', $currentDate);
                $resp = $this->execute();
                //Verify
                if($resp)
                {
                    if ($this->SendConfirmationEmail($post['username'], $post['email']))
                    {
                        $_SESSION['Dina_data'] = array(
                            "confirmed"     => false,
                            "username"      => $post['username'],
                            "email"         => $post['email'],
                            "uniqueid"      => $uniqueid
                        );
                        $this->commit();
                    }
                    else
                    {
                        Messages::SetMsg("Impossible d'envoyer l'email de confirmation. Veuillez essayer ultérieurement.", 'error');
                        $this->rollback();
                        return;
                    }
                    $this->close();
                    $this->returnToPage('users/registered');
                    return;
                }
                $this->rollback();
                $this->close();
                Messages::setMsg("Une erreur est survenue lors de l'enregistrement. Veuillez essayer ultérieurement.", 'error');
            }
        }
        return;
    }
    
    public function confirmed()
    {
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $this->query("UPDATE users SET confirmed = 1 WHERE uniqueid = :uniqueid");
        $this->bind(':uniqueid', $get['id']);
        $this->execute();
        $this->close();

        $this->query("SELECT username, uniqueid, email ".
             " FROM users ".
             " WHERE uniqueid = :uniqueid ");
        $this->bind(':uniqueid', $get['id']);
        $row = $this->single();
        return $row;
    }
    
    public function resend()
    {
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
        if (isset($post['submit']))
        {
            $this->query("SELECT username, uniqueid, email ".
                 " FROM users ".
                 " WHERE uniqueid = :uniqueid ");
            $this->bind(':uniqueid', $get['id']);
            $row = $this->single();

            if ($this->SendConfirmationEmail($row['username'], $row['email']))
            {
                $this->close();
                $this->returnToPage('users/login');
            }
            else
            {
                Messages::SetMsg("Impossible d'envoyer l'email de confirmation. Veuillez essayer ultérieurement.", 'error');
                $this->close();
                $this->returnToPage('users/resend/'.$get['id']);
            }
            return;
        }
        $this->query("SELECT username, uniqueid ".
             " FROM users ".
             " WHERE uniqueid = :uniqueid ");
        $this->bind(':uniqueid', $get['id']);
        $row = $this->single();
        return $row;
    }

    private function SendConfirmationEmail($username, $email)
    {
        $to = urldecode($email);
        $subject = "Email confirmation";
        $link = 'https://dina.lacombedominique.com/users/confirmed/' . $this->GetUniqueID($username);
        $message =  '<html><body>';
        $message .= '<h1>Bonjour ' . $username . '</h1>';
        $message =  '<hr>';
        $message .= '<p>Merci de vous être enregistré sur le site du moteur Dina Lua.</p><br><br>';
        $message .= '<p>Afin de compléter votre inscription et de pouvoir télécharger le moteur et les exemples, veuillez cliquer sur le lien ci-dessous :</p>';
        $message .= '<a class="btn btn-danger" href="' . $link . '" >Confirmer votre inscription</a><br><br><br>';
        $message .= "<p>Ou bien, vous pouvez copier/coller l'URL ci-dessous dans votre navigateur :<br>";
        $message .= $link . '</p>';
        $message .=  '<hr><br>';
        $message .= '<p>Rappel : votre adresse email ne sera jamais transmise à un tiers.</p>';
        $message .= '</body></html>';
        
        $from = 'noreply@dina.lacombedominique.com';
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '.$from."\r\n".
                    'Reply-To: '.$from."\r\n" .
                    'X-Mailer: PHP/' . phpversion();

        return mail($to, $subject, $message, $headers);
    }

    /***********************************************
     * Fonctions de controle
     ***********************************************/
    private function IsUsernameUnique($username)
    {
        $this->query("SELECT username FROM users WHERE username = :username");
        $this->bind(':username', $username);
        $row = $this->single();
        if($row)
            return false;
        return true;
    }
    
    private function GetUniqueID($username)
    {
        if(empty($username))
        {
            $this->query("SELECT UUID() AS uniqueid");
        }
        else
        {
            $this->query("SELECT uniqueid FROM users WHERE username = :username");
            $this->bind(':username', $username);
        }
        $row = $this->single();
        return $row['uniqueid'];
    }
}


?>