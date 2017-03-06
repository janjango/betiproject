<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Coffrefort;
use AppBundle\Form\CoffrefortType;

/**
 * Home controller.
 *
 * @Route("/coffrefort")
 */
class CoffreFortController extends Controller {

    /**
     * @Route("/read", name="read_coffrefort")
     * @Method("GET")
     */
    public function readCoffrefortAction(Request $request) {
        // replace this example code with whatever you need
        $exercices = $this->getDoctrine()
                ->getManager()->getRepository('AppBundle:Exercice')
                ->findBy(Array(), Array('libExercice' => 'ASC'));
        $coffreforts = $this->getDoctrine()
                ->getManager()->getRepository('AppBundle:Coffrefort')
                ->findBy(Array('exercice' => $request->get('exercice')), Array('id' => 'ASC'));
        $solde = ($this->getDoctrine()->getManager()->getRepository('AppBundle:Coffrefort')->getSommeajouter($request->get('exercice'))) - ($this->getDoctrine()->getManager()->getRepository('AppBundle:Coffrefort')->getSommeannuler($request->get('exercice')));
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
                ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());
        return $this->render('coffrefort/read_coffrefort.html.twig', [
                    'coffreforts' => $coffreforts, 'exercices' => $exercices, 'exercice' => $request->get('exercice'), 'solde' => $solde,
                    'sousMenus' => $sousMenus,
                    'menus' => $menus,
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/create", name="create_coffrefort")
     * @Method({"GET", "POST"})
     */
    public function createCoffrefortAction(Request $request) {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
                ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());
        $coffrefort = new Coffrefort();
        $form = $this->createForm('AppBundle\Form\CoffrefortType', $coffrefort);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $coffrefort->setUserCreate($this->getUser()->getUsername());
            $coffrefort->setDateCreate(new \ Datetime());
            $coffrefort->setEstAnnuler(false);
            $coffrefort->setEstParentannuler(false);
            $coffrefort->setEstEncaisser(false);
            $coffrefort->setExercice($this->getDoctrine()->getManager()->getRepository('AppBundle:Exercice')->find($request->get('exercice')));
            $em->persist($coffrefort);
            $em->flush();
            $this->addFlash(
                    'success', "Enregistrement effectué avec succès !"
            );
            return $this->redirectToRoute('create_coffrefort', array('exercice' => $request->get('exercice')));
        }
        return $this->render('coffrefort/create_coffrefort.html.twig', [
                    'form' => $form->createView(), 'exercice' => $request->get('exercice'),
                    'sousMenus' => $sousMenus,
                    'menus' => $menus,
        ]);
    }


    /**
     * Creates a new demand entity.
     *
     * @Route("/update", name="update_coffrefort")
     * @Method({"GET", "POST"})
     */
    public function updateCoffrefortAction(Request $request) {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
                ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());
        $coffrefort = $this->getDoctrine()->getManager()->getRepository('AppBundle:Coffrefort')
                ->find($request->get('id'));
        $form = $this->createForm('AppBundle\Form\CoffrefortType', $coffrefort);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $coffrefort->setUserModif($this->getUser()->getUsername());
            $coffrefort->setDateModif(new \ Datetime());
            $em->flush();
            $this->addFlash(
                    'warning', "Modification effectué avec succès !"
            );
            return $this->redirectToRoute('read_coffrefort', array('exercice' => $coffrefort->getExercice()->getId()));
        }
        return $this->render('coffrefort/update_coffrefort.html.twig', [
                    'form' => $form->createView(), 'id' => $request->get('id'), 'coffrefort' => $coffrefort,
                    'sousMenus' => $sousMenus,
                    'menus' => $menus,
                    'exercice' => $coffrefort->getExercice()->getId()
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/delete", name="delete_coffrefort")
     * @Method({"GET", "POST"})
     */
    public function deleteCoffrefortAction(Request $request) {
        $coffrefort = $this->getDoctrine()->getManager()->getRepository('AppBundle:Coffrefort')
                ->find($request->get('id'));
        if ($request->getMethod() == 'POST') {
            $em = $this->getDoctrine()->getManager();
            $em->remove($coffrefort);
            $em->flush();
            $this->addFlash(
                    'danger', "Suppression effectué avec succès !"
            );
            return $this->redirectToRoute('read_coffrefort', array('exercice' => $coffrefort->getExercice()->getId()));
        }
        return $this->render('coffrefort/delete_coffrefort.html.twig', [
                    'id' => $request->get('id'), 'coffrefort' => $coffrefort
        ]);
    }

}
