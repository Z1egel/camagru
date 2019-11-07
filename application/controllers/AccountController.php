<?php

    namespace application\controllers;

    use application\core\Controller;

    use application\lib\Db;

    class AccountController extends Controller
    {
        protected $accView = 'account';

        public function loginAction() {
            if (!isLoggedIn()) {
                if (isset($_POST['login']) && isset($_POST['passwd'])) {
                    $users = $this->model->getUsers();
                    $result = $this->checkLogin($users);
                    if ($result !== "NO" && $result !== "NOT_CNFRM") {
                        $_SESSION['login'] = $_POST['login'];
                        $_SESSION['user_id'] = $result;
                        foreach ($users as $row) {
                            if ($row['login'] == $_POST['login']) {
                                $_SESSION['email'] = $row['email'];
                                $_SESSION['inform'] = $row['inform'];
                                break;
                            }
                        }
                    }
                    exit($result);
                }
                $this->setView();
                $this->view->render('Вход');
            }
            else {
                $this->view->redirect('/');
            }
        }

        public function registerAction() {
            if (!isLoggedIn()) {
                if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['passwd'])) {
                    $condition = 'WHERE login = :login OR email = :email';
                    $params = [
                        'login' => $_POST['login'],
                        'email' => $_POST['email'],
                    ];
                    $users = $this->model->getUsers($condition, $params);
                    $result = $this->isUserExists($users);
                    if ($result === "OK") {
                        $login = $_POST['login'];
                        $email = $_POST['email'];
                        $passwd = hash('whirlpool', $_POST['passwd']);
                        $confirm_link = hash('whirlpool', $login . $email . $passwd . time());
                        $this->model->registerUser($login, $email, $passwd, $confirm_link);
                        //mail($email, "Подтверждение регистрации", "Чтобы подтвердить регистрацию на сайте camagru.aretino.ru, перейдите по ссылке: https://camagru.aretino.ru/account/confirm?login=".$login."&link=".$confirm_link);
                        mail($email, "Подтверждение регистрации", "Чтобы подтвердить регистрацию на сайте camagru.aretino.ru, перейдите по ссылке: https://camagru.aretino.ru/account/confirm/" . $confirm_link);
                    }
                    exit($result);
                }
                $this->setView();
                $this->view->render('Регистрация');
            }
            else {
                $this->view->redirect('/');
            }
        }

        public function confirmAction() {
            if (isset($this->route['link'])) {
                if ($this->model->isLinkExists($this->route['link'])) {
                    $this->model->confirmUser($this->route['link']);
                    $this->setView();
                    $this->view->render("Подтверждение учетной записи");
                } else {
                    $this->view->errorCode(403);
                }
            }
        }

        public function newpassAction() {
            if (!isLoggedIn()) {
                if (isset($_POST['login'])) {
                    $condition = 'WHERE login = :login';
                    $params = [
                        'login' => $_POST['login'],
                    ];
                    $user = $this->model->getUsers($condition, $params);
                    if ($user) {
                        $email = $user[0]['email'];
                        $password = randomPassword();
                        $hash_password = hash('whirlpool', $password);
                        $this->model->updatePassword($hash_password, $_POST['login']);
                        mail($email, "Сброс пароля", "Новый пароль: " . $password);
                    } else
                        exit("NOT_EXIST");
                }
                $this->setView();
                $this->view->render('Восстановление пароля');
            }
            else {
                $this->view->redirect('/');
            }
        }

        public function profileAction() {
            if (isLoggedIn()) {
                $this->view->render('Профиль пользователя');
            }
            else {
                $this->view->redirect('/gallery');
            }
        }

        private function setView() {
            $this->view->layout = $this->accView;
        }

        private function isUserExists($users)
        {
            $login = htmlspecialchars($_POST['login']);
            $email = htmlspecialchars($_POST['email']);
            foreach ($users as $row)
            {
                if ($row['login'] == $login) {
                    return "user_exists";
                }
                if ($row['email'] == $email) {
                    return "email_exists";
                }
            }
            return "OK";
        }

        private function checkLogin($users)
        {
            $login = htmlspecialchars($_POST['login']);
            $passwd = hash('whirlpool', $_POST['passwd']);
            foreach ($users as $row)
            {
                if ($row['login'] == $login && $row['password'] == $passwd) {
                    if ($row['confirmed'] == 1)
                        return $row['user_id'];
                    else
                        return "NOT_CNFRM";
                }
            }
            return "NO";
        }
    }