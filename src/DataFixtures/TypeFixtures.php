<?php

namespace App\DataFixtures;

use App\Entity\Food;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $t1 = new Type();
        $t1->setWording("Fruits")
            ->setImage("fruits.jpg");
        $manager->persist($t1);

        $t2 = new Type();
        $t2->setWording("Légumes")
            ->setImage("legumes.jpg");
        $manager->persist($t2);

        $foodRepository = $manager->getRepository(Food::class);

        $a1 = $foodRepository->findOneBy(["name" => "Patate"]);
        $a1->setType($t2);
        $manager->persist($a1);

        $a2 = $foodRepository->findOneBy(["name" => "Carotte"]);
        $a2->setType($t2);
        $manager->persist($a2);

        $a3 = $foodRepository->findOneBy(["name" => "Pomme"]);
        $a3->setType($t1);
        $manager->persist($a3);

        $a4 = $foodRepository->findOneBy(["name" => "Tomate"]);
        $a4->setType($t2);
        $manager->persist($a4);

        $manager->flush();
    }
}
