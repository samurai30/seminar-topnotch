<?php

namespace App\DataFixtures;

use App\Entity\ScapeUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new ScapeUser();
        $user->setUsername('samurai');
        $user->setPassword($this->userPasswordEncoder->encodePassword($user,'suyog'));
        $user->setUserEmail('suyog@gmail.com');
        $user->setUserContact('8975501896');
        $user->setUserFirstName('suyog');
        $user->setUserLastName('Mishal');
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);
        $manager->flush();
    }
}
