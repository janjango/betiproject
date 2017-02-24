<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/", name="indexpage")
     */
    public function indexAction(Request $request) {
        // replace this example code with whatever you need
        if (!$this->isGranted('ROLE_USER')) {
            return $this->render('default/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            ]);
        }else{

            return $this->redirect(
                   $this->generateUrl('homepage', array())
            );
        }

    }
}
