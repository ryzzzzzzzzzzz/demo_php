<?php

namespace MyProject\Controllers;

use MyProject\Models\Users\User;

use MyProject\Exceptions\InvalidArgumentException;

use MyProject\Models\Users\UsersAuthService;

use MyProject\Models\Users\UserActivationService;

use MyProject\Services\EmailSender;

use MyProject\View\View;

class UsersController

{

    /** @var View */

    private $view;

    public function __construct()

    {

        $this->view = new View(__DIR__ . '/../../../templates');

    }

    public function signUp()

    {

        if (!empty($_POST)) {

            try {

            $user = User::signUp($_POST);

            UserActivationService::sendConfirmationEmail($user);

            } catch (InvalidArgumentException $e) {

                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);

                return;

            }

            if ($user instanceof User) {

                $this->view->renderHtml('users/signUpSuccessful.php');

                return;

            }

        }

        $this->view->renderHtml('users/signUp.php');

    }

    public function activate(): void

    {

        $token = $_GET['token'] ?? '';

        if (!$token) {

            $this->view->renderHtml('users/signUp.php', ['error' => 'Токен не передан']);

            return;

        }

        $user = UserActivationService::activate($token);

        if ($user === null) {

            $this->view->renderHtml('users/signUp.php', ['error' => 'Неверный токен активации']);

            return;
        }

        $this->view->renderHtml('users/signUpSuccessful.php');
    }

    public function login()

    {

        if (!empty($_POST)) {

            try {

                $user = User::login($_POST);

                UsersAuthService::createToken($user);

                header('Location: /demo/www/index.php');

                exit();

            } catch (InvalidArgumentException $e) {

                $this->view->renderHtml('users/login.php', ['error' => $e->getMessage()]);

                return;

            }

        }

        $this->view->renderHtml('users/login.php');

}

}