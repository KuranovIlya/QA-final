<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $user1 = new User();
        $user1->setEmail('admin1@mail.ru');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'admin123'));
        $user1->setFullname('Администратор 1');
        $user1->setRoles(['ROLE_ADMIN']);
        $manager->persist($user1);
        
        $user2 = new User();
        $user2->setEmail('user1@mail.ru');
        $user2->setPassword($this->passwordEncoder->encodePassword($user1,'user123'));
        $user2->setFullname('Пользователь 1');
        $user2->setRoles(['ROLE_USER']);
        $manager->persist($user2);


        $manager->flush();
    }
}
