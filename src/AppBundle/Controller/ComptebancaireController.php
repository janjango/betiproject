<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Comptebancaire;
use AppBundle\Form\ComptebancaireType;

/**
 * Home controller.
 *
 * @Route("/appel")
 */
class ComptebancaireController extends Controller {

    /**
     * @Route("/comptebancaire/read", name="read_comptebancaire")
     * @Method("GET")
     */
    public function read_comptebancaireAction(Request $request) {
        // replace this example code with whatever you need

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $comptes= $this->getDoctrine()
            ->getManager()->getRepository('AppBundle:Comptebancaire')
            ->findAll();

        return $this->render('appel/comptebancaire/read_compte.html.twig', [
            'comptes' => $comptes,
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);

    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/comptebancaire/create", name="create_comptebancaire")
     * @Method({"GET", "POST"})
     */
    public function create_compteAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());
        $compte = new Comptebancaire();

        $form = $this->createForm('AppBundle\Form\ComptebancaireType', $compte);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $compte->setUserCreate($this->getUser()->getUsername());
            $compte->setDateCreate(new \ Datetime());
            $em->persist($compte);
            $em->flush();
            $this->addFlash(
                'success', "Enregistrement effectué avec succès !"
            );

            return $this->redirectToRoute('create_comptebancaire');
        }
        return $this->render('appel/comptebancaire/create_compte.html.twig', [
             'form'   => $form->createView(),
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/comptebancaire/update", name="update_comptebancaire")
     * @Method({"GET", "POST"})
     */
    public function update_comptebancaireAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $compte = $this->getDoctrine()->getManager()->getRepository('AppBundle:Comptebancaire')
            ->find($request->get('id'));
        $form = $this->createForm('AppBundle\Form\ComptebancaireType', $compte);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $compte->setUserModif($this->getUser()->getUsername());
            $compte->setDateModif(new \ Datetime());
            $em->flush();
            $this->addFlash(
                'warning', "Modification effectué avec succès !"
            );

            return $this->redirectToRoute('read_comptebancaire');
        }
        return $this->render('appel/comptebancaire/update_compte.html.twig', [
            'form'   => $form->createView(), 'id'   => $request->get('id'),
            'sousMenus' => $sousMenus,
            'menus' => $menus,
            'element' => $compte
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/comptebancaire/delete", name="delete_comptebancaire")
     * @Method({"GET", "POST"})
     */
    public function delete_comptebancaireAction(Request $request)
    {
        $compte = $this->getDoctrine()->getManager()->getRepository('AppBundle:Comptebancaire')
            ->find($request->get('id'));
        if ($request->getMethod() == 'POST'){
            if ( !$compte->getAppels()->isEmpty()){
                $this->addFlash(
                    'warring', "Il existe déjà au moins un Appel enregistré pour ce compte. On ne peut donc pas le supprimer !"
                );
                return $this->redirectToRoute('read_compte');
            }
            $em = $this->getDoctrine()->getManager();
            $em->remove($compte);
            $em->flush();
            $this->addFlash(
                'danger', "Suppression effectué avec succès !"
            );

            return $this->redirectToRoute('read_comptebancaire');
        }
        return $this->render('appel/comptebancaire/delete_compte.html.twig', [
           'id'   => $request->get('id')
        ]);
    }

}
