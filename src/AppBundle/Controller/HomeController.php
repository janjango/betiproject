<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Jac\UserBundle\Form\Type\ProfileFormType;
use Jac\UserBundle\Form\Type\ResettingFormType;
/**
 * Home controller.
 *
 * @Route("/home")
 */
class HomeController extends Controller {

    
    /**
     * @Route("/", name="homepage")
     */
    public function homeAction(Request $request) {

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
                ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());
               
        return $this->render('home/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'sousMenus' => $sousMenus,
            'menus' => $menus,
        ]);

    }

    /**
     * Displays a form to edit an existing user entity.
     * @Route("/user/profile", name="home_user_profile")
     * @Template()
     * @Cache(smaxage="600", public="true")
     *
     * @Method({"GET", "POST"})
     */
    public function userProfileAction(Request $request) {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        if (!is_object($user)) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $form = $this->get('form.factory')->create(ProfileFormType::class, $user, [
            "method" => "post",
        ]);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $userManager->updateUser($user);
        }
        return $this->render('home/user_profile.html.twig', array(
                    'form' => $form->createView(),
        ));
    }
}
