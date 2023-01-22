<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TaskFixture extends Fixture
{
    //pour creer des donnees fake
    public function load(ObjectManager $manager): void
    {
        for($i=1;$i<=10;$i++){
            $task=new Task();
            $task->setTitle("Task title : ".$i);
            $task->setBody("Task body : ".$i);
            $manager->persist($task);//add our task in manager
        }

        $manager->flush();//add our task in db
    }
}
