<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Compte;
use AppBundle\Form\CompteType;

/**
 * Home controller.
 *
 * @Route("/appel")
 */
class CompteController extends Controller {

    /**
     * @Route("/compte/read", name="read_compte")
     * @Method("GET")
     */
    public function read_compteAction(Request $request) {
        // replace this example code with whatever you need

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $comptes= $this->getDoctrine()
            ->getManager()->getRepository('AppBundle:Compte')
            ->findAll();

        return $this->render('appel/compte/read_compte.html.twig', [
            'comptes' => $comptes,
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);

    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/compte/create", name="create_compte")
     * @Method({"GET", "POST"})
     */
    public function create_compteAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());
        $compte = new Compte();

        $form = $this->createForm('AppBundle\Form\CompteType', $compte);
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

            return $this->redirectToRoute('create_compte');
        }
        return $this->render('appel/compte/create_compte.html.twig', [
             'form'   => $form->createView(),
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/compte/update", name="update_compte")
     * @Method({"GET", "POST"})
     */
    public function update_compteAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $compte = $this->getDoctrine()->getManager()->getRepository('AppBundle:Compte')
            ->find($request->get('id'));
        $form = $this->createForm('AppBundle\Form\CompteType', $compte);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $compte->setUserModif($this->getUser()->getUsername());
            $compte->setDateModif(new \ Datetime());
            $em->flush();
            $this->addFlash(
                'warning', "Modification effectué avec succès !"
            );

            return $this->redirectToRoute('read_compte');
        }
        return $this->render('appel/compte/update_compte.html.twig', [
            'form'   => $form->createView(), 'id'   => $request->get('id'),
            'sousMenus' => $sousMenus,
            'menus' => $menus,
            'element' => $compte
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/compte/delete", name="delete_compte")
     * @Method({"GET", "POST"})
     */
    public function delete_compteAction(Request $request)
    {
        $compte = $this->getDoctrine()->getManager()->getRepository('AppBundle:Compte')
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

            return $this->redirectToRoute('read_compte');
        }
        return $this->render('appel/compte/delete_compte.html.twig', [
           'id'   => $request->get('id')
        ]);
    }

}
