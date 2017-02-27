<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\ObjetAppel;
use AppBundle\Form\ObjetAppelType;

class ObjetAppelController extends Controller {

    /**
     * @Route("/objetappel/read", name="read_objetappel")
     * @Method("GET")
     */
    public function read_objetappelAction(Request $request) {
        // replace this example code with whatever you need

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $objetappels= $this->getDoctrine()
            ->getManager()->getRepository('AppBundle:ObjetAppel')
            ->findBy(Array(),Array('libObjet'=>'ASC'));
        return $this->render('appel/objetappel/read_objetappel.html.twig', [
            'objetappels' => $objetappels,
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);

    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/objetappel/create", name="create_objetappel")
     * @Method({"GET", "POST"})
     */
    public function create_objetappelAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $objetappel = new ObjetAppel();
        $form = $this->createForm('AppBundle\Form\ObjetAppelType', $objetappel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($objetappel);
            $em->flush();
            $this->addFlash(
                'success', "Enregistrement effectué avec succès !"
            );

            return $this->redirectToRoute('create_objetappel');
        }
        return $this->render('appel/objetappel/create_objetappel.html.twig', [
             'form'   => $form->createView(),
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/objetappel/update", name="update_objetappel")
     * @Method({"GET", "POST"})
     */
    public function update_objetappelAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $objetappel = $this->getDoctrine()->getManager()->getRepository('AppBundle:ObjetAppel')
            ->find($request->get('id'));
        $form = $this->createForm('AppBundle\Form\ObjetAppelType', $objetappel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->flush();
            $this->addFlash(
                'success', "Modification effectué avec succès !"
            );

            return $this->redirectToRoute('read_objetappel');
        }
        return $this->render('appel/objetappel/update_objetappel.html.twig', [
            'form'   => $form->createView(), 'id'   => $request->get('id'),
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/objetappel/delete", name="delete_objetappel")
     * @Method({"GET", "POST"})
     */
    public function delete_objetappelAction(Request $request)
    {
        $objetappel = $this->getDoctrine()->getManager()->getRepository('AppBundle:ObjetAppel')
            ->find($request->get('id'));
        if ($request->getMethod() == 'POST'){
            $em = $this->getDoctrine()->getManager();
            $em->remove($objetappel);
            $em->flush();
            $this->addFlash(
                'success', "Modification effectué avec succès !"
            );

            return $this->redirectToRoute('read_objetappel');
        }
        return $this->render('appel/objetappel/delete_objetappel.html.twig', [
           'id'   => $request->get('id')
        ]);
    }

}
