<?php
namespace app\controllers;
require_once '..\app\controllers\BaseController.php';
use app\models\{Job, Project};

class IndexController extends BaseController
{
    public function indexAction()
    {
        return $this -> renderHTML('index.twig');
    }
}