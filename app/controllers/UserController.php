<?php

namespace app\controllers;

use app\models\User;
use app\controllers\BaseController;
use Respect\Validation\Validator as v;

require_once '..\app\controllers\BaseController.php';
require_once '..\app\models\User.php';

class UserController extends BaseController
{
    public function getAddUserAction($request)
    {
        $responseMessage = null;

        if($request -> getMethod() == 'POST')
        {
            $postData = $request -> getParsedBody();
            $jobValidator = v::key('email', v::stringType() -> notEmpty())
                -> key('password', v::stringType() -> notEmpty());

            try
            {
                $jobValidator -> assert($postData);
                $postData = $request -> getParsedBody();
                
                $user = new User();
                $user -> email = $postData['email'];
                $user -> password = password_hash($postData['password'], PASSWORD_DEFAULT);
                $user -> save();

                return $this -> renderHTML('login.twig');
            }
            catch(\Exception $e)
            {
                $responseMessage = $e->getMessage();
            }
        }
        return $this -> renderHTML('addUser.twig', [
            'responseMessage' => $responseMessage
        ]);
    }
}