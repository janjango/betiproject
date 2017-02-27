<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Entity\Menu;

class FixturesMenu extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $em) {
        //  Create  menu1
        $menu1 = new Menu();
        $menu1->setLibelle('Appel');
        $menu1->setRouteName('read_appel');
        $menu1->setFontIconClass('gi gi-shopping_cart');
        $em->persist($menu1);
        $em->flush();
        $this->addReference('menu1', $menu1);
    }

    public function getOrder() {
        return 2; // the order in which fixtures will be loaded
    }

}
