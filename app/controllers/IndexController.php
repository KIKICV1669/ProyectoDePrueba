<?php
namespace app\controllers;
require_once '..\app\models\Job.php';
require_once '..\app\models\Project.php';
use app\models\{Job, Project};

class IndexController
{
    public function indexAction()
    {
        $jobs = Job::all();
        $projects = Project::all();
        $name = 'Enrique Cercado';
        $limitMonths = 2000;

        include '../views/index.php';
    }
}