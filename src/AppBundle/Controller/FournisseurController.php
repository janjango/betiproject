<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Fournisseur;
use AppBundle\Form\FournisseurType;

class FournisseurController extends Controller {

    /**
     * @Route("/fournisseur/read", name="read_fournisseur")
     * @Method("GET")
     */
    public function read_fournisseurAction(Request $request) {
        // replace this example code with whatever you need

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $fournisseurs= $this->getDoctrine()
            ->getManager()->getRepository('AppBundle:Fournisseur')
            ->findBy(Array(),Array('nom'=>'ASC'));
        return $this->render('encaissement/fournisseur/read_fournisseur.html.twig', [
            'fournisseurs' => $fournisseurs,
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);

    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/fournisseur/create", name="create_fournisseur")
     * @Method({"GET", "POST"})
     */
    public function create_fournisseurAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $fournisseur = new Fournisseur();
        $form = $this->createForm('AppBundle\Form\FournisseurType', $fournisseur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($fournisseur);
            $em->flush();
            $this->addFlash(
                'success', "Enregistrement effectué avec succès !"
            );

            return $this->redirectToRoute('create_fournisseur');
        }
        return $this->render('encaissement/fournisseur/create_fournisseur.html.twig', [
             'form'   => $form->createView(),
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/fournisseur/update", name="update_fournisseur")
     * @Method({"GET", "POST"})
     */
    public function update_fournisseurAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $fournisseur = $this->getDoctrine()->getManager()->getRepository('AppBundle:Fournisseur')
            ->find($request->get('id'));
        $form = $this->createForm('AppBundle\Form\FournisseurType', $fournisseur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->flush();
            $this->addFlash(
                'success', "Modification effectué avec succès !"
            );

            return $this->redirectToRoute('read_fournisseur');
        }
        return $this->render('encaissement/fournisseur/update_fournisseur.html.twig', [
            'form'   => $form->createView(), 'id'   => $request->get('id'),
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/fournisseur/delete", name="delete_fournisseur")
     * @Method({"GET", "POST"})
     */
    public function delete_fournisseurAction(Request $request)
    {
        $fournisseur = $this->getDoctrine()->getManager()->getRepository('AppBundle:Fournisseur')
            ->find($request->get('id'));
        if ($request->getMethod() == 'POST'){
            $em = $this->getDoctrine()->getManager();
            $em->remove($fournisseur);
            $em->flush();
            $this->addFlash(
                'success', "Modification effectué avec succès !"
            );

            return $this->redirectToRoute('read_fournisseur');
        }
        return $this->render('encaissement/fournisseur/delete_fournisseur.html.twig', [
           'id'   => $request->get('id')
        ]);
    }

}
