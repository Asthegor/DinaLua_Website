<?php

class UsersModel extends Model
{
    public function Login()
    {
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if ($post['submit'])
        {
            // Compare login
            $this->query('SELECT * FROM users WHERE login = :login AND password = :password');
            $this->bind(':login', $post['login']);
            $password = md5($post['password']);
            $this->bind(':password', $password);

            $row = $this->single();
            $this->close();

            if ($row)
            {
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_data'] = array(
                    "id"    => $row['id'],
                    "name"  => $row['login'],
                );
                header('Location: '.ROOT_MNGT.'home');
            }
            else
            {
                Messages::setMsg('Incorrect Login', 'error');
            }
        }
        return;
    }
}

?>