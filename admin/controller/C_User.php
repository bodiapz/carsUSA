<?php
include_once('controller/C_Base.php');

class C_User extends C_Base
{
    public $main;
    public $user_model;

    function __construct() 
    {
        $isLogin = 0;

        if(!empty($_REQUEST['page']))
        {
            $url = explode('/',$_REQUEST['page']);
            if(!empty($url[1]) && $url[1] == 'login')
                $isLogin = 1;
        }

        parent::__construct(1);

        $this->user_model = new M_User_Model();
    }

    protected function OnInput()
    {
        parent::OnInput();
        $this->main = true;
    }

    protected function OnOutput()
    {
        parent::OnOutput();
    }

    protected function action_login()
    {
        $error      = "";
        $data       = null;
        $thanks     = null;

        if($this->isPost())
        {
            $email    =  $this->user_model->db->clearInput($_POST['email']);
            $password =  $this->user_model->db->clearInput($_POST['password']);

            $data['email']    = $email;
            $data['password'] = $password;

            if($error == "") {
                if ($this->user_model->auth($email, $password)) {
                    $userData = $this->user_model->auth($email, $password);

                    if ($error == "") {

                        $_SESSION['user'] = $userData;

                        $userData['profile'] = $this->user_model->getUserProfile($userData['id']);

                        $this->user_model->setLastLogin($userData['id']);

                        $this->redirect();
                    }
                } else {
                    $error = "Неправильний E-mail або пароль";
                }
            }
        }

        $this->content = $this->View('users/tpl_login.php', array('error' => $error, 'data' => $data, 'thanks' => $thanks));
    }

    protected function action_list_users()
    {
        $users = $this->user_model->getUsers();

        $vars = array('users' => $users);
        $this->content = $this->View('users/tpl_list_users.php', $vars);
    }

    public function action_edit($id)
    {
        if($this->isPost())
        {
            //echo"<pre>";print_r($_POST);echo"</pre>";
            if(!empty($id))
            {
                $data = $_POST;

                if(empty($_POST['admin']))
                    $data['admin'] = 0;

                $this->user_model->update($data, $id);
            }
            else $this->redirect('user/list_users');
        }

        $user = $this->user_model->get_user_by_id($id);

        //echo"<pre>";print_r($user);echo"</pre>";

        $vars = array('user' => $user);
        $this->content = $this->View('users/tpl_edit.php', $vars);
    }

    public function action_create()
    {
        $this->content = $this->View('users/tpl_create.php');
    }
	
    public function action_account()
    {
        $this->content = $this->View('users/tpl_create.php');
    }

    public function action_change_password($user_id)
    {
        $error = null;

        if($this->isPost())
        {
            $password = $this->user_model->db->clearInput(trim($_POST['password']));

            if(strlen($password) < 6)
                $error = "Пароль повинен бути не менше 6 символів";
            else
            {
                $password = $this->user_model->make_password($password);

                $this->user_model->update($password,$user_id);
                $this->redirect('user/list_users');
            }
        }
        $this->content = $this->View('users/tpl_change_password.php', array('error' => $error, 'user_id' => $user_id));
    }

    public function action_logout()
    {
        $this->user_model->clearLocation($this->user['id']);

        session_destroy();
        $this->user = null;

        $this->redirect('user/login');
    }
}