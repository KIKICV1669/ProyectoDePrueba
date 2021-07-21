<?php

namespace app\controllers;

use Illuminate\Database\Capsule\Manager as Capsule;
use app\models\Project;

class ProjectController
{
    public function getAddProjectAction($request)
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'cursophp',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        if($request -> getMethod() == 'POST') 
        {
            $postData = $request -> getParsedBody();
            $project = new Project();
            $project->title = $postData['title'];
            $project->description = $postData['description'];
            $project->save();
        }
        include '../views/addProject.php';
    }
}