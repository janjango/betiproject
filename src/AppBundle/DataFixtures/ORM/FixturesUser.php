<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jac\UserBundle\Entity\User;

class FixturesUser extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $em) {
        //  Create  user1
        $user1 = new User();
        $user1->setUsername('admin');
        $user1->setEnabled(true);
        $user1->setEmail('example@gmail.com');
        $user1->setPlainPassword('adminpass');
        $user1->setRoles(array('ROLE_SUPER_ADMIN'));
        $user1->setFirstName('Jacques');
        $user1->setLastName('Adjahoungbo');
        $phone = '+22997502447';
        $user1->setPhone($phone);
        $em->persist($user1);
        $em->flush();
        $this->addReference('admin', $user1);
    }

    public function getOrder() {
        return 1; // the order in which fixtures will be loaded
    }

}
