<?php
class AdminsModel extends Model
{
    public function Login()
    {
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
        if ($post['submit'])
        {
            // Compare login
            $this->query('SELECT * FROM admins WHERE login = :login AND password = :password');
            $this->bind(':login', $post['login']);
            $password = md5($post['password']);
            $this->bind(':password', $password);
            $row = $this->single();
            $this->close();

            if ($row)
            {
                $_SESSION['is_logged_in'] = true;
                $_SESSION['admin_data'] = array(
                    "id"    => $row['id'],
                    "name"  => $row['login'],
                );
                exit(header('Location: '.ROOT_MNGT.'home'));
            }
            Messages::setMsg('Incorrect Login', 'error');
            exit(header('Location: '.ROOT_MNGT));
        }
    }
}
?>