<?php

    require 'app/models/Job.php';
    require 'app/models/Project.php';

    $job1 = new Job('Python Developer', 'This is an awesome job!!!');
    $job1 -> months = 16;

    $job2 = new Job('PHP Developer', 'This is an awesome job!!!');
    $job2 -> months = 24;

    $job3 = new Job('', 'This is an awesome job!!!');
    $job3 -> months = 24;

    $project1 = new Project('Project 1', 'Description 1');

    $jobs = [
        $job1,
        $job2,
        $job3
    ];

    $projects = [
        $project1
    ];
    
    function printElement($job)
    {
        
        if($job -> visible == false)
        {
        return;
        }
        echo '<li class="work-position">';
        echo '<h5>' . $job -> getTitle() . '</h5>';
        echo '<p>' . $job -> description . '</p>';
        echo '<p>' . $job ->getDurationAsString() . '</p>';
        echo '<strong>Achievements:</strong>';
        echo '<ul>';
        echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
        echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
        echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
        echo '</ul>';
        echo '</li>';
    }
?>