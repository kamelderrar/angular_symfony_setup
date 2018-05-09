<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $batchSize = 15;

        for ($i = 1; $i <= 15; ++$i) {

            $newUser = new User();
            $newUser->setFirstName('first_name_test_'.$i);
            $newUser->setLastName('last_name_test_'.$i);
            $newUser->setUserName('user_name_test_'.$i);
            $newUser->setPassword(md5('user'.$i));
            
            $manager->persist($newUser);

            if (($i % $batchSize) === 0) {
                $manager->flush();
                $manager->clear(); // Detaches all objects from Doctrine!
            }
        }

        $manager->flush(); // Persist objects that did not make up an entire batch
        $manager->clear();

    }
}