<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * 
 */
class User implements UserInterface,PasswordAuthenticatedUserInterface
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
     * @ORM\Column(name="username", type="string", length=255, nullable=false)     
     * 
     */
   
     public $username;


    /**
     * @var string
     * 
     * @ORM\Column(name="password", type="string", length=255, nullable=false)     
     * 
     */
   
    public $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
    
     * 
     */
   
    public $email;


    public function getRoles():array
    {
        return ["ROLE_USER"];
    }
    public function getSalt(){
        return null;
    }
    public function getPassword():string
    {
        return $this->password;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function eraseCredentials()
    {
        // leaving blank - I don't need/have a password!
        return null;
    }
    public function getUserIdentifier():string{
          return "";
    }
    public function setUsername($username):void{
        $this->username=$username;
    }
    public function setPassword($password):void{
        $this->password=$password;
    }
    public function setEmail($mail):void{
        $this->email=$mail;
    }



}
