<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Paiement;
use AppBundle\Form\PaiementType;

class PaiementController extends Controller {

    /**
     * @Route("/paiement/read", name="read_paiement")
     * @Method("GET")
     */
    public function read_paiementAction(Request $request) {
        // replace this example code with whatever you need

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $paiements= $this->getDoctrine()
            ->getManager()->getRepository('AppBundle:Paiement')
            ->findBy(Array(),Array('nom'=>'ASC'));
        return $this->render('encaissement/paiement/read_paiement.html.twig', [
            'paiements' => $paiements,
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);

    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/paiement/create", name="create_paiement")
     * @Method({"GET", "POST"})
     */
    public function create_paiementAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $paiement = new Paiement();
        $form = $this->createForm('AppBundle\Form\PaiementType', $paiement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($paiement);
            $em->flush();
            $this->addFlash(
                'success', "Enregistrement effectué avec succès !"
            );

            return $this->redirectToRoute('create_paiement');
        }
        return $this->render('encaissement/paiement/create_paiement.html.twig', [
             'form'   => $form->createView(),
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/paiement/update", name="update_paiement")
     * @Method({"GET", "POST"})
     */
    public function update_paiementAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $paiement = $this->getDoctrine()->getManager()->getRepository('AppBundle:Paiement')
            ->find($request->get('id'));
        $form = $this->createForm('AppBundle\Form\PaiementType', $paiement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->flush();
            $this->addFlash(
                'warning', "Modification effectué avec succès !"
            );

            return $this->redirectToRoute('read_paiement');
        }
        return $this->render('encaissement/paiement/update_paiement.html.twig', [
            'form'   => $form->createView(), 'id'   => $request->get('id'),
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/paiement/delete", name="delete_paiement")
     * @Method({"GET", "POST"})
     */
    public function delete_paiementAction(Request $request)
    {
        $paiement = $this->getDoctrine()->getManager()->getRepository('AppBundle:Paiement')
            ->find($request->get('id'));
        if ($request->getMethod() == 'POST'){
            $em = $this->getDoctrine()->getManager();
            $em->remove($paiement);
            $em->flush();
            $this->addFlash(
                'danger', "Suppression effectué avec succès !"
            );

            return $this->redirectToRoute('read_paiement');
        }
        return $this->render('encaissement/paiement/delete_paiement.html.twig', [
           'id'   => $request->get('id')
        ]);
    }

}
