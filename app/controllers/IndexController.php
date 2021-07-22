<?php
namespace app\controllers;
require_once '..\app\models\Job.php';
require_once '..\app\models\Project.php';
require_once '..\app\controllers\BaseController.php';
use app\models\{Job, Project};

class IndexController extends BaseController
{
    public function indexAction()
    {
        $jobs = Job::all();
        $projects = Project::all();
        $name = 'Enrique Cercado';
        $limitMonths = 2000;

        return $this -> renderHTML('index.twig', [
            'name' => $name,
            'jobs' => $jobs
        ]);
    }
}