<?php

namespace app\controllers;

require_once '..\app\models\Job.php';
require_once '..\app\models\Project.php';
require_once '..\app\controllers\BaseController.php';

use app\models\{Job, Project};

class AdminController extends BaseController
{
    public function getIndex()
    {
        return $this -> renderHTML('admin.twig');
    }
}