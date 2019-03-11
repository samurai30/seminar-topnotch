<?php

namespace App\DataFixtures;

use App\Entity\Featured;
use App\Entity\PropertyAddress;
use App\Entity\PropertyCategory;
use App\Entity\ScapeProperties;
use App\Entity\ScapeUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private const properties = [
        [
            'name' => 'Domnic Villa',
            'notes' => 'bla bla bla',
            'status' => 'unavailable',
            'city' => 'porvorim',
            'district' => 'North',
            'taluka' => 'Salcet',

        ],
        [
            'name' => 'Suyog Villa',
            'notes' => 'bla bla bla',
            'status' => 'available',
            'city' => 'Mapusa',
            'district' => 'North',
            'taluka' => 'Bardez',

        ]
];

    private const categories = ['Duplex','Triplex','Quadplex'];
    private const featuredData = ['Daily','Exclusive','weekly'];

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
        $this->loadCat($manager);
        $this->loadFeatured($manager);
        $this->loadProp($manager);
    }
    private function loadCat(ObjectManager $manager) {

        foreach (self::categories as $cat){
            $category = new PropertyCategory();
            $category->setCategoryName($cat);
            $this->addReference($cat,$category);
            $manager->persist($category);
        }
        $manager->flush();
    }
    private function loadProp(ObjectManager $manager){
        foreach (self::properties as $prop){
            $property = new ScapeProperties();
            $property->setPropName($prop['name']);
            $property->setPropNotes($prop['notes']);
            $property->setPropStatus($prop['status']);
            $propAddress = new PropertyAddress();
            $propAddress->setPropCity($prop['city']);
            $propAddress->setPropDistrict($prop['district']);
            $propAddress->setPropTaluka($prop['taluka']);
            $property->setCategory($this->getReference(self::categories[rand(0, count(self::categories)-1)]));
            $property->setFeatured($this->getReference(self::featuredData[rand(0, count(self::featuredData)-1)]));
            $property->setPropertyAddress($propAddress);
            $manager->persist($property);

        }
        $manager->flush();
    }
    private function loadFeatured(ObjectManager $manager){
        foreach (self::featuredData as $featuredDat){
            $featured = new Featured();
            $featured->setType($featuredDat);
            $this->addReference($featuredDat,$featured);
            $manager->persist($featured);
        }
        $manager->flush();
    }
}
