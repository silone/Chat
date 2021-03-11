<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private ObjectManager $manager ;
    private UserPasswordEncoderInterface $encoder ;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder ;
    }

    public function load(ObjectManager $manager )
    {
        $this->manager = $manager ;
        $this->generete(5) ;
        $manager->flush();
    }

    /**
     * @param int $int
     */
    private function generete(int $int)
    {
        for($i = 1 ; $i <= $int ; $i++){
            $user = new User() ;
            $user->setEmail("siloneossogo{$i}@gmail.com");
            $user->setPassword($this->encoder->encodePassword($user , 'secret'));
            $user->setAvatar("https://picsum.photos/id/{$i}/200/300");
            $this->manager->persist($user);
        }

        $this->manager->flush();
    }
}
