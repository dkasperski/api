<?php

namespace UserBundle\DataFixtures;

use UserBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UsersFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User('Jan Kowalski', 'jan.kowalski@gmail.com', 614234567);
        $manager->persist($user);

        $user = new User('Piotr Nowak', 'piotr.nowak@gmail.com', 615334557);
        $manager->persist($user);

        $user = new User('Marcin Lewandowski', 'marcin.lewandowski@gmail.com', 714534547);
        $manager->persist($user);

        $user = new User('Paweł Kucharski', 'pawel.kucharski@gmail.com', 519534589);
        $manager->persist($user);

        $manager->flush();
    }
}