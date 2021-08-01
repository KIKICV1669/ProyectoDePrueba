<?php

namespace app\controllers;

use app\models\User;
use app\controllers\BaseController;
use Illuminate\Support\Facades\Redirect;
use Respect\Validation\Validator as v;
use Zend\Diactoros\Response\RedirectResponse;

require_once '..\app\controllers\BaseController.php';
require_once '..\app\models\User.php';

class AuthController extends BaseController
{
    public function getLogin()
    {
        return $this -> renderHTML('login.twig');
    }

    public function postLogin($request)
    {
        $postData = $request -> getParsedBody();
        $responseMessage = null;

        $user = User::where('email', $postData['email']) -> first();
        if($user)
        {
            if(password_verify($postData['password'], $user -> password))
            {
                $_SESSION['userId'] = $user -> id;
                return header('location: /');
            }
            else
            {
                $responseMessage = 'Bad Credentials';
            }
        }
        else
        {
            $responseMessage = 'Bad Credentials';
        }
        return $this -> renderHTML('login.twig', [
            'responseMessage' => $responseMessage
        ]);
    }

    public function getLogout()
    {
        unset($_SESSION['userId']);
        return header('location: /login');
    }
}