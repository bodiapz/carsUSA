<?php
include_once('controller/C_Base.php');

class C_User extends C_Base
{
    public $main;
    public $user_model;

    function __construct() 
    {
        parent::__construct();

        $this->user_model = new M_User_Model();
        $this->page_model = new M_Page_Model();
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

    // user registration
    public function action_signup()
    {
        $errors = null;
        $data   = null;

        if($this->isPost())
        {
            $first_name = $this->user_model->db->clearInput($_POST['first_name']);
            $email      = $this->user_model->db->clearInput($_POST['email']);
            $password   = $this->user_model->db->clearInput($_POST['password']);
            $phone      = $this->user_model->db->clearInput($_POST['phone']);

            if(!filter_var($email,FILTER_VALIDATE_EMAIL))
                $errors[] = "Input valid email";

            if(strlen($password) < 6)
                $errors[] = $this->translate("Пароль повинен складатися не менше 6 символів", false);

            if(empty($first_name))
                $errors[] = $this->translate("Введіть ваше ім'я", false);

            if(empty($phone) )
                $errors[] = $this->translate("Введіть ваш телефон", false);

            if(empty($errors))
            {
                if($this->user_model->existEmail($email))
                    $errors[] = $this->translate("Email вже зареєстрований", false);
            }

            if(empty($errors))
            {
                $password = $this->user_model->make_password($password);
                $user['first_name'] = $first_name;
                $user['email']      = $email;
                $user['password']   = $password['password'];
                $user['salt']       = $password['salt'];
                $user['phone']      = $phone;

                $id = $this->user_model->setUser($user);
                $user['id'] = $id;
                $user['verify'] = 0;

                $code = $this->generateRandomString(4, 0);

                $body = "Вітаємо на сайті " . $this->configData['config']['title'] . ". \n".
                        "Код підтвердження - $code. ";
						
                $this->sendEmail($user['email'], 'Реєстрація на сайті ' . $this->configData['config']['title'], $body);

                $this->user_model->set_verify_code($id, $phone, $code);
                $_SESSION['user'] = $user;

                $this->redirect('user/account');
            }
        }

        $this->content = $this->View('users/tpl_signup.php', array('errors' => $errors, 'data' => $_POST));
    }

    // user login
    protected function action_login()
    {
        $error      = "";
        $data       = null;
        $thanks     = null;

        if($this->isPost())
        {
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $data['email'] = $_POST['email'];
            else $error = $this->translate("Не правильний формат емейл", false);

            $data['password'] = $_POST['password'];

            if($error == "") {
                if ($this->user_model->auth($data['email'], $data['password'])) {
                    $userData = $this->user_model->auth($data['email'], $data['password']);

                    if ($userData['status'] == 0)
                        $error = "User is suspended";

                    if ($userData['verify'] == 0)
                        $error = "Акаунт не підтверджений";

                    if ($error == "") {
                        $_SESSION['user'] = $userData;
                        $userData['profile'] = $this->user_model->getUserProfile($userData['id']);
                        $this->redirect();
                    }
                } else
                    $error = $this->translate("Неправильний E-mail або пароль", false);
            }
        }

        $this->content = $this->View('users/tpl_login.php', array('error' => $error, 'data' => $data, 'thanks' => $thanks));
    }

    // user logout
    public function action_logout()
    {
        $this->user_model->clearLocation($this->user['id']);

        session_destroy();
        $this->user = null;

        $this->redirect();
    }

    public function action_account()
    {
        $this->checkAccess();
        if(!$this->user_model->checkVerify($this->user)) $this->redirect('user/verify');

        $userCars = $this->page_model->getUserCars($this->user['id']);
        $userFavCars = $this->page_model->getFavUserCars($this->user['id']);

        $data = $this->user_model->getUserMessages($this->user['id'], true);

        $messages = $this->View('chat/messages.php', array('messages' => $data['messages']));

        $vars = array('userCars' => $userCars, 'favCars' => $userFavCars, 'messages' => $messages, 'new_count' => $data['new_count']);
        $this->content = $this->View('users/tpl_account.php', $vars);
    }
	
    public function action_reset_password()
    {
        $this->checkAccess();
		$errors = null;

        $vars = array('error' => $error);
        $this->content = $this->View('users/tpl_changePassword.php', $vars);
    }

    public function action_change_password($user_id)
    {
        $error = null;

        if($this->isPost())
        {
            $password = $this->user_model->db->clearInput(trim($_POST['password']));

            if(strlen($password) < 6)
                $error = $this->translate("Пароль повинен бути не менше 6 символів", false);
            else
            {
                $password = $this->user_model->make_password($password);

                $this->user_model->update($password,$user_id);
                $this->redirect('user/account');
            }
        }
        $this->content = $this->View('users/tpl_reset_password.php', array('error' => $error, 'user_id' => $user_id));
    }

    public function action_verify()
    {
        $error = null;
        $this->checkAccess();

        if($this->user_model->checkVerify($this->user)) $this->redirect('user/account');
        else{
            if($this->isPost()){
                $code = (int)$_REQUEST['verify'];
                if(!$this->user_model->verify($this->user['id'], $code)) $error = 'Не вірний код підтвердження';
                else $this->redirect('user/account');
            }

            if(isset($_REQUEST['resend'])){

                if($this->user_model->checkLastResend($this->user['id'])) {
                    $code = $this->generateRandomString(4, 0);
                    $this->user_model->set_verify_code($this->user['id'], $this->user['phone'], $code);
                    $error = "Повідомлення відправлено";
                }
                else $error = $this->translate("Потрібно зачекати перед наступною відправкою", false);

            }

            $this->content = $this->View('users/tpl_verify.php', array('error' => $error));
        }
    }

    public function action_contact()
    {
        if($this->isPost()){

            $body = "Повідомлення з сайту " . $this->configData['config']['title'] . " від " . $_POST['name'] . "  <br>".
                    nl2br($_POST['message']);

            $this->sendEmail($this->configData['config']['adminEmail'], 'Повідомлення з сайту ' . $this->configData['config']['title'], $body, $_POST['email']);

            $this->redirect('page/thanks');
        }
    }

    public function action_newPassword()
    {
        $token = "";
        $error = null;

        if(!empty($_REQUEST['token']))
            $token = htmlspecialchars(trim($_REQUEST['token']));

        $user = $this->user_model->getToken($token);

        if(!$user)
            $this->redirect();

        if($this->isPost())
        {
            $password = $this->user_model->db->clearInput(trim($_POST['password']));

            if(strlen($password) < 6)
                $error = $this->translate("Пароль повинен бути не менше 6 символів", false);
            else
            {
                $password = $this->user_model->make_password($password);

                $this->user_model->setUser($password,$user['user_id']);
                $this->redirect('user/account');
            }
        }
        $this->content = $this->View('users/tpl_reset_password.php', array('error' => $error, 'token' => $token));
    }

    public function action_forgot_password()
    {
        $error  = null;
        $thanks = null;

        if($this->isPost())
        {
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                $data['email'] = $_POST['email'];
                if(!$this->user_model->existEmail($data['email']))
                {
                    $error = $this->translate("Користувача з таким емейлом не знайдено", false);
                }
                else
                {
                    $token = $this->generateRandomString();
                    $this->user_model->setToken($data['email'], $token);
                    $msg = "Перейдіть по <a href='" . $this->basePath . "user/newPassword?token=" . $token . "' target='_blank'>даному посиланню</a> щоб відновити пароль";
                    $this->sendEmail($data['email'],"Відновлення паролю на сайті " . $this->configData['config']['title'], $msg);
                    $thanks = $this->translate("На Ваш email відправлено лист із подальшими інструкціями", false);
                }
            }
            else $error = $this->translate('Не правильний формат емейл', false);

        }

        $this->content = $this->View('users/tpl_forgotPassword.php', array('error' => $error, 'thanks' => $thanks));
    }

}