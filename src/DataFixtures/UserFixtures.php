<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
class UserFixtures extends Fixture 
{
    // private $passwordEncoder;
    // public function __construct(PasswordAuthenticatedUserInterface  $passwordEncoder)
    // {
    //     $this->passwordEncoder=$passwordEncoder;
    // }
    //pour creer des donnees fake
    public function load(ObjectManager $manager): void
    {
       
            $user=new User();
          //  $password_hashed=$this->passwordEncoder->password_hash($user,"123houda");
       
            $user->setUsername("houda");
            $user->setPassword("123");
            $user->setEmail("h@gmail.com");
            $manager->persist($user);//add our task in manager
        

        $manager->flush();//add our task in db
    }
}
