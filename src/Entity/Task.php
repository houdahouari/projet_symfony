<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity
 * 
 */
class Task
{
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="title", type="string", length=255, nullable=false)     
     * 
     */
    #[Assert\Length(min:10)]
    public $title;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", length=0, nullable=false)
    
     * 
     */
    #[Assert\Length(min:10)]
    public $body;

public function setTitle($title): void{
    $this->title=$title;
}

public function setBody($body):void{
    $this->body=$body;
}
}
